@include('layout.header')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div id="layoutAuthentication_content">
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                    <div class="card shadow-lg border-0 rounded-3 mt-5 mb-4">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                @php
                                $logo = App\Models\sekolah::all();
                                @endphp
                                @if ($logo->isNotEmpty())
                                @foreach ($logo as $logo)
                                <div class="mb-3">
                                    <!-- Center the logo and ensure it resizes well -->
                                    <img src="{{ asset('logo/' . $logo->logo_sekolah) }}" alt="Logo" class="img-fluid" style="max-height: 60px; display: block; margin-left: auto; margin-right: auto;">
                                </div>
                                @endforeach
                                @endif
                                <h1 class="display-5 mb-3">Login</h1>
                            </div>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $item)
                                <p>{{ $item }}</p>
                                @endforeach
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <form action="{{ route('sipensi.login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="username" class="form-label">User Name</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="(Guru Piket, Kesiswaan, Wali Kelas, Kepala Sekolah)" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password (Kode Keamanan)</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                            <script>
                                const togglePassword = document.querySelector("#togglePassword");
                                const password = document.querySelector("#password");

                                togglePassword.addEventListener("click", function() {
                                    const type = password.getAttribute("type") === "password" ? "text" : "password";
                                    password.setAttribute("type", type);
                                    this.innerHTML = type === "password" ?
                                        '<i class="fa fa-eye"></i>' :
                                        '<i class="fa fa-eye-slash"></i>';
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@include('layout.footer')
