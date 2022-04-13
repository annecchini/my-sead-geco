<?php

namespace App\Http\Controllers;

use App\Models\InternalNote;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Custom\GeCoLogger;


class InternalNoteController extends Controller
{
    //
    public function __construct(InternalNote $internalNote)
    {
        //middleware
        $this->middleware('auth');
    }


    public function create()
    {
        //
        return view('internalNote.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create model
        $internalNote = new InternalNote();

        //add user id to request
        $request->request->add(['last_up_person_id' => Auth::id()]);

        //field validation
        $request->validate($internalNote->rules($request->all()), $internalNote->feedback());

        //create
        $internalNote->fill($request->all())->save();

        //log create
        GeCoLogger::writeLog($internalNote, 'create');

        $success_message = 'Nota interna criada com sucesso.';
        if ($request->input('to') == "person") {
            $person = $internalNote->getNoteTarget();
            return redirect()->route('person.internalNote.index', ['person' => $person->id])->with('success_message', $success_message);
        }
        return redirect()->route('person.index')->with('success_message', $success_message);
    }

    public function edit(InternalNote $internal_note)
    {
        return view('internalNote.edit', ['internal_note' => $internal_note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InternalNote  $internal_note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, internalNote $internal_note)
    {
        //add user id to request
        $request->request->add(['last_up_person_id' => Auth::id()]);

        //field validation
        $request->validate($internal_note->rules($request->all()), $internal_note->feedback());

        //update
        $internal_note->update($request->all());

        //log create
        GeCoLogger::writeLog($internal_note, 'update');

        $success_message = 'Nota interna atualizada com sucesso.';
        if ($request->input('to') == "person") {
            $person = $internal_note->getNoteTarget();
            return redirect()->route('person.internalNote.index', ['person' => $person->id])->with('success_message', $success_message);
        }
        return redirect()->route('person.index')->with('success_message', $success_message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InternalNote  $internal_note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, InternalNote  $internal_note)
    {

        //cant delete if...

        $internal_note->delete();

        //log delete
        GeCoLogger::writeLog($internal_note, 'destroy');

        //redirect to right place
        $success_message = 'Nota interna excluída com sucesso.';
        if ($request->input('to') == "person") {
            $person = $internal_note->getNoteTarget();
            return redirect()->route('person.internalNote.index', ['person' => $person->id])->with('success_message', $success_message);
        }
        return redirect()->route('person.index')->with('success_message', $success_message);
    }
}
