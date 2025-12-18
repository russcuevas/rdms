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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/guest/style.css') }}">

    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

@include('admin.components.navbar')

<div class="main-content container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h4>Report Details</h4>
        <a href="{{ route('admin.reports.page') }}" class="btn btn-secondary btn-sm">
            ← Back
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">

            {{-- Map --}}
            <div id="map" class="mb-3 rounded" style="height: 400px;"></div>

            {{-- Image --}}
            @if ($report->image_url)
                <img src="{{ $report->image_url }}"
                     class="img-fluid mb-3 rounded"
                     style="max-height: 300px;">
            @endif

            {{-- Address --}}
            <p>
                <strong>Address:</strong>
                <span id="address" class="text-muted">Fetching address...</span>
            </p>

            <hr>

            <p><strong>Title:</strong> {{ $report->title }}</p>
            <p><strong>Description:</strong><br>{{ $report->description }}</p>

            <p><strong>Reported By:</strong>
                {{ $report->author_email ?? 'N/A' }}
            </p>

            {{-- STATUS CONTROL --}}
            <div class="row align-items-center mb-3">
                <div class="col-md-4">
                    <strong>Status:</strong>
                    <span id="statusBadge"
                          class="badge
                          {{ $report->status === 'verified' ? 'bg-info' :
                             ($report->status === 'resolved' ? 'bg-success' : 'bg-warning') }}">
                        {{ ucfirst($report->status) }}
                    </span>
                </div>

                <div class="col-md-4">
                    <select id="statusSelect" class="form-select">
                        <option value="">-- Change Status --</option>
                        <option value="verified">Verified</option>
                        <option value="resolved">Resolved</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <button id="updateStatusBtn" class="btn btn-primary w-100">
                        Update Status
                    </button>
                </div>
            </div>

            <p>
                <strong>Date:</strong>
                {{ \Carbon\Carbon::parse($report->created_at)->format('M d, Y h:i A') }}
            </p>

        </div>
    </div>

</div>

{{-- JQuery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- Leaflet --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- MAP + ADDRESS --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const lat = {{ $report->lat }};
    const lon = {{ $report->lon }};

    const map = L.map('map').setView([lat, lon], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, lon]).addTo(map).openPopup();

    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('address').innerText =
                data.display_name ?? 'Address not found';
        })
        .catch(() => {
            document.getElementById('address').innerText = 'Unable to fetch address';
        });
});
</script>

{{-- STATUS UPDATE --}}
<script>
document.getElementById('updateStatusBtn').addEventListener('click', function () {

    const status = document.getElementById('statusSelect').value;

    if (!status) {
        Swal.fire('Warning', 'Please select a status', 'warning');
        return;
    }

    Swal.fire({
        title: 'Confirm Update',
        text: `Change status to ${status.toUpperCase()}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, update',
        cancelButtonText: 'Cancel'
    }).then((result) => {

        if (result.isConfirmed) {
            fetch("{{ route('admin.reports.updateStatus', $report->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ status })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {

                    const badge = document.getElementById('statusBadge');
                    badge.innerText = data.status;

                    badge.className = 'badge ' +
                        (status === 'verified' ? 'bg-info' : 'bg-success');

                    Swal.fire('Updated!', 'Status updated successfully.', 'success');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Update failed', 'error');
            });
        }
    });
});
</script>

</body>
</html>
