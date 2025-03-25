<?php

use App\Models\Categorie;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->timestamps();
        });

        Schema::table('articles', function (Blueprint $table){
            // Ajout de l'identifiant de la catégorie dans la table articles comme clé etrangère
            $table->foreignIdFor(Categorie::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');

        // Supression de la clé etrangère lorsqu'on annule les migrations
        Schema::table('articles', function (Blueprint $table){
            $table->dropForeignIdFor(Categorie::class);
        });
    }
};
