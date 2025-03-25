@extends('base')

@section('titre', 'Affichage de l\'article ' . $article->titre)


@section('contenu')

    <div class="mt-5">
        <img src={{ asset($article->image_path) }} class="card-img-top" alt="...">
        <div class="card-body">
            <h1 class="card-title"><b>Titre :</b>{{ $article->titre }}</h1>
            <p class="card-text"><b>Description :</b> {{ $article->description }}</p>
            <p class="card-text"> <b>Auteur :</b> {{ $article->auteur }}</p>
            <p class="card-text"> <b>Categories :</b> {{ $article->categorie->nom }}</p>
            <p class="card-text"><b>Etiquettes : </b>
                @foreach ($article->etiquettes as $et)
                    <span class="badge bg-dark">{{ $et->nom }}</span>
                @endforeach
            </p>
        </div>
    </div>

@endsection
