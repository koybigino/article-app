@extends('base')

@section('titre', 'Edition de l\'article ' . $article->titre)


@section('contenu')

@php
    $etiquettesIDs = $article->etiquettes()->pluck('id')
@endphp

    <fieldset class="card p-5">
        <legend>
            <b>Modification de l'article {{ $article->titre }}</b>
        </legend>


        <div class="card col-md-3 m-5">
            <img src={{ asset($article->image_path) }} class="card-img-top" alt="...">
        </div>
        <form enctype="multipart/form-data" class="form-group mt-5" action="" method="post">
            @csrf

            <div class="input-group mb-3">
                <label class="form-label" for="image">Selectionner une image <b class="text-danger">*</b></label>
                <input name="image" type="file" class="form-control" id="image">
                @if (session('err'))
                    <b class="text-danger">
                        {{ session('err') }}
                    </b>
                @endif

            </div>

            <div class="mb-3">
                <label for="titre" class="form-label">Titre de l'article <b class="text-danger">*</b> </label>
                <input value="{{ old('titre', $article->titre) }}" id="titre" class="form-control" type="text"
                    name="titre" placeholder="Entrer le titre...">
                @error('titre')
                    <b class="text-danger">
                        {{ $message }}
                    </b>
                @enderror
            </div>

            <div class="mb-3">
                <label for="motif" class="form-label">Motif de l'article</label>
                <input value="{{ old('motif', $article->motif) }}" id="motif" class="form-control" type="text"
                    name="motif" placeholder="Entrer le titre...">
                @error('motif')
                    <b class="text-danger">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description de l'article <b class="text-danger">*</b></label>
                <textarea id="description" class="form-control" name="description" id="" cols="30" rows="10">{{ old('description', $article->description) }}</textarea>
                @error('description')
                    <b class="text-danger">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <div class="mb-3">
                <label for="categorie_id" class="form-label">Catégorie de l'article <b class="text-danger">*</b></label>
                <select id="categorie_id" class="form-select" name="categorie_id" cols="30" rows="10">
                    <option value="">Choisir une categorie...</option>
                    @foreach ($categories as $c)
                        {{-- @if ($c->id == $article->categorie_id)
                            <option selected value="{{ $c->id }}">{{ $c->nom }}</option>
                        @else
                            <option value="{{ $c->id }}">{{ $c->nom }}</option>
                        @endif --}}

                        <option @selected(old('categorie_id', $c->id == $article->categorie_id)) value="{{ $c->id }}">{{ $c->nom }}</option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <b class="text-danger">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <div class="mb-3">
                <label for="etiquettes_id" class="form-label">Etiquettes de l'article <b class="text-danger">*</b></label>
                <select multiple id="etiquettes_id" class="form-select" name="etiquettes_id[]" cols="30" rows="10">
                    @foreach ($etiquettes as $et)
                        {{-- @if ($c->id == $article->categorie_id)
                        <option selected value="{{ $c->id }}">{{ $c->nom }}</option>
                    @else
                        <option value="{{ $c->id }}">{{ $c->nom }}</option>
                    @endif --}}

                        <option @selected(old('etiquettes_id', $etiquettesIDs->contains($et->id))) value="{{ $et->id }}">{{ $et->nom }}</option>
                    @endforeach
                </select>
                @error('etiquettes_id')
                    <b class="text-danger">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <div class="mb-3">
                <label for="auteur" class="form-label">Auteur de l'article <b class="text-danger">*</b></label>
                <input value="{{ old('auteur', $article->auteur) }}" id="auteur" class="form-control" type="text"
                    name="auteur" placeholder="Entrer le titre...">
                @error('auteur')
                    <b class="text-danger">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </fieldset>

@endsection
