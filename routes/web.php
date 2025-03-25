<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});




// Route qui utilise le nom d'une route pour générer son url
Route::get("/link", function (Request $request) {
    return route('larabel_cours.dynamique', ["motif" => 'formation-en-laravel', "id" => 12]);
});

Route::get("/link_test", function (Request $request) {
    return redirect('test');
});


// Route avec paramètres dans l'url
Route::get("/laravel_cours", function (Request $request) {
    return [
        // "name" => $_GET['name'],
        "name" => $request->input('name', 'John Doe'),
        "age" => $request->input('age', 'John Doe'),
        "Titre" => "Formation web fullstack en php",
    ];
})->name('larabel_cours');


// Route dynamique
Route::get("/laravel_cours/{motif}-{id}", function (string $motif, string $id) {
    return [
        "motif" => $motif,
        "id" => $id
    ];
})->where([
    'id' => '[0-9]+',
    'param' => '[a-z0-9\-]+'
])->name('larabel_cours.dynamique');

// Route avec controller
Route::prefix("/article")->name('article.')->controller(ArticleController::class)->group(function () {
    // Route avec paramètres dans l'url
    Route::get("/",'index')->name('index');
    // Route::get("/", [ArticleController::class, 'index'])->name('index');


    // Route dynamique
    // Route::get("/{motif}-{id}", 'affiche')->where([
    //     'id' => '[0-9]+',
    //     'motif' => '[a-z0-9\-]+'
    // ])->name('affiche');

    
    Route::get("/{motif}-{article}", 'affiche')->where([
        'id' => '[0-9]+',
        'motif' => '[a-z0-9\-]+'
    ])->name('affiche');

    Route::get("/nouveau", "creation")->name("nouveau")->middleware('auth');
    Route::post("/nouveau", "enregistrer")->middleware('auth');

    Route::get("/editer/{article}", "editer")->name("editer")->middleware('auth');
    Route::post("/editer/{article}", "edition")->middleware('auth');

    Route::get("/suprimer/{article}", "suprimer")->name("suprimer")->middleware('auth');
});

Route::get("/login", [AuthController::class, 'login'])->name('auth.login');
Route::post("/login", [AuthController::class, 'seLoger']);
Route::delete("/logout", [AuthController::class, 'deconnection'])->name('auth.logout');
