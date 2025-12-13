<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MDRRMO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/guest/style.css') }}">
</head>
<body>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
        <div class="offcanvas-header pb-0">
            <h4 class="px-4" id="sidebarOffcanvasLabel" style="color:#0d6efd; font-weight:700;">
                <span class="nav-icon me-2">
                    <i class="fa-solid fa-cloud-rain"></i> 
                </span>
                MDRRMO
            </h4>
            <button type="button" class="btn-close text-reset me-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column mb-auto"> 
                <li class="nav-item">
                    <a class="nav-link nav-link-custom active" href="#">
                        <span class="nav-icon"><i class="fa-solid fa-table-cells-large"></i></span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="#">
                        <span class="nav-icon"><i class="fa-solid fa-lightbulb"></i></span>
                        AI Forecast
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="#">
                        <span class="nav-icon"><i class="fa-solid fa-water"></i></span>
                        Flood Risk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="#">
                        <span class="nav-icon"><i class="fa-solid fa-wave-square"></i></span>
                        Earthquakes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="#">
                        <span class="nav-icon"><i class="fa-solid fa-gear"></i></span>
                        Settings
                    </a>
                </li>
            </ul>
            </div>
    </div>


    <div class="sidebar-desktop">
        <h4 class="px-4 mb-4" style="color:#0d6efd; font-weight:700;">
            <span class="nav-icon me-2">
                <i class="fa-solid fa-cloud-rain"></i> 
            </span>
            MDRRMO
        </h4>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link nav-link-custom active" href="#">
                    <span class="nav-icon"><i class="fa-solid fa-table-cells-large"></i></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="#">
                    <span class="nav-icon"><i class="fa-solid fa-lightbulb"></i></span>
                    AI Forecast
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="#">
                    <span class="nav-icon"><i class="fa-solid fa-water"></i></span>
                    Flood Risk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="#">
                    <span class="nav-icon"><i class="fa-solid fa-wave-square"></i></span>
                    Earthquakes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="#">
                    <span class="nav-icon"><i class="fa-solid fa-gear"></i></span>
                    Settings
                </a>
            </li>
        </ul>
        </div>

    <nav class="top-navbar sticky-top p-3">
        <div class="d-flex justify-content-between align-items-center">

            <button class="navbar-toggler d-lg-none p-0 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars fa-lg"></i>
            </button>

            <h5 class="mb-0 text-muted d-none d-lg-block"></h5>

            <div class="dropdown">
                <button class="btn btn-outline-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="User Profile">
                    <i class="fa-regular fa-user profile-dropdown-icon"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><h6 class="dropdown-header">Welcome, User!</h6></li>
                    <li><a class="dropdown-item" href="#">
                        <i class="fa-solid fa-id-badge me-2"></i> Profile
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#">
                        <i class="fa-solid fa-sign-out-alt me-2"></i> Logout
                    </a></li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="main-content flex-grow-1">
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="search-bar-container d-flex align-items-center">
                    <i class="fa-solid fa-magnifying-glass mx-3 text-muted"></i>
                    <input type="text" class="form-control search-input" placeholder="Search city...">
                    <button class="btn btn-primary search-button me-1">Search</button>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-5 col-md-12">
                <div class="card custom-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-4">Current Weather</h5>
                        <h3 class="card-subtitle mb-3">**Batangas, Philippines**</h3>
                        <div class="d-flex align-items-center mb-4">
                            <span style="font-size: 3rem; color: #ffc107; margin-right: 15px;">
                                <i class="fa-solid fa-sun"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <span class="weather-value">28&deg;</span>
                                <p class="text-muted mb-0">Partly Cloudy</p>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between pt-3">
                            <div class="weather-detail-card flex-fill">
                                <span class="weather-detail-icon"><i class="fa-solid fa-droplet"></i></span>
                                <p class="mb-0 mt-1">**77%**</p>
                                <small class="text-muted">HUMIDITY</small>
                            </div>
                            <div class="weather-detail-card flex-fill">
                                <span class="weather-detail-icon"><i class="fa-solid fa-wind"></i></span>
                                <p class="mb-0 mt-1">**17.3**</p>
                                <small class="text-muted">KM/H WIND</small>
                            </div>
                            <div class="weather-detail-card flex-fill">
                                <span class="weather-detail-icon"><i class="fa-solid fa-temperature-three-quarters"></i></span>
                                <p class="mb-0 mt-1">**32&deg;**</p>
                                <small class="text-muted">FEELS LIKE</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="card custom-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-4">24-Hour Forecast</h5>
                        <div style="height: 200px; background-color: #f8f9fa; border-radius: 10px; position: relative;">
                            <svg width="100%" height="100%" viewBox="0 0 500 200" preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="chartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#0d6efd; stop-opacity:0.6" />
                                        <stop offset="100%" style="stop-color:#0d6efd; stop-opacity:0.05" />
                                    </linearGradient>
                                </defs>
                                <path d="M0 160 C 50 140, 100 120, 150 100 S 250 80, 300 90 T 400 120 L 500 130 V 200 H 0 Z" fill="url(#chartGradient)" stroke="#0d6efd" stroke-width="2"/>
                                <polyline points="0,160 50,140 100,120 150,100 200,80 250,80 300,90 350,110 400,120 450,125 500,130" fill="none" stroke="#0d6efd" stroke-width="2" />
                            </svg>
                            <div class="d-flex justify-content-between px-2 pt-2" style="position: absolute; bottom: 0; left: 0; right: 0; font-size: 0.75rem; color: #6c757d;">
                                <span>01:00</span><span>03:00</span><span>06:00</span><span>09:00</span><span>11:00</span><span>13:00</span><span>15:00</span><span>17:00</span><span>19:00</span><span>21:00</span><span>23:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-5 col-md-12">
                <div class="card custom-card recent-earthquakes-card">
                    <div class="card-body">
                        <h5 class="card-title text-muted mb-3">Flood Risk Assessment</h5>
                        <p class="fs-4 mb-2">Risk Level: <span class="text-success">**Low**</span></p>
                        <p class="text-muted">River Discharge Forecast ($m^3/s$)</p> 
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="card custom-card recent-earthquakes-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title text-muted mb-0">Recent Earthquakes (Global)</h5>
                            <button class="btn btn-sm btn-link text-muted" title="Refresh">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </button>
                        </div>
                        
                        <div class="border-start border-3 border-danger ps-3 py-2 mb-2">
                            <p class="mb-0 fs-5">**4.9**</p>
                            <small class="text-muted">Izu Islands, Japan region</small><br>
                            <small class="text-muted">Nov 22, 09:06 | Depth: 10 km</small>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>