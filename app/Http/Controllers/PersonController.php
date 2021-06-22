<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{

    public function __construct(Person $person){
        //
        $this->person = $person;

        //middleware
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $people = Person::paginate(10);
        return view('person.index', ['people' => $people]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //field validation
        $request->validate($this->person->rules(), $this->person->feedback());

        $person = Person::create($request->all());
        return redirect()->route('person.show', [ 'person' => $person->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
        return view('person.show', ['person' => $person]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
        return view('person.edit', ['person' => $person]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //load resource
        $person = $this->person->find($id);

        //field validation
        $request->validate($person->rules(), $person->feedback());

        //do the thing
        $person->update($request->all());
        return redirect()->route('person.show', ['person' => $person->id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //

        //cant delete if have constraint
        if($person->user){
            return redirect()->route('person.index')->withErrors(['message'=>'Erro: Colaborador não pode ser excluido pois possui usuário(s) associado(s).']);
        }

        $person->delete();
        return redirect()->route('person.index');
    }
}
