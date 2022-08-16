<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(Auth::check()) {
			// Sélectionner tous les articles
			$articles = Article::selectArticles();
			// Sélectionner tous les étudiants
			$etudiants = Etudiant::all();
			// Récupérer le message de retour d'une suppression ou d'un ajout
			if (isset($_GET['messageRetour'])) {
				$messageRetour = $_GET['messageRetour'];
			}
			else {
				$messageRetour = '';
			}

			return view('article.index', ['articles' => $articles, 'etudiants' => $etudiants, 'messageRetour' => $messageRetour]);
	 	}
	 	return redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		if(session()->get('locale') == 'en') {
			$request->validate([
				'article_nom_en' => 'required|min:2|max:255',
				'article_description_en' => 'required|min:2',
			]);
		}
		else {
			$request->validate([
				'article_nom' => 'required|min:2|max:255',
				'article_description' => 'required|min:2',
			]);
		}

		// Créer un nouvel article
		$newArticle = Article::create([
			'article_nom' => $request->article_nom,
			'article_nom_en' => $request->article_nom_en,
			'article_description' => $request->article_description,
			'article_description_en' => $request->article_description_en,
			'article_user_id' => Auth::user()->id,
		]);

		if(session()->get('locale') == 'en') {
			$messageRetour = "Article added successfully.";
		}
		else {
			$messageRetour = "Article ajoutée avec succès.";
		}
		
		return redirect(route('article.index', ['messageRetour' => $messageRetour]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
		if(Auth::check()) {
			// Sélectionner tous les étudiants
			$etudiants = Etudiant::all();
			// Sélectionner l'article à afficher
			$articleId = $article->id;
			$articleToShow = Article::selectArticle($articleId);

			// Récupérer le message de retour d'une modification
			if (isset($_GET['messageRetour'])) {
				$messageRetour = $_GET['messageRetour'];
			}
			else {
				$messageRetour = '';
			}

        	return view('article.show', ['articleToShow' => $articleToShow, 'etudiants' => $etudiants, 'messageRetour' => $messageRetour]);
		}
		return redirect('login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        if(Auth::user()->id == $article->article_user_id) {
			// Sélectionner l'article à modifier
			$articleId = $article->id;
			$articleToShow = Article::selectArticle($articleId);

			return view('article.edit', ['articleToShow' => $articleToShow]);
		}
		else {
			return redirect(route('article.index'));
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
		if(session()->get('locale') == 'en') {
			$request->validate([
				'article_nom_en' => 'required|min:2|max:255',
				'article_description_en' => 'required|min:2',
			]);

			// Modifier l'article en anglais
			$article->update([
				'article_nom_en' => $request->article_nom_en,
				'article_description_en' => $request->article_description_en,
				'article_user_id' => Auth::user()->id,
			]);

			$messageRetour = "Subject updated successfully.";
		}
		else {
			$request->validate([
				'article_nom' => 'required|min:2|max:255',
				'article_description' => 'required|min:2',
			]);
			
			// Modifier l'article en français
			$article->update([
				'article_nom' => $request->article_nom,
				'article_description' => $request->article_description,
				'article_user_id' => Auth::user()->id,
			]);

			$messageRetour = "L'article mis à jour avec succès.";
		}
		
		return redirect(route('article.show', ['article' => $article->id, 'messageRetour' => $messageRetour]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
		// Supprimer l'article
		$article->delete();

		if(session()->get('locale') == 'en') {
			$messageRetour = "Subject deleted successfully.";
		}
		else {
			$messageRetour = "L'article supprimé avec succès.";
		}

		return redirect(route('article.index', ['messageRetour' => $messageRetour]));
    }
}
