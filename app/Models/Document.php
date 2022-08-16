<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Document extends Model
{
    use HasFactory;

	protected $fillable = [
        'document_nom',
        'document_nom_en',
		'document_path',
		'document_user_id',
    ];


	/**
	 * Récupérer tous les documents
	 */
	static public function selectDocuments(){
		$lg = "";
		if(session()->has('locale') && session()->get('locale') == 'en') {
			$lg = '_en';
		}
	
		$query = Document::Select('id', 'created_at', 'document_user_id',
		DB::raw('(case when document_nom'.$lg.' is null then document_nom else document_nom'.$lg.' end) as document_nom'))
		->orderBy('created_at')
		->get();

		return $query;
	}


	/**
	 * Récupérer un document par son id
	 * @param $id
	 */
	static public function selectDocument($id){
		$lg = "";
		if(session()->has('locale') && session()->get('locale') == 'en') {
			$lg = '_en';
		}
	
		$query = Document::Select('*', 
		DB::raw('(case when document_nom'.$lg.' is null then document_nom else document_nom'.$lg.' end) as document_nom'))
		->where('id', $id)
		->get();

		return $query;
	}
}
