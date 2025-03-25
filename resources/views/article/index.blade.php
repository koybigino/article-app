{{-- Permet d'étendre le fichier de base --}}
@extends('base')

{{-- Remplir la partie du titre --}}
@section('titre', 'Liste des articles')


{{-- Mettre du contenu dans la partie reservée  --}}
@section('contenu')
    <div class="container my-5">
        <div class="text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">Articles disponibles</h1>
        </div>

        @auth
            <div class="position-relative mb-0">
                <div class="position-absolute bottom-0 end-0">
                    <a href={{ route('article.nouveau') }} class="btn btn-primary">Ajout d'un article</a>
                </div>
            </div>
        @endauth

        <div class="row my-5 justify-content-between gap-5">
            @foreach ($articles as $article)
                <div class="card col-md-5">
                    <img class="w-100" src={{ asset($article->image_path) }} class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> <b>Titre : </b> {{ $article->titre }}</h5>
                        <p class="card-text"><b>Description :</b> {{ $article->description }}</p>
                        <p class="small"><b>Categorie : </b>{{ $article->categorie?->nom }}</p>
                        <p class="small"><b>Etiquettes : </b>
                            @foreach ($article->etiquettes as $et)
                                <span class="badge bg-dark">{{ $et->nom }}</span>
                            @endforeach
                        </p>
                        {{-- <a href={{route('article.affiche', ['motif'=> $article->motif, 'id' => $article->id])}} class="btn btn-primary">Voir plus -></a> --}}
                        <a href={{ route('article.affiche', ['motif' => $article->motif, 'article' => $article]) }}
                            class="btn btn-primary"><b>Voir plus -></b></a>

                        @auth
                            <a href={{ route('article.editer', ['article' => $article->id]) }}
                                class="btn btn-warning m-1 p-1"><span class="badge text-bg-warning">Editer</span></a>
                            <a href={{ route('article.suprimer', ['article' => $article->id]) }}
                                class="btn btn-danger m-1 p-1"><span class="badge text-bg-danger">Supprimer</span></a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        {{ $articles->links() }}

    @endsection
