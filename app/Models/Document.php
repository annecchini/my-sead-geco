<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'documentType_id', 'alias', 'filePath'];

    public function documentType()
    {
        return $this->belongsTo('App\Models\DocumentType', 'documentType_id');
    }

    public function rules($options = [])
    {
        $rules = [
            'person_id' => 'required|exists:people,id',
            'documentType_id' => 'required|exists:document_types,id',
            'filePath' => 'required|file|mimes:pdf|max:5120',
            'alias' => 'nullable|min:3|max:255'
        ];

        if (isset($options['filePath']) && $options['filePath'] === false) unset($rules['filePath']);

        return $rules;
    }

    public function feedback()
    {
        return [
            //genericos
            'required' => 'O campo é obrigatório.',
            'exists' => 'O campo deve existir no banco de dados.',
            'file' => 'Um arquivo deve ser enviado.',
            'mimes' => 'Formato de arquivo inválido.',
            'min' =>   'O campo deve possuir no mínimo :min caracteres.',
            'max' => 'O campo deve possuir no máximo :max caracteres.',

            //especificos
            'person_id.exists' => 'O colaborador informado não existe no banco de dados.',
            'documentType_id.exists' => 'O tipo de documento informado não existe no banco de dados.',
            'filePath.mimes' => 'O arquivo deve ser do tipo PDF.',
            'filePath.max' => 'O arquivo deve ter menos de 5MB.'
        ];
    }
}
