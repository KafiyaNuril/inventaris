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
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    
    <div class="row">
        <ul class="col-2 nav flex-column border-end fs-6 ps-4">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
            </li>
            <li class="nav-item"> 
                <a class="nav-link" href="{{ route('category.index') }}">Categeory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('item.index') }}">Item</a>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn ms-1 border-white dropdown-toggle" type="button" data-bs-toggle="dropdown"">
                        User
                    </button>
                    <ul class="dropdown-menu border-white ms-3 ">
                        <li><a class="dropdown-item" href="{{ route('user.index') }}">Admin</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.index') }}">Operator</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="col-10 mt-3 pe-4">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>