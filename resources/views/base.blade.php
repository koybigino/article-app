<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href={{ asset('bootstrap.min.css') }} rel="stylesheet">
    <title>@yield('titre')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'fw-bold' => request()->route()->getName() == 'article.index',
                        ]) aria-current="page" href="{{ route('article.index') }}">Home</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <div class="px-3">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item mx-2"><b>{{ Auth::user()->name }}</b></li>
                        <li class="nav-item">
                            <form action="{{ route('auth.logout') }}" method="post">
                                @method('delete')
                                @csrf

                                <button class="btn-sm btn-danger" type="submit">Deconnection</button>
                            </form>
                        </li>
                    @endauth

                    @if (!strstr(request()->route()->getName(), 'login'))
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('auth.login') }}" class="nav-link rounded text-white fw-bold btn-primary"
                                    type="submit">Se connecter</a>
                            </li>
                        @endguest
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        {{-- Prévoir une partie à remplir --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        @yield('contenu')
    </div>

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">
                &copy; 2023 Company, Inc
            </p>

            <a href="https://getbootstrap.com/"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">Features</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">Pricing</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">FAQs</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link px-2 text-body-secondary">About</a>
                </li>
            </ul>
        </footer>
    </div>
    <script src={{ asset('bootstrap.bundle.min.js') }}></script>
</body>

</html>
