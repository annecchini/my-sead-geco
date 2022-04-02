<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Custom\GeCoLogger;

class PersonController extends Controller
{

    public function __construct(Person $person)
    {
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
    public function index(Request $request)
    {
        $people = Person::sortable(['updated_at' => 'desc'])
            ->where('cpf', 'like', '%' . $request->input('cpf') . '%')
            ->where('name', 'like', '%' . $request->input('name') . '%')
            ->paginate(10);

        $people->appends($request->all());

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

        //create
        $person = Person::create($request->all());

        //log create
        GeCoLogger::writeLog($person, 'create');

        $success_message = 'Colaborador criado com sucesso.';
        return redirect()->route('person.index', ['person' => $person->id])->with('success_message', $success_message);
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
    public function update(Request $request, Person $person)
    {
        //field validation
        $request->validate($person->rules(), $person->feedback());

        //do the thing
        $person->update($request->all());

        //log update
        GeCoLogger::writeLog($person, 'update');


        //redirect to right place
        $success_message = 'Colaborador atualizado com sucesso.';
        if ($request->input('to') == "person_show") return redirect()->route('person.show', ['person' => $person->id])->with('success_message', $success_message);;
        return redirect()->route('person.index')->with('success_message', $success_message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Person $person)
    {

        //cant delete if have constraint
        if ($person->users->count()) {
            return redirect()->route('person.index')->withErrors(['message' => 'Erro: Colaborador não pode ser excluido pois possui usuário(s) associado(s).']);
        }
        if ($person->bonds->count()) {
            return redirect()->route('person.index')->withErrors(['message' => 'Erro: Colaborador não pode ser excluido pois possui vínculo(s) associado(s).']);
        }

        $person->delete();

        //log delete
        GeCoLogger::writeLog($person, 'destroy');

        //redirect to right place
        $success_message = 'Colaborador excluído com sucesso.';
        return redirect()->route('person.index')->with('success_message', $success_message);
    }
}
