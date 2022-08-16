<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 	if(Auth::check()) {
			// Sélectionner tous les documents
			$documents = Document::selectDocuments();
			// Récupérer le message de retour d'une suppression ou d'un ajout
			if (isset($_GET['messageRetour'])) {
				$messageRetour = $_GET['messageRetour'];
			}
			else {
				$messageRetour = '';
			}

        	return view('document.index', ['documents' => $documents, 'messageRetour' => $messageRetour]);
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
		return view('document.create');
    }

    /**
     * Store a newly created resource in storage.
     * Add a new document
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Validation des données
		$request->validate([
			'file' => 'required|mimes:pdf,zip,doc|max:2048'
		]);

		$fileModel = new Document;
		
		if($request->file()) {
			// Sauvegarder le fichier dans le dossier public
			$fileName = time().'_'.$request->file->getClientOriginalName();
			$filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

			// Enregistrer le nom du fichier
			if(session()->get('locale') == 'en') {
				$fileModel->document_nom_en = time().'_'.$request->file->getClientOriginalName();
			} else {
				$fileModel->document_nom = time().'_'.$request->file->getClientOriginalName();
			}
			// Enregistrer le chemin du fichier
			$fileModel->document_path = $filePath;
			// Enregistrer l'utilisateur qui a ajouté le fichier
			$fileModel->document_user_id = Auth::user()->id;
			$fileModel->save();

			if(session()->get('locale') == 'en') {
				$messageRetour = "File uploaded successfully.";
			}
			else {
				$messageRetour = "Document ajouté avec succès.";
			}
			return redirect(route('document.index', ['messageRetour' => $messageRetour]));
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        if(Auth::check()) {
			// Sélectionner tous les étudiants
			$etudiants = Etudiant::all();
			// Sélectionner le document à afficher
			$documentId = $document->id;
			$documentToShow = Document::selectDocument($documentId);
			// Récupérer le message de retour d'un ajout ou d'une modification
			if (isset($_GET['messageRetour'])) {
				$messageRetour = $_GET['messageRetour'];
			}
			else {
				$messageRetour = '';
			}

			return view('document.show', ['documentToShow' => $documentToShow, 'etudiants' => $etudiants, 'messageRetour' => $messageRetour]);
		}
		return redirect('login');
    }

	/**
	 * Download the specified resource.
	 *
	 * @param  \App\Models\Document  $document
	 * @return \Illuminate\Http\Response
	 */
	public function download(Document $document)
	{
		// download the file
		return response()->download(storage_path('/app/public/'.$document->document_path));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
		if(Auth::user()->id == $document->document_user_id) {
			// Sélectionner le document à modifier
			$documentId = $document->id;
			$documentToShow = Document::selectDocument($documentId);

			return view('document.edit', ['documentToShow' => $documentToShow]);
		}
		else {
			return redirect(route('document.index'));
		}
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
		if(session()->get('locale') == 'en') {
			$request->validate([
				'document_nom_en' => 'required|max:255'
			]);

			// Modifier le nom du document en anglais
			$document->update([
				'document_nom_en' => $request->document_nom_en,
				'document_user_id' => Auth::user()->id,
			]);

			$messageRetour = "File updated successfully.";
		}
		else {
			$request->validate([
				'document_nom' => 'required|max:255'
			]);

			// Modifier le nom du document en français
			$document->update([
				'document_nom' => $request->document_nom,
				'document_user_id' => Auth::user()->id,
			]);

			$messageRetour = "Document mis à jour avec succès.";
		}
		
		return redirect(route('document.show', ['document' => $document->id, 'messageRetour' => $messageRetour]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
		// Supprimer le document de la base de données
		$document->delete();
		// Supprimer le fichier du dossier public
		unlink(storage_path('app/public/'.$document->document_path));

		if(session()->get('locale') == 'en') {
			$messageRetour = "File profile deleted successfully.";
		}
		else {
			$messageRetour = "Document supprimé avec succès.";
		}

		return redirect(route('document.index', ['messageRetour' => $messageRetour]));
    }
}
