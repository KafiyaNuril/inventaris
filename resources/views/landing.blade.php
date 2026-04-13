<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    
    <nav class="navbar fixed-top shadow-sm bg-body rounded">
        <div class="container-fluid mx-3 my-2">
            <span class="navbar-brand fw-bold">Inventory App</span>
            @auth
                <a href="{{route('dashboard')}}" type="button" class="btn btn-primary me-5 px-4">Go to Dashboard</a>
            @endauth
            @guest
                <button type="button" class="btn btn-primary me-5 px-4" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Login</button>
            @endguest
        </div>
    </nav>
    <div class="vh-100 bg-primary d-flex align-items-center justify-content-center mt-5">
        <div>
            <div class="text-center text-white">
                <h1 class="fw-bold">Inventory Management</h1>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, voluptatum.</p>
            </div>
        </div>
    </div>

    <div class="container w-75 mb-5">
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
            <div class="col text-center">
                <div class="p-3 border rounded shadow-sm bg-white">
                    <img src="{{ asset('assets/img/item_data.jpg') }}" class="img-fluid rounded mb-2" alt="item_data">
                    <p class="mb-0 fw-bold">Item Data</p>
                </div>
            </div>
            <div class="col text-center">
                <div class="p-3 border rounded shadow-sm bg-white">
                    <img src="" class="img-fluid rounded mb-2" alt="item_data">
                    <p class="mb-0 fw-bold">Item Data</p>
                </div>
            </div>
            <div class="col text-center">
                <div class="p-3 border rounded shadow-sm bg-white">
                    <img src="" class="img-fluid rounded mb-2" alt="item_data">
                    <p class="mb-0 fw-bold">Item Data</p>
                </div>
            </div>
            <div class="col text-center">
                <div class="p-3 border rounded shadow-sm bg-white">
                    <img src="" class="img-fluid rounded mb-2" alt="item_data">
                    <p class="mb-0 fw-bold">Item Data</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5">
        <div class="border-top d-flex justify-content-between align-items-center pe-5 py-4">
            <div class="w-25 text-center">
                <img src="" class="rounded w-25 mx-auto" alt="...">
                <p class="fw-bold text-secondary">SMK Wikrama Bogor</p>
                <p class="mb-0 text-secondary">0251-8242411</p>
                <p class="text-secondary">smkwikrama@sch.id</p>
            </div>
            <div class="d-flex justify-content-between w-50">
                <div class="row">
                    <h4>Our Guidlines</h4>
                    <a>Terms</a>
                    <a>Privacy Policy</a>
                    <a>Cookie Policy</a>
                    <a>Discover</a>
                </div>
                <div class="row w-50">
                    <h4>Our Address</h4>
                    <a>Jl. Raya Wangun Kelurahan Sindangsari Bogor Timur 16720</a>
                    <div class="dflex justify-content-around">
                        <a href="https://www.facebook.com/smkwikrama" class="text-decoration-none btn"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="https://www.instagram.com/smkwikrama/" class="text-decoration-none btn"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="https://www.youtube.com/@smkwikrama" class="text-decoration-none btn"><i class="bi bi-youtube fs-5"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- modal --}}
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    @if (Session::get('failed'))
                        <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                    @endif

                    @if (Session::get('canAccess'))
                        <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
                    @endif
                    <div class="modal-header">
                        <h1 class="modal-title">Login</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($errors->any() || session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>