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
            <h4>Announcement</h4>
        </div>

        {{-- ADD ANNOUNCEMENT --}}
        <div class="row g-4 mb-4">

            <div class="col-lg-4 col-md-12">
                <div class="card custom-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-4">Add Announcement</h5>

<form action="{{ route('admin.announcement.add') }}" method="POST" novalidate class="announcementForm">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea name="body" id="body" rows="3" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select name="priority" id="priority" class="form-select" required>
                                    <option value="normal">Normal</option>
                                    <option value="high">High</option>
                                    <option value="critical">Critical</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" style="background-color: #1d4ed8 !important; float: right;">Add Announcement</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ANNOUNCEMENT LIST --}}
            <div class="col-lg-8 col-md-12">
                <div class="card custom-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-4">Announcement List</h5>
                        <div class="table-responsive">
                            <table id="announcementsTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Priority</th>
                                        <th>Author</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($announcements as $announcement)
                                        <tr>
                                            <td>{{ $announcement->title }}</td>
                                            <td>{{ Str::limit($announcement->body, 50) }}</td>
                                            <td>
                                            <span class="badge 
                                                @if($announcement->priority === 'critical') 
                                                    bg-danger
                                                @elseif($announcement->priority === 'high') 
                                                    bg-warning
                                                @else 
                                                    bg-success
                                                @endif">
                                                {{ ucfirst($announcement->priority) }}
                                            </span>

                                            </td>
                                            <td>{{ $announcement->author }}</td>
                                            <td>{{ \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y') }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editAnnouncementModal{{ $announcement->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <form
                                                    action="{{ route('admin.announcements.destroy', $announcement->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('admin.announcement.edit_modal')
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
            $('#announcementsTable').DataTable({
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
    <script>
        $(document).ready(function() {
            $('.announcementForm').on('submit', function(e) {
                if (this.checkValidity() === false) {
                    return;
                }

                $(this).closest('.modal').modal('hide');
                $('#loadingOverlay').css('display', 'flex');
                $(this).find('button[type="submit"]').attr('disabled', true);
            });

            $(window).on('load', function() {
                $('#loadingOverlay').hide();
            });
        });
    </script>



</body>

</html>
