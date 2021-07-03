<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    public function __construct(Document $document)
    {
        //
        $this->document = $document;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $url_person_id = $request->person_id;
        $people = $url_person_id ? Person::where('id', $url_person_id)->get() : Person::all();
        $documentTypes = DocumentType::all();

        return view('document.create', [
            'url_person_id' => $url_person_id,
            'people' => $people,
            'documentTypes' => $documentTypes,
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
        //validation
        $request->validate($this->document->rules(), $this->document->feedback());

        //salvando arquivo
        $file = $request->file('filePath');
        $document_urn = $file->store('models/document', 'local');

        //criando o model
        $doc = $this->document->create([
            'person_id' => $request->person_id,
            'documentType_id' => $request->documentType_id,
            'alias' => $request->alias,
            'filePath' => $document_urn,
        ]);

        return redirect()->route('person.show', ['person' => $doc->person_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $filePath = $document->filePath;
        $type = str_replace('/', '-', $document->documentType->name);
        $alias = $document->alias;
        $fullname = $alias ? "$type - $alias" : $type;
        return Storage::response($filePath, $fullname);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Document $document)
    {
        $url_person_id = $request->person_id;
        $people = $url_person_id ? Person::where('id', $url_person_id)->get() : Person::all();
        $documentTypes = DocumentType::all();

        return view('document.edit', [
            'document' => $document,
            'url_person_id' => $url_person_id,
            'people' => $people,
            'documentTypes' => $documentTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $options = $request->filePath ? [] : ['filePath' => false];
        $request->validate($this->document->rules($options), $this->document->feedback());

        //update file if have
        $document_urn = null;
        if ($request->file('filePath')) {
            //move old file
            $basename = pathinfo($document->filePath)['basename'];
            Storage::disk('local')->move($document->filePath, "models/document/deleted/$basename");

            //save new file
            $file = $request->file('filePath');
            $document_urn = $file->store('models/document', 'local');
        }

        //dd($document_urn);


        //criando o model
        $document->fill([
            'person_id' => $request->person_id,
            'documentType_id' => $request->documentType_id,
            'alias' => $request->alias,
            'filePath' => $document_urn ? $document_urn : $document->filePath
        ]);
        $document->save();

        return redirect()->route('person.show', ['person' => $document->person_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //get person_id for later
        $person_id = $document->person_id;

        $basename = pathinfo($document->filePath)['basename'];
        Storage::disk('local')->move($document->filePath, "models/document/deleted/$basename");

        //deleta o modelo
        $document->delete();

        return redirect()->route('person.show', ['person' => $person_id]);
    }
}
