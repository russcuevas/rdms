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
    {{-- Maps --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        .address {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 250px;
        }
    </style>
</head>

<body>
    <div id="loadingOverlay"
        style="
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
            <h4>Evacuation Site</h4>
        </div>

        {{-- ADD EVACUATION SITE --}}
        <div class="row g-4 mb-4">

            <div class="col-lg-4 col-md-12">
                <div class="card custom-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-4">Add Evacuation Site</h5>
                        <form action="{{ route('admin.evacuation.add') }}" method="POST" class="evacuationForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Site Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="number" class="form-label">Capacity</label>
                                <input type="text" class="form-control" name="capacity" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <div id="map" style="height: 300px;"></div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" class="form-control" name="lat" id="lat">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" class="form-control" name="lon" id="lon">
                                    </div>
                                </div>
                                <p id="address" class="form-control"
                                    style="background-color: #f8f9fa; min-height: 38px;"></p>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"
                                style="background-color: #1d4ed8; float: right;">Add Evacuation Site</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- EVACUATION LIST --}}
            <div class="col-lg-8 col-md-12">
                <div class="card custom-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-4">Evacuation List</h5>
                        <div class="table-responsive">
                            <table id="evacuationTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="d-none">Latitude</th>
                                        <th class="d-none">Longitude</th>
                                        <th>Address</th>
                                        <th>Capacity</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evacuationSites as $site)
                                        <tr>
                                            <td>{{ $site->name }}</td>
                                            <td class="lat d-none">{{ $site->lat }}</td>
                                            <td class="lon d-none">{{ $site->lon }}</td>
                                            <td class="address"
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 250px;">
                                                <span class="spinner-border spinner-border-sm text-primary me-1"></span>
                                            </td>

                                            <td>{{ $site->current_occupancy }}/{{ $site->capacity }}</td>
                                            <td>
                                                <span class="badge {{ $site->is_open ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $site->is_open ? 'Open' : 'Closed' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editEvacuationSiteModal{{ $site->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>

<form action="{{ route('admin.evacuation.delete', $site->id) }}"
      method="POST"
      style="display:inline-block;"
      onsubmit="return handleDelete(this);">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">
        <i class="fas fa-trash"></i>
    </button>
