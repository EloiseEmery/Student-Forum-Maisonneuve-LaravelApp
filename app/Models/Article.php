<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

	protected $fillable = [
		'article_nom', 
		'article_nom_en', 
		'article_description', 
		'article_description_en', 
		'article_user_id'
	];
	

	/**
	 * Récupérer tous les articles
	 */
	static public function selectArticles(){
		$lg = "";
		if(session()->has('locale') && session()->get('locale') == 'en') {
			$lg = '_en';
		}
	
		$query = Article::Select('id', 'created_at', 'article_user_id',
		DB::raw('(case when article_nom'.$lg.' is null then article_nom else article_nom'.$lg.' end) as article_nom'))
		->orderBy('created_at')
		->get();

		return $query;
	}


	/**
	 * Récupérer un article par son id
	 * @param $id
	 */
	static public function selectArticle($id){
		$lg = "";
		if(session()->has('locale') && session()->get('locale') == 'en') {
			$lg = '_en';
		}
	
		$query = Article::Select('*', 
		DB::raw('(case when article_nom'.$lg.' is null then article_nom else article_nom'.$lg.' end) as article_nom'),
		DB::raw('(case when article_description'.$lg.' is null then article_description else article_description'.$lg.' end) as article_description'))
		->where('id', $id)
		->get();

		return $query;
	}
}