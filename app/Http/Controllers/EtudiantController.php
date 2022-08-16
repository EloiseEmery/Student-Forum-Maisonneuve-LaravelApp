<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;


class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(Auth::check()) {
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
		return redirect('login');
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
		// return $request;
		// Récupérer toutes les villes
		$villes = Ville::all();
		// Gestion de l'adresse reçue
		$posted_adresse = json_encode($request->etudiant_adresse);
		$etudiant_adresse = trim(str_replace('"', ' ', $posted_adresse), '[]');
		
		// Validation des informations du formulaire reçu
		$request->validate([
			'etudiant_nom' => 'required|min:2|max:50',
			'etudiant_telephone' => 'required||numeric|digits:10',
			'email' => 'required|unique:users|regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/',
			'etudiant_date_naissance' => 'required|date|before:today',
			'ville_nom' => 'required|exists:villes,id',
		]);
		
		// Création d'un nouvel utilisateur
		$user = new User;	
		$user->name = $request->etudiant_nom;
		$user->email = $request->email;
		// Mot de passe par défaut.
		// On suppose que l'étudiant devra le modifier lors de sa première connexion.
		$defaultUserPassword = 'cmaisonneuve';
		$user->password = Hash::make($defaultUserPassword);
		$user->save();

		// Création d'un nouvel étudiant
		$newEtudiant = Etudiant::create([
			'etudiant_nom' => $request->etudiant_nom,
			'etudiant_adresse' => trim($etudiant_adresse),
			'etudiant_telephone' => $request->etudiant_telephone,
			'etudiant_date_naissance' => $request->etudiant_date_naissance,
			'etudiant_ville_id' => $request->ville_nom,
			'etudiant_user_id' => $user->id,
		]);

		if(session()->get('locale') == 'en') {
			$messageRetour = "Student added successfully.";
		}
		else {
			$messageRetour = "Étudiant ajouté avec succès.";
		}
		
		return redirect(route('etudiant.show', ['etudiant' => $newEtudiant->id, 'messageRetour' => $messageRetour]));
		
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
		$users = User::all();
		// Récupérer le message de retour d'un ajout ou d'une modification
		if (isset($_GET['messageRetour'])) {
			$messageRetour = $_GET['messageRetour'];
		}
		else {
			$messageRetour = '';
		}
		// return $users;
		// Afficher le profil d'un étudiant
		return view('etudiant.show', ['etudiant' => $etudiant, 'users' => $users, 'villes' => $villes, 'messageRetour' => $messageRetour]);
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
		$users = User::all();
		return view('etudiant.edit', ['etudiant' => $etudiant, 'users' => $users, 'villes' => $villes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant, User $user)
    {
		// Valider la modification
		$request->validate([
			'etudiant_nom' => 'required|min:2|max:50',
			'etudiant_telephone' => 'required||numeric|digits:10',
			'email' => 'required|regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/',
			'etudiant_date_naissance' => 'required|date|before:today',
			'etudiant_ville_id' => 'required|exists:villes,id',
		]);
		
		// Mettre à jour l'étudiant
		$etudiant->update([
			'etudiant_nom' => $request->etudiant_nom,
			'etudiant_adresse' => $request->etudiant_adresse,
			'etudiant_telephone' => $request->etudiant_telephone,
			'email' => $request->email,
			'etudiant_date_naissance' => $request->etudiant_date_naissance,
			'etudiant_ville_id' => $request->etudiant_ville_id,
		]);

		// Mettre à jour l'utilisateur
		$userId = $etudiant->etudiant_user_id;
		$user = User::selectUser($userId);
		foreach($user as $u) {
			$u->update([
				'email' => $request->email,
			]);
		}

		if(session()->get('locale') == 'en') {
			$messageRetour = "Student profile updated successfully.";
		}
		else {
			$messageRetour = "Profil étudiant mis à jour avec succès.";
		}
		
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
		// // Supprimer l'étudiant
        $etudiant->delete();
		// Supprimer l'utilisateur lié à l'étudiant
		$userId = $etudiant->etudiant_user_id;
		$user = User::selectUser($userId);
		// Si l'utilisateur est connecté et supprime son compte, le déconnecter
		if(Auth::check() && Auth::user()->id == $userId) {
			Auth::logout();
		}
		foreach($user as $u) {
			$u->delete();
		}

		if(session()->get('locale') == 'en') {
			$messageRetour = "Student profile deleted successfully.";
		}
		else {
			$messageRetour = "Étudiant supprimé avec succès.";
		}

		return redirect(route('etudiants.index', ['messageRetour' => $messageRetour]));
    }
}
