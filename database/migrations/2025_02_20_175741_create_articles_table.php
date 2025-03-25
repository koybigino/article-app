<?php

// 
/**
 * Une Migration permet de rajouter|creer des tables
 * dans la bd
 * 
 * ------------------------------------------------
 * convention pour le nomge
 *      create_nom-de-la-table_table | CreateNomDeLaTableTable
 *  
 * -----------------------------------------------------------------------------------------
 * Creation d'une migration 
 *      - php artisan make:migration nom_de_la_migration
 * ------------------------------------------------------------------------------------------
 * valider/activer les migrations à la bd
 *      - php artisan migrate
 * 
 * Pour relancer une migration
 *      - php artisan migrate:refresh
 * 
 * 
 * Pour annuler une migration
 *      - php artisan migrate:rollback
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Permet de créer une table et de définir les ses attributs
     */
    public function up(): void
    {
        // Schema::create('articles', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('titre');
        //     $table->string('motif')->unique();
        //     $table->longText('description');
        //     $table->string('image_path');
        //     $table->string('auteur');
        //     $table->string('categorie');
        //     $table->timestamps();
        // });
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('motif')->unique();
            $table->longText('description');
            $table->string('image_path');
            $table->string('auteur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Elle permet de supprimer notre table
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