</form>

                                            </td>
                                        </tr>
                                        @include('admin.evacuation.edit_modal')
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

    {{-- Maps --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @foreach ($evacuationSites as $site)
        <script>
            $(document).ready(function() {
                var map{{ $site->id }} = L.map('mapEdit{{ $site->id }}').setView([{{ $site->lat }},
                    {{ $site->lon }}
                ], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map{{ $site->id }});

                var marker{{ $site->id }} = L.marker([{{ $site->lat }}, {{ $site->lon }}], {
                    draggable: true
                }).addTo(map{{ $site->id }});

                function updateLatLon{{ $site->id }}(lat, lon) {
                    $('#latEdit{{ $site->id }}').val(lat.toFixed(6));
                    $('#lonEdit{{ $site->id }}').val(lon.toFixed(6));
                    updateAddress{{ $site->id }}(lat, lon);
                }

                function updateAddress{{ $site->id }}(lat, lon) {
                    $.getJSON('https://nominatim.openstreetmap.org/reverse', {
                            format: 'jsonv2',
                            lat: lat,
                            lon: lon
                        })
                        .done(function(data) {
                            if (data.display_name) {
                                $('#addressEdit{{ $site->id }}').text(data.display_name);
                            } else {
                                $('#addressEdit{{ $site->id }}').text('Address not found');
                            }
                        })
                        .fail(function() {
                            $('#addressEdit{{ $site->id }}').text('Failed to fetch address');
                        });
                }

                updateAddress{{ $site->id }}({{ $site->lat }}, {{ $site->lon }});

                marker{{ $site->id }}.on('dragend', function() {
                    var pos = marker{{ $site->id }}.getLatLng();
                    updateLatLon{{ $site->id }}(pos.lat, pos.lng);
                });

                map{{ $site->id }}.on('click', function(e) {
                    marker{{ $site->id }}.setLatLng(e.latlng);
                    updateLatLon{{ $site->id }}(e.latlng.lat, e.latlng.lng);
                });

                $('#latEdit{{ $site->id }}, #lonEdit{{ $site->id }}').on('input', function() {
                    var lat = parseFloat($('#latEdit{{ $site->id }}').val());
                    var lon = parseFloat($('#lonEdit{{ $site->id }}').val());
                    if (!isNaN(lat) && !isNaN(lon)) {
                        marker{{ $site->id }}.setLatLng([lat, lon]);
                        map{{ $site->id }}.setView([lat, lon], map{{ $site->id }}.getZoom());
                        updateAddress{{ $site->id }}(lat, lon);
                    }
                });

                $('#editEvacuationSiteModal{{ $site->id }}').on('shown.bs.modal', function() {
                    setTimeout(function() {
                        map{{ $site->id }}.invalidateSize();
                    }, 200);
                });
            });
        </script>
    @endforeach

    {{-- LOADING --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.evacuationForm');
            const loadingOverlay = document.getElementById('loadingOverlay');

            form.addEventListener('submit', function () {
                loadingOverlay.style.display = 'flex';
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerText = 'Submitting...';
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loadingOverlay = document.getElementById('loadingOverlay');

            document.querySelectorAll('.evacuationForm, .editEvacuationForm')
                .forEach(form => {
                    form.addEventListener('submit', function () {

                        const modalElement = form.closest('.modal');

                        if (modalElement) {
                            const modalInstance = bootstrap.Modal.getInstance(modalElement)
                                || new bootstrap.Modal(modalElement);

                            modalInstance.hide();
                            modalElement.addEventListener('hidden.bs.modal', function () {
                                loadingOverlay.style.display = 'flex';
                            }, { once: true });

                        } else {
                            loadingOverlay.style.display = 'flex';
                        }

                        const submitBtn = form.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            submitBtn.innerText = 'Processing...';
                        }
                    });
                });
        });
    </script>

    <script>
        function handleDelete(form) {
            if (!confirm('Are you sure you want to delete this site?')) {
                return false;
            }

            document.getElementById('loadingOverlay').style.display = 'flex';

            const btn = form.querySelector('button[type="submit"]');
            if (btn) {
                btn.disabled = true;
            }

            return true;
        }
    </script>
    {{-- END LOADING --}}


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
            $('#evacuationTable').DataTable({
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

    <script>
        $(document).ready(function() {
            $('#evacuationTable tbody tr').each(function() {
                const $row = $(this);
                const lat = $row.find('.lat').text();
                const lon = $row.find('.lon').text();
                const $addressCell = $row.find('.address');

                $.getJSON('https://nominatim.openstreetmap.org/reverse', {
                        format: 'jsonv2',
                        lat: lat,
                        lon: lon
                    })
                    .done(function(data) {
                        if (data.display_name) {
                            $addressCell.text(data.display_name);
                            $addressCell.attr('title', data.display_name); // show full on hover
                        } else {
                            $addressCell.text('Address not found');
                        }
                    })
                    .fail(function() {
                        $addressCell.text('Failed to fetch address');
                    });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var map = L.map('map').setView([14.5995, 120.9842], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([14.5995, 120.9842], {
                draggable: true
            }).addTo(map);

            function updateLatLon(lat, lon) {
                $('#lat').val(lat.toFixed(6));
                $('#lon').val(lon.toFixed(6));
                updateAddress(lat, lon);
            }

            function updateAddress(lat, lon) {
                $.getJSON('https://nominatim.openstreetmap.org/reverse', {
                        format: 'jsonv2',
                        lat: lat,
                        lon: lon
                    })
                    .done(function(data) {
                        if (data.display_name) {
                            $('#address').text(data.display_name);
                        } else {
                            $('#address').text('Address not found');
                        }
                    })
                    .fail(function() {
                        $('#address').text('Failed to fetch address');
                    });
            }

            updateLatLon(marker.getLatLng().lat, marker.getLatLng().lng);
            marker.on('dragend', function() {
                var position = marker.getLatLng();
                updateLatLon(position.lat, position.lng);
            });
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateLatLon(e.latlng.lat, e.latlng.lng);
            });
            $('#lat, #lon').on('input', function() {
                var lat = parseFloat($('#lat').val());
                var lon = parseFloat($('#lon').val());

                if (!isNaN(lat) && !isNaN(lon)) {
                    var newLatLng = L.latLng(lat, lon);
                    marker.setLatLng(newLatLng);
                    map.setView(newLatLng, map.getZoom());
                    updateAddress(lat, lon);
                }
            });
        });
    </script>


</body>

</html>
