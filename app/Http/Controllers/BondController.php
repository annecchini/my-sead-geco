<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use App\Models\Person;
use App\Models\Ocupation;
use App\Models\Course;
use App\Models\Pole;
use App\Custom\GeCoLogger;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BondController extends Controller
{

    public function __construct(Bond $bond)
    {
        //
        $this->bond = $bond;

        //middleware
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bonds_query = new Bond();
        $bonds_query = $bonds_query->AcceptRequest(Bond::$accepted_filters)->filter();
        $bonds_query = $bonds_query->sortable(['updated_at' => 'desc']);

        $bonds = $bonds_query->paginate(10);
        $bonds->withQueryString();

        return view('bond.index', ['bonds' => $bonds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $people = Person::orderBy('name')->get();
        $ocupations = Ocupation::orderBy('name')->get();
        $courses =  Course::orderBy('name')->get();
        $locations =  Pole::orderBy('name')->get();

        return view('bond.create', [
            'people' => $people,
            'ocupations' => $ocupations,
            'courses' => $courses,
            'locations' => $locations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Phase 1 validation
        $validator = Validator::make($request->all(), $this->bond->rules(), $this->bond->feedback());
        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        //Phase 2 validation
        if ($request->input('begin-date') == $request->input('end-date')) {
            $rules =  ['end-time' => 'date_format:H:i:s|after_or_equal:begin-time'];
            $validator = Validator::make($request->all(), $rules, $this->bond->feedback());
            if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        }

        //prepare model
        $bond_data = [
            "person_id" => $request->input('person_id'),
            "ocupation_id" => $request->input('ocupation_id'),
            "begin" => $request->input('begin-date') . " " . $request->input('begin-time'),
            "end" => $request->input('end-date') ? $request->input('end-date') . " " . $request->input('end-time') : null,
            "course_id" => $request->input('course_id'),
            "pole_id" => $request->input('pole_id')
        ];

        //create
        $bond = Bond::create($bond_data);

        //log create
        GeCoLogger::writeLog($bond, 'create');

        $success_message = 'Vínculo criado com sucesso.';
        if ($request->input('to') == "person") return redirect()->route('bond.personBondIndex', ['person' => $request->input('person_id')])->with('success_message', $success_message);
        return redirect()->route('bond.index', ['bond' => $bond->id])->with('success_message', $success_message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function show(Bond $bond)
    {
        //
        return view('bond.show', ['bond' => $bond]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function personBondIndex(Person $person)
    {
        //
        $bonds = $person->bonds;
        return view('bond.personBondIndex', ['person' => $person, 'bonds' => $bonds]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function edit(Bond $bond)
    {
        //
        $people = Person::orderBy('name')->get();
        $ocupations = Ocupation::orderBy('name')->get();
        $courses =  Course::orderBy('name')->get();
        $locations =  Pole::orderBy('name')->get();

        return view('bond.edit', [
            'bond' => $bond,
            'people' => $people,
            'ocupations' => $ocupations,
            'courses' => $courses,
            'locations' => $locations
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bond $bond)
    {
        //
        //Phase 1 validation
        $validator = Validator::make($request->all(), $this->bond->rules(), $this->bond->feedback());
        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        //Phase 2 validation
        if ($request->input('begin-date') == $request->input('end-date')) {
            $rules =  ['end-time' => 'date_format:H:i:s|after_or_equal:begin-time'];
            $validator = Validator::make($request->all(), $rules, $this->bond->feedback());
            if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        }

        //prepare model
        $bond_data = [
            "person_id" => $request->input('person_id'),
            "ocupation_id" => $request->input('ocupation_id'),
            "begin" => $request->input('begin-date') . " " . $request->input('begin-time'),
            "end" => $request->input('end-date') ? $request->input('end-date') . " " . $request->input('end-time') : null,
            "course_id" => $request->input('course_id'),
            "pole_id" => $request->input('pole_id')
        ];

        //update
        $bond->update($bond_data);

        //log update
        GeCoLogger::writeLog($bond, 'update');

        //redirect to right place
        if ($request->input('to') == "person") return redirect()->route('bond.personBondIndex', ['person' => $bond->person_id]);
        return redirect()->route('bond.show', ['bond' => $bond->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bond  $bond
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bond $bond)
    {
        //cant delete if...

        //preserve $bond data for future operations
        $b = $bond->replicate();
        $b->id = $bond->id;

        //delete
        $bond->delete();

        //log delete
        GeCoLogger::writeLog($b, 'destroy');

        if ($request->input('to') == "person") return redirect()->route('bond.personBondIndex', ['person' => $b->person_id]);
        return redirect()->route('bond.index');
    }
}
