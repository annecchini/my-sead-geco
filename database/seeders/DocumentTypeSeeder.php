<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                //dt;
                $dt = new DocumentType();
                $dt->id = 1;
                $dt->name = 'Outro documento';
                $dt->save();

                //dt;
                $dt = new DocumentType();
                $dt->id = 2;
                $dt->name = '(UAB/CAPES Anexo I) Ficha de cadastramento / Termo de compromisso do bolsista';
                $dt->save();

                //dt;
                $dt = new DocumentType();
                $dt->id = 3;
                $dt->name = '(UAB/CAPES Anexo II) Ficha de cadastramento / Termo de compromisso do bolsista - Coordenador geral';
                $dt->save();

                //dt;
                $dt = new DocumentType();
                $dt->id = 4;
                $dt->name = '(UAB/CAPES Anexo III) Ficha de cadastramento / Termo de compromisso do bolsista - Coordenador adjunto';
                $dt->save();

                //dt;
                $dt = new DocumentType();
                $dt->id = 5;
                $dt->name = '(UAB/CAPES Anexo IV) Ficha de cadastramento / Termo de compromisso do bolsista - Coordenador de curso';
                $dt->save();
                
                //dt;
                $dt = new DocumentType();
                $dt->id = 6;
                $dt->name = '(UAB/CAPES Anexo V) Ficha de cadastramento / Termo de compromisso do bolsista - Coordenador de tutoria';
                $dt->save();  


                //dt;
                $dt = new DocumentType();
                $dt->id = 7;
                $dt->name = '(UAB/CAPES Anexo VI) Ficha de cadastramento / Termo de compromisso do bolsista - Professor formador';
                $dt->save(); 

                //dt;
                $dt = new DocumentType();
                $dt->id = 8;
                $dt->name = '(UAB/CAPES Anexo VII) Ficha de cadastramento / Termo de compromisso do bolsista - Tutor';
                $dt->save();  
                
                //dt;
                $dt = new DocumentType();
                $dt->id = 9;
                $dt->name = '(UAB/CAPES Anexo VIII) Ficha de cadastramento / Termo de compromisso do bolsista - Professor conteudista';
                $dt->save();  
                
                //dt;
                $dt = new DocumentType();
                $dt->id = 10;
                $dt->name = '(UAB/CAPES Anexo IX) Ficha de cadastramento / Termo de compromisso do bolsista - Assistente a docência';
                $dt->save();
                
                //dt;
                $dt = new DocumentType();
                $dt->id = 11;
                $dt->name = '(SGB/CAPES) Formulário de encaminhamento do bolsista';
                $dt->save();  
                
                //dt;
                $dt = new DocumentType();
                $dt->id = 12;
                $dt->name = '(UAB/CAPES) Declaração de não acúmulo de bolsas';
                $dt->save();
    }
}
