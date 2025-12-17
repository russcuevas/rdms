<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resilio</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/guest/style.css') }}">
    {{-- Toast CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>
    @include('admin.components.navbar')

    <div class="main-content">

        <div class="row mb-4">
            <h4>Dashboard</h4>
        </div>

        <div class="row g-4 mb-4">

            <!-- SUMMARY BOXES -->
            <div class="col-lg-4 col-md-6">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Admins</h5>
                        <h2 class="card-text">{{ $totalAdmins ?? 0 }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Citizens</h5>
                        <h2 class="card-text">{{ $totalCitizens ?? 0 }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Evacuation Sites</h5>
                        <h2 class="card-text"></h2>
                    </div>
                </div>
            </div>

        </div>

        <!-- RECENT NOTIFICATIONS -->
        <div class="row g-4 mb-4">

            <div class="col-lg-6 col-md-12">
                <div class="card custom-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-4">Recent Notifications</h5>

                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0">
                                <div class="d-flex justify-content-between">
                                    <strong></strong>
                                    <small class="text-muted"></small>
                                </div>
                                <p class="mb-1">
                                    <strong></strong> at
                                    <span class="text-primary"></span>
                                </p>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MAPS -->
            <div class="col-lg-6 col-md-12">
                <div class="card custom-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-4">Maps Incidents</h5>
                        <div id="map"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- JQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- Toast JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            timeOut: 4000,
            positionClass: "toast-top-right"
        };

        // Success message
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        // Error messages (from validation or other errors)
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

</body>

</html>
