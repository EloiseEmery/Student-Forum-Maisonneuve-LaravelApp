<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

	protected $fillable = [
		'etudiant_nom', 
		'etudiant_adresse', 
		'etudiant_telephone', 
		'etudiant_date_naissance', 
		'etudiant_ville_id', 
		'etudiant_user_id'
	];
}
