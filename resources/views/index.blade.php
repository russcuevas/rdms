<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resilio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body {
            font-family: Poppins, -apple-system, BlinkMacSystemFont,
                "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        #map {
            height: 500px;
        }
    </style>

</head>

<body class="bg-slate-50 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <!-- Logo & Brand -->
            <div class="flex items-center gap-3 font-bold transition duration-300 group">
                <span class="text-2xl text-blue-700 group-hover:text-blue-800 transition-colors duration-300">
                    Resilio
                </span>
            </div>

            <!-- Login Button -->
            <a href="{{ route('login') }}"
                class="bg-blue-700 text-white px-4 py-2 rounded-full text-sm font-medium 
                   hover:bg-blue-800 transition-colors duration-300">
                Login
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 text-center">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Resilio Logo" class="w-20 h-20">
        </div>

        <h1 class="text-3xl md:text-4xl font-bold mb-4">
            Municipal Disaster Risk Reduction<br />
            Management Office
        </h1>

        <p class="text-gray-600 max-w-2xl mx-auto mb-8">
            Connecting the community with timely alerts, incident reporting,
            and responsive coordination.
        </p>
    </section>

    <!-- Evacuation Sites Map -->
    <section class="max-w-7xl mx-auto px-6 pb-20">
        <h2 class="text-2xl font-bold text-center mb-10">Evacuation Sites</h2>
        <div id="map" class="rounded-xl shadow-sm border"></div>
    </section>
    <!-- Highlights -->
    <section class="max-w-7xl mx-auto px-6 pb-20">
        <h2 class="text-2xl font-bold text-center mb-10">Highlights</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                    🔔
                </div>
                <h3 class="font-semibold mb-2">Real-time Alerts</h3>
                <p class="text-sm text-gray-600">
                    Receive and manage disaster and incident alerts with updated
                    locations and status.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                    📝
                </div>
                <h3 class="font-semibold mb-2">Incident Reporting</h3>
                <p class="text-sm text-gray-600">
                    Streamlined reporting and logs to ensure accurate data for rapid response.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                    👥
                </div>
                <h3 class="font-semibold mb-2">Team Coordination</h3>
                <p class="text-sm text-gray-600">
                    Coordinate responders and resources with a modern, easy-to-use dashboard.
                </p>
            </div>
        </div>
    </section>



    <!-- Leaflet JS -->
    <script>
        var map = L.map('map').setView([12.8797, 121.7740], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var sites = @json($sites);

        function isInPhilippines(lat, lon) {
            return lat >= 4.5 && lat <= 21.0 && lon >= 116.0 && lon <= 127.0;
        }

        function addPulsingMarker(lat, lon, options) {
            var circle = L.circleMarker([lat, lon], {
                color: options.color || 'green',
                fillColor: options.fillColor || 'green',
                fillOpacity: 0.5,
                radius: options.radius || 10
            }).addTo(map);

            if (options.pulse) {
                var growing = true;
                var radius = circle.getRadius();
                setInterval(function() {
                    if (growing) {
                        radius += 1;
                        if (radius >= 16) growing = false;
                    } else {
                        radius -= 1;
                        if (radius <= 10) growing = true;
                    }
                    circle.setRadius(radius);
                }, 80);
            }

            return circle;
        }


        sites.forEach(function(site) {
            if (isInPhilippines(site.lat, site.lon)) {
                var marker = addPulsingMarker(site.lat, site.lon, {
                    pulse: site.is_open,
                    color: site.is_open ? 'green' : 'red',
                    fillColor: site.is_open ? 'green' : 'red',
                    radius: 10
                });

                var popupContent = `
            <b>${site.name}</b><br>
            Capacity: ${site.capacity}<br>
            Current Occupancy: ${site.current_occupancy}<br>
            Status: ${site.is_open ? 'Open' : 'Closed'}<br>
            <p>${site.description}</p>
        `;
                marker.bindPopup(popupContent);
            }
        });
    </script>

</body>

</html>
