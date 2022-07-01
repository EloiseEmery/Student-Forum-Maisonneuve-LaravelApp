<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Http\Request;


class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// Récupérer tous les étudiants
		$etudiants = Etudiant::all();

		// Récupérer le message de retour d'une suppression
		if (isset($_GET['messageRetour'])) {
			$messageRetour = $_GET['messageRetour'];
		}
		else {
			$messageRetour = '';
		}
		
		return view('etudiant.index', ['etudiants' => $etudiants, 'messageRetour' => $messageRetour]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// Récupérer toutes les villes
		$villes = Ville::all();
		// Afficher le formulaire d'ajout d'un étudiant
        return view('etudiant.create', ['villes' => $villes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Récupérer toutes les villes
		$villes = Ville::all();
		// Gestion de l'adresse reçue
		$posted_adresse = json_encode($request->etudiant_adresse);
		$etudiant_adresse = trim(str_replace('"', ' ', $posted_adresse), '[]');
		
		// Gestion des informations du formulaire reçu
		if ($request->etudiant_nom == '' || $etudiant_adresse == '' || $request->etudiant_telephone == '' ||
		$request->etudiant_courriel == '' || $request->etudiant_date_naissance == '') {

			$erreur ='Veuillez remplir tous les champs.';
			return view('etudiant.create', ['villes' => $villes, 'erreur' => $erreur]);
		}
		else {
			$newEtudiant = Etudiant::create([
				'etudiant_nom' => $request->etudiant_nom,
				'etudiant_adresse' => trim($etudiant_adresse),
				'etudiant_telephone' => $request->etudiant_telephone,
				'etudiant_courriel' => $request->etudiant_courriel,
				'etudiant_date_naissance' => $request->etudiant_date_naissance,
				'etudiant_ville_id' => $request->ville_nom
			]);

			$messageRetour = "Étudiant ajouté avec succès.";

			return redirect(route('etudiant.show', ['etudiant' => $newEtudiant->id, 'messageRetour' => $messageRetour]));
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
		// Récupérer toutes les villes
		$villes = Ville::all();
		// Récupérer le message de retour d'un ajout ou d'une modification
		if (isset($_GET['messageRetour'])) {
			$messageRetour = $_GET['messageRetour'];
		}
		else {
			$messageRetour = '';
		}

		// Afficher le profil d'un étudiant
		return view('etudiant.show', ['etudiant' => $etudiant, 'villes' => $villes, 'messageRetour' => $messageRetour]);
	}
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiant)
    {
		$villes = Ville::all();
		return view('etudiant.edit', ['etudiant' => $etudiant, 'villes' => $villes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
		$etudiant->update([
			'etudiant_nom' => $request->etudiant_nom,
			'etudiant_adresse' => $request->etudiant_adresse,
			'etudiant_telephone' => $request->etudiant_telephone,
			'etudiant_courriel' => $request->etudiant_courriel,
			'etudiant_date_naissance' => $request->etudiant_date_naissance,
			'etudiant_ville_id' => $request->etudiant_ville_id,
		]);

		$messageRetour = "Étudiant modifié avec succès.";

		return redirect(route('etudiant.show', ['etudiant' => $etudiant->id, 'messageRetour' => $messageRetour]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

		$messageRetour = "Étudiant supprimé avec succès.";

		return redirect(route('etudiants.index', ['messageRetour' => $messageRetour]));
    }
}
