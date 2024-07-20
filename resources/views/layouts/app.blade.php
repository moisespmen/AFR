<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav row">
                        <li class="nav-item mt-2 col">
                            <RouterLink to="/">
                                <i class="fas fa-home"></i> Home
                            </RouterLink>
                        </li>
                        <li class="nav-item mt-2 col">
                            <RouterLink to="/arquivos">
                                <i class="fa-solid fa-file"></i> Arquivos
                            </RouterLink>
                        </li>
                        <li class="nav-item dropdown col col-md-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-user"></i> Acessar
                            </a>
                            <ul class="dropdown-menu" >
                                <li class="dropdown-item">
                                    <form class="px-4 py-3">
                                        <div class="mb-3">
                                            <label for="exampleDropdownFormEmail1" class="form-label">Login</label>
                                            <input type="email" class="form-control" id="exampleDropdownFormEmail1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleDropdownFormPassword1" class="form-label">Senha</label>
                                            <input type="password" class="form-control" id="exampleDropdownFormPassword1">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Acessar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
