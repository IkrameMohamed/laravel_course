<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">laravel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Accueil</a>
                </li>

                @if(auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('profile.show')}}">
                            {{ auth()->user()->name }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('posts.create')}}">ajouter</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/register')}}">
                            Inscription</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/login')}}">
                            Connexion</a>
                    </li>
                @endif

            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Recherche</button>
            </form>
        </div>
    </div>
</nav>
