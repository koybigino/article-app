<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleValidator extends FormRequest
{
    /**
     * Pour créer une Request on utilise la commande
     *      - php artisan make:request nom_de_la_request
     * 
     * Determine if the user is authorized to make this request.
     * 
     * Determine si l'utilise est autorisé à faire cette requete
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * Cette fonction retourne les différentes règle de validation
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [
            "titre" => ["required","min:10"],
            "description" => ["required"],
            "auteur" => ["required"],
            "motif" => ["min:10", "required", "regex:/^[a-z0-9\-]+$/"],
            "categorie" => "required",
            "image_path" => "required"
        ];
    }
    
    /**
     * prepareForValidation
     *
     * Permet de préparer les données avant la validation
     * 
     * @return void
     */
    protected function prepareForValidation()
    {
        // Permet de rajouter des information à la requette
        $this->merge([
            'motif' => $this->input("motif") ?? Str::slug($this->input("titre"))// motif par défaut
        ]);
    }
}
