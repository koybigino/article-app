<?php

/**
 * L'ORM (Object Relational Mapping) Eloquent qui sont des classes quivont nous permettre d'interargir
 * avec les informations/données contenue dans notre bd et les afficher sous forme d'objets
 * Nous permet de communiquer avec la base de données
 *
 * Creation d'un mode
 *      - php artisan make:model nom_du_model
 * 
 * Creation d'un modèle et de ça migration
 *      - php artisan make:model nom_du_model -m
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory; // permet de générer les données

    // definition des champs remplissable
    protected $fillable = [
        'titre',
        'motif',
        'description',
        'image_path',
        'auteur',
        'categorie_id'
    ];


    // Mettre en relation la table article et categorie
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function etiquettes(){
        return $this->belongsToMany(Etiquette::class);
    }


    // définition des champs non remplissable
    // protected $guarded = [
    //     "created_at",
    //     "updated_at"
    // ];
}
