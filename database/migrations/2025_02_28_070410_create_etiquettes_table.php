<?php

use App\Models\Article;
use App\Models\Etiquette;
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
        Schema::create('etiquettes', function (Blueprint $table) {
            $table->id();
            $table->string("nom")->unique();
            $table->timestamps();
        });

        Schema::create("article_etiquette", function(Blueprint $table) {
            $table->foreignIdFor(Article::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Etiquette::class)->constrained()->cascadeOnDelete();
            $table->primary(['article_id', 'etiquette_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_etiquette');
        Schema::dropIfExists('etiquettes');
    }
};
