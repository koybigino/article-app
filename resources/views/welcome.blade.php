{{-- Permet d'étendre le fichier de base --}}
@extends('base')

{{-- Remplir la partie du titre --}}
@section('titre', 'Site de gestion des articles !')


{{-- Mettre du contenu dans la partie reservée  --}}
@section('contenu')

    <div class="container my-5">
        <div class="text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">Bienvenue Sur notre site de gestion d'article</h1>
            <p class="col-lg-8 mx-auto fs-5 text-muted">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates minus totam odit error libero deserunt
                ex, consectetur enim delectus, voluptas incidunt quaerat accusantium quia fugiat magnam quod, perspiciatis
                sequi quae!
            </p>
            <div class="d-inline-flex gap-2 mb-5">
                <a href="{{ route('article.index') }}"
                    class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                    Demarrer
                </a>
                <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                    A propos de nous
                </button>
            </div>
        </div>
    </div>

@endsection
