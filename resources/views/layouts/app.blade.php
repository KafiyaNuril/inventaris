<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">Navbar</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-dark">Logout</button>
            </form>
        </div>
    </nav>
    
    <div class="row">
        <ul class="col-2 nav flex-column border-end fs-6 ps-4">
            @auth
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link text-dark" href="{{ route('category.index') }}">Categeory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('item.index') }}">Item</a>
                    </li>
                    <li class="nav-item dropdown-center">
                        <a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-person-fill"></i> User
                        </a>
                        <ul class="dropdown-menu bg-transparent border-0 shadow-none">
                            <li>
                                <a class="dropdown-item {{ request('role') == 'admin' ? 'muted' : '' }}" href="{{ route('user.index', ['role' => 'admin']) }}">
                                    Admin
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('user.index', ['role' => 'operator']) }}">
                                    Operator
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('lending.index') }}">Lending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('item.index') }}">Item</a>
                    </li>
                    <li class="nav-item dropdown-center">
                        <a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-person-fill"></i> User
                        </a>
                        <ul class="dropdown-menu bg-transparent border-0 shadow-none">
                            <a class="dropdown-item" href="{{ route('user.edit', auth()->id() ) }}">
                                Edit
                            </a>
                        </ul>
                    </li>
                @endif
            @endauth

        </ul>
        <div class="col-10 mt-3 pe-4">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>