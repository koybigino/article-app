<?php

/**
 * Ceux sont des classes qui vont contenir la logique de votre application
 * Pour que modele on aura un controller
 * -----------------------------------------------------------------------------------
 * 
 * Création d'un controller
 *      - php artisan make:controller controller_name
 */

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Etiquette;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    // public function index(ArticleValidator $validate)
    public function index()
    {
        // $article = Article::create([
        //     'titre' => 'titre de la serie',
        //     'motif' => 'titre-de-la-serie',
        //     'description' => 'description',
        //     'image_path' => "uploads/Gold.png",
        //     'auteur' => "koybi",
        //     // 'categorie' => "film",
        // ]);


        // $article = Article::create([
        //     'titre' => 'titre de anime',
        //     'motif' => 'titre-de-la-anime',
        //     'description' => 'description',
        //     'image_path' => "uploads/Gold.png",
        //     'auteur' => "koybi",
        //     // 'categorie' => "anime",
        // ]);

        // return $article;

        // Mise en place du système de validation (s'utilise sur les formulaires)
        // Class Validator du namespace use Illuminate\Support\Facades\Validator;
        // fonction make qui prend en paramètre deux attributs
        // - le premier c'est un tableau associatif contenant les différents champs à valider
        // - le second  c'est un tableau associatif contenant les différentes règles de validations

        // $validation = Validator::make([
        //     "titre" =>""
        // ], [
        //     // modes de définition des règles de validations
        //     //      - Sous forme de chaine de caractère séparé par des |. exple => "required|min:10|max:50"
        //     //      - Sous forme de tableau ["required", "min:10", ...] utiliser lorqu'on définit des règles avec des expressions régulières

        //     "titre" => "required|min:10|max:50"
        // ]);

        // dd($validation->fails()); // retourne true s'il y'a erreur(erreur de validation) et false sinon
        // dd($validation->errors()); // retourne les messages d'erreur
        // dd($validation->validate());// retourne un tableau des champs qui ont été validés par les règles de validation

        // dd($validate->validated ());

        $articles =  Article::with("categorie", "etiquettes")->paginate(2);
        // return $articles;

        // Categorie::create([
        //     "nom" => "Telephones"
        // ]);

        // Categorie::create([
        //     "nom" => "Ordinateurs"
        // ]);

        // Categorie::create([
        //     "nom" => "Accessoires pour photographie"
        // ]);

        // Categorie::create([
        //     "nom" => "Meubles"
        // ]);

        // Categorie::create([
        //     "nom" => "Animes"
        // ]);

        // Categorie::create([
        //     "nom" => "Films"
        // ]);

        // Categorie::create([
        //     "nom" => "Series"
        // ]);

        // $a = Article::find(1);
        // $c = Categorie::find(5);

        // Récupération d'une catégories et de ses articles
        // dd($c->articles);

        // Ajouter une requete
        // dd($c->articles()->where("id", ">", "0")->get());


        // Associer ou dissocier un article àune catégorie
        // $a->categorie()->associate($c);
        // $a->categorie()->dissociate($c);
        // $a->save();

        // recupération des articles avec leur catégorie
        // $articles = Article::with("categorie")->get();

        // affecter à l'article la categorie d'id 1
        // $a->categorie_id = 1;
        // $a->save();

        // Récupération des informations sur la catégorie de l'article
        // dd($a->categorie->nom);

        // Création des Etiquettes liée à un articles
        // $a->etiquettes()->createMany([
        //     [
        //         "nom" => "Horreur"
        //     ],
        //     [
        //         "nom" => "Drame"
        //     ],
        //     [
        //         "nom" => "Action"
        //     ],
        //     [
        //         "nom" => "Aventure"
        //     ],
        //     [
        //         "nom" => "Drole"
        //     ],
        // ]);

        // Récupération des étiquettes associées à un article
        // dd($a->etiquettes);

        // Récupération des étiquettes associées à un article avec ajout des requetes
        //  dd($a->etiquettes->where("nom", "Aventure"));

        // // Détacher/dissocier une etiquette à un article prend en paramètre un id ouun tableau d'ids
        //  dd($a->etiquettes()->detach(3));
        // attacher/associer une etiquette à un article prend en paramètre un id ouun tableau d'ids
        //  dd($a->etiquettes()->attach(3));
        //  //Détacher si associer prend en paramètre un id ouun tableau d'ids
        //  dd($a->etiquettes()->sync(3));

        // Récupérer les articles qui ont au moins une etiquette
        // dd(Article::has("etiquettes", ">", 0)->get());



        // User::create([
        //     "name" => "Koybi",
        //     "email" => "koybi@gmail.com",
        //     "password" => Hash::make("koybi123")
        // ]);

        return view('article.index', [
            'articles' => $articles,
        ]);
    }

    // Laravel va trouver un model qui a l'id qui correspond à ce qui est passé
    // public function affiche(string $motif, string $id)
    public function affiche(string $motif, Article $article)
    {
        // dd($article);
        // $a = Article::findOrFail($id);
        // if ($a->motif != $motif) {
        //     return to_route('article.affiche', ["motif" => $a->motif, "article" => $a->id]);
        // }
        // // return $a;

        // return view("article.affiche", ["article" => $a]);

        if ($article->motif != $motif) {
            // return to_route('article.affiche', ["motif" => $a->motif, "id" => $a->id]);
            return to_route('article.affiche', ["motif" => $article->motif, "article" => $article->id]);
        }
        // return $a;

        return view("article.affiche", ["article" => $article]);
    }



    public function creation()
    {
        $categories = Categorie::select("id", "nom")->get();
        $etiquettes = Etiquette::select("id", "nom")->get();
        return view('article.creation', [
            "categories" => $categories,
            "etiquettes" => $etiquettes
        ]);
    }


    public function editer(Article $article)
    {
        $categories = Categorie::select("id", "nom")->get();
        $etiquettes = Etiquette::select("id", "nom")->get();
        return view('article.editer', [
            "article" => $article,
            "categories" => $categories,
            "etiquettes" => $etiquettes
        ]);
    }

    public function enregistrer(Request $request)
    {
        if (!empty($request->file('image_path'))) {
            $img = $request->file("image_path");

            $chemin_image = "uploads";

            $img->move($chemin_image, $img->getClientOriginalName());

            $validate = Validator::make(
                [
                    'titre' => $request->input("titre"),
                    'description' => $request->input("description"),
                    'auteur' => $request->input("auteur"),
                    'categorie_id' => $request->input("categorie_id"),
                    'motif' => $request->input("motif") ?? Str::slug($request->input("titre"), '-'),
                    'image_path' => "uploads/" . $img->getClientOriginalName(),
                    "etiquettes_id" => $request->input('etiquettes_id')
                ],
                [
                    "titre" => ["required", "min:5"],
                    "description" => ["required", "min:20"],
                    "auteur" => ["required"],
                    "motif" => ["min:5", "required", "regex:/^[a-z0-9\-]+$/"],
                    "categorie_id" => "required",
                    "image_path" => "required",
                    "etiquettes_id" => ["array", "exists:etiquettes,id", "required"]
                ]
            );

            $article = Article::create($validate->validated());
            $article->etiquettes()->sync($validate->validated()['etiquettes_id']);

            return redirect()->route("article.affiche", ["motif" => $article->motif, "article" => $article->id])->with('success', "l'article $article->titre a bien été créé !");
        } else {
            return redirect()->route("article.nouveau")->with("err", "Veillez choisir une image");
        }
    }

    public function edition(Article $article, Request $request)
    {

        if (!empty($request->file('image_path'))) {
            Storage::disk('public')->delete($article->image_path);
            $img = $request->file("image_path");

            $chemin_image = "uploads";

            $img->move($chemin_image, $img->getClientOriginalName());


            $image_path = "uploads/" . $img->getClientOriginalName();
        } else {
            $image_path = $article->image_path;
        }

        $validate = Validator::make(
            [
                'titre' => $request->input("titre"),
                'description' => $request->input("description"),
                'auteur' => $request->input("auteur"),
                'categorie_id' => $request->input("categorie_id"),
                'motif' => $request->input("motif") ?? Str::slug($request->input("titre"), '-'),
                'image_path' => $image_path,
                "etiquettes_id" => $request->input('etiquettes_id')
            ],
            [
                "titre" => ["required", "min:5"],
                "description" => ["required", "min:20"],
                "auteur" => ["required"],
                "motif" => ["min:5", "required", "regex:/^[a-z0-9\-]+$/"],
                "categorie_id" => ["required", "exists:categories,id"],
                "image_path" => "required",
                "etiquettes_id" => ["array", "exists:etiquettes,id", "required"]
            ]
        );

        // dd($validate->validated()['etiquettes_id']);

        $article->update($validate->validated());
        $article->etiquettes()->sync($validate->validated()['etiquettes_id']);

        return redirect()->route("article.affiche", ["motif" => $article->motif, "article" => $article->id])->with('success', "l'article $article->titre a bien été mis à jour !");
    }

    public function suprimer(Article $article)
    {
        $titre = $article->titre;
        Storage::disk('public')->delete($article->image_path);
        $article->delete();

        return redirect()->route("article.index")->with("success", "L'article $titre a bien été supprimer !");
    }
}
