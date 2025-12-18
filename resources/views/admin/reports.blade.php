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
    {{-- Data Table --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

</head>

<body>
    <div id="loadingOverlay" style="
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1055;
    justify-content: center;
    align-items: center;
">
    <div class="spinner-border" role="status" style="width: 3rem; height: 3rem; color: #1d4ed8 !important;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
    @include('admin.components.navbar')

    <div class="main-content">

        <div class="row mb-4">
            <h4>Reports</h4>
        </div>

        <div class="row g-4 mb-4">
            {{-- REPORTS LIST --}}
            <div class="col-lg-12 col-md-12">
                <div class="card custom-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-4">Reports List</h5>
                        <div class="table-responsive">
                            <table id="reportsTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image URL</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Long</th>
                                        <th>Lat</th>
                                        <th>By</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            <tbody>
                            @foreach ($reports as $report)
                                <tr>

                                    {{-- Image --}}
                                    <td>
                                        @if ($report->image_url)
                                            <img src="{{ $report->image_url }}"
                                                alt="Report Image"
                                                width="60"
                                                class="img-thumbnail">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>

                                    {{-- Title --}}
                                    <td>{{ $report->title }}</td>

                                    {{-- Body --}}
                                    <td>{{ \Illuminate\Support\Str::limit($report->description, 50) }}</td>

                                    {{-- Longitude --}}
                                    <td>{{ $report->lon }}</td>

                                    {{-- Latitude --}}
                                    <td>{{ $report->lat }}</td>

                                    {{-- Author --}}
                                    <td>{{ $report->author_name ?? $report->author_email ?? 'N/A' }}</td>

                                    {{-- Date --}}
                                    <td>{{ \Carbon\Carbon::parse($report->created_at)->format('M d, Y') }}</td>

                                    {{-- Status --}}
                                    <td>
                                        <span class="badge
                                            {{ $report->status === 'pending' ? 'bg-warning' : 
                                            ($report->status === 'resolved' ? 'bg-success' : 
                                            ($report->status === 'verified' ? 'bg-info' : 'bg-secondary')) }}">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    {{-- JQuery FIRST --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('form')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            timeOut: 4000,
            positionClass: "toast-top-right"
        };

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <script>
        $(document).ready(function() {
            $('#reportsTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                searching: true,
                responsive: true,
                columnDefs: [{
                    orderable: false,
                    targets: 5
                }]
            });
        });
    </script>
   




</body>

</html>
