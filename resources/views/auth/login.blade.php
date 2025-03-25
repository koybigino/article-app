@extends('base')

@section('titre', 'Page de connexion')


@section('contenu')
    <fieldset class="card p-2 mt-5 px-5">
        <legend>
            <b>Se Connecter</b>
        </legend>
        <form enctype="multipart/form-data" class="form-group mt-2" action="" method="post">
            @csrf
            @error('err')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-3 form-group">
                <label for="email" class="form-label">Email<b class="text-danger">*</b> </label>
                <input value="{{ old('email') }}" id="email" class="form-control" type="email" name="email"
                    placeholder="email@gmail.com">

                @error('email')
                    <b class="text-danger">
                        {{ $message }}
                    </b>
                @enderror
            </div>

            <div class="mb-3 form-group">
                <label for="password" class="form-label">Mot de passe<b class="text-danger">*</b></label>
                <input id="password" class="form-control" type="password" name="password">

                @error('password')
                    <b class="text-danger">
                        {{ $message }}
                    </b>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Connection</button>
        </form>
    </fieldset>
@endsection
