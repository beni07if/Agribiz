@extends('layout.app')

@section('content')
    <main class="main">

        @include('headerSection.headerSubsidiary')

        <!-- Service Details Section -->
        <section id="service-details" class="service-details section">
            <div class="container">
                @if(isset($companyOwnership) && count($companyOwnership) > 0)
                    @foreach($companyOwnership->groupBy('group_name') as $groupRows)
                        <div class="row gy-5">
                            <div class="col-lg-8">
                                <div class="service-content">
                                    <div class="service-header">
                                        <h2>Company Summary</h2>
                                        <p class="service-intro"></p>
                                    </div>
                                </div>
                                <div class="service-sidebar">
                                    <div class="service-info card shadow-sm p-4 rounded-3">
                                        @if($companyOwnership->isNotEmpty() || $consolidations->isNotEmpty())
                                            <h4 class="mb-4 fw-bold">General Information</h4>

                                            <div class="row info-list">
                                                <!-- Kolom kiri -->
                                                <div class="col-md-6">
                                                    @php
                                                        $leftFields = [
                                                            'company_name' => 'Company Name',
                                                            'company_type' => 'Company Type',
                                                            'group_name' => 'Group', // dari consolidations
                                                            'nature_of_business' => 'Nature of Business',
                                                        ];
                                                    @endphp

                                                    @foreach($leftFields as $field => $label)
                                                        <div class="info-item border-bottom py-3">
                                                            <span class="info-label d-block text-muted small">{{ $label }}</span>

                                                            @php
                                                                $values = ($field === 'group_name')
                                                                    ? $consolidations->pluck('group_name')->unique()->filter()
                                                                    : $companyOwnership->pluck($field)->unique()->filter();
                                                            @endphp

                                                            @if($values->isNotEmpty())
                                                                @foreach($values as $value)
                                                                    <span class="info-value d-block fw-bold">
                                                                        {!! nl2br(e($value)) !!}
                                                                    </span>
                                                                @endforeach
                                                            @else
                                                                <span class="info-value d-block text-secondary">-</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Kolom kanan -->
                                                <div class="col-md-6">
                                                    @php
                                                        $rightFields = [
                                                            'country_of_business_address' => 'Country of Business Address',
                                                            'business_address' => 'Business Address',
                                                            'country_operation' => 'Country Operation', // dari consolidations
                                                        ];
                                                    @endphp

                                                    @foreach($rightFields as $field => $label)
                                                        <div class="info-item border-bottom py-3">
                                                            <span class="info-label d-block text-muted small">{{ $label }}</span>

                                                            @php
                                                                $values = ($field === 'country_operation')
                                                                    ? $consolidations->pluck('country_operation')->unique()->filter()
                                                                    : $companyOwnership->pluck($field)->unique()->filter();
                                                            @endphp

                                                            @if($values->isNotEmpty())
                                                                @foreach($values as $value)
                                                                    <span class="info-value d-block fw-bold">
                                                                        {!! nl2br(e($value)) !!}
                                                                    </span>
                                                                @endforeach
                                                            @else
                                                                <span class="info-value d-block text-secondary">-</span>
                                                            @endif
                                                        </div>
                                                    @endforeach

                                                    <!-- Principal Activity pakai $consolidations -->
                                                    <div class="info-item border-bottom py-3">
                                                        <span class="info-label d-block text-muted small">Main Activity</span>

                                                        @php
                                                            $acts = $consolidations->pluck('principal_activities')
                                                                ->filter()
                                                                ->unique()
                                                                ->values();
                                                        @endphp

                                                        @if($acts->isNotEmpty())
                                                            <div class="d-flex flex-wrap gap-2 mt-2">
                                                                @foreach($acts as $activity)
                                                                    <span class="badge bg-info rounded-pill">{{ $activity }}</span>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <span class="info-value d-block text-secondary">-</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-muted">No general information available.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="service-content">
                                    <div class="service-features">
                                        <h4 class="card-title">Shareholders</h4>

                                        <div class="row gy-3">
                                            @php
                                                // Hilangkan duplikat berdasarkan nama
                                                $uniqueOwnerships = $companyOwnership->unique(fn($item) => trim($item->shareholder_name));

                                                // Daftar kata kunci perusahaan (bisa ditambah sesuai kebutuhan)
                                                $companyIndicators = [
                                                    '/^PT\b/i',
                                                    '/\bLtd$/i',
                                                    '/\bLtda$/i',
                                                    '/\bCV\b/i',
                                                    '/\bBhd$/i',
                                                    '/\bInc$/i',
                                                    '/\bB\.V$/i',
                                                    '/\bN\.V$/i',
                                                    '/\bLimited$/i',
                                                    '/\bC\.V$/i',
                                                    '/\bS\.A$/i',
                                                    '/\bS\.A\.S$/i'
                                                ];

                                                // Fungsi untuk cek apakah shareholder adalah perusahaan
                                                function isCompany($name, $companyIndicators)
                                                {
                                                    foreach ($companyIndicators as $pattern) {
                                                        if (preg_match($pattern, $name)) {
                                                            return true;
                                                        }
                                                    }
                                                    return false;
                                                }
                                            @endphp

                                            @if($uniqueOwnerships->count() > 0)
                                                @foreach($uniqueOwnerships as $ownership)
                                                    @php
                                                        $shareholderNames = explode("\n", e($ownership->shareholder_name));
                                                    @endphp

                                                    @foreach($shareholderNames as $shareholder)
                                                        @php
                                                            $isCompany = isCompany($shareholder, $companyIndicators);
                                                        @endphp
                                                        <div class="col-md-6">
                                                            <form action="{{ route('searchFunctionShareholder') }}" method="GET" class="w-100">
                                                                @csrf
                                                                <div class="feature-item d-flex align-items-center">
                                                                    <div class="feature-icon">
                                                                        <i class="bi {{ $isCompany ? 'bi-building' : 'bi-people' }}"></i>
                                                                    </div>
                                                                    <div class="feature-content">
                                                                        <!-- Shareholder Name -->
                                                                        <h5 class="mb-1">
                                                                            <button type="submit" name="shareholder_name"
                                                                                value="{{ $shareholder }}"
                                                                                class="btn btn-link p-0 text-start text-decoration-none text-muted fw-bold">
                                                                                {{ $shareholder }}
                                                                            </button>
                                                                        </h5>

                                                                        <!-- Position -->
                                                                        @if($ownership->position && $ownership->position !== '-')
                                                                            <small class="text-secondary d-block">Position:
                                                                                {{ $ownership->position }}</small>
                                                                        @endif

                                                                        <!-- Percentage -->
                                                                        @if($ownership->percentage_of_shares)
                                                                            <span
                                                                                class="badge bg-info text-dark">{{ $ownership->percentage_of_shares }}</span>
                                                                        @endif

                                                                        <!-- Number of Shares -->
                                                                        @if($ownership->number_of_shares)
                                                                            <small class="text-muted d-block">Shares:
                                                                                {{ $ownership->number_of_shares }}</small>
                                                                        @endif

                                                                        <!-- Currency -->
                                                                        @if($ownership->currency)
                                                                            <small class="text-muted d-block">Currency:
                                                                                {{ $ownership->currency }}</small>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <div class="col-12 text-muted">: -</div>
                                            @endif
                                        </div>
                                    </div>

                                    <script>
                                        document.querySelectorAll('button[name="subsidiary"], button[name="shareholder_name"]').forEach(btn => {
                                            btn.addEventListener('mouseenter', () => {
                                                btn.style.textShadow = "0 0 8px rgba(0, 255, 255, 0.8), 0 0 12px rgba(0, 128, 255, 0.8)";
                                                btn.style.color = "#0dcaf0";
                                            });
                                            btn.addEventListener('mouseleave', () => {
                                                btn.style.textShadow = "none";
                                                btn.style.color = "";
                                            });
                                        });
                                    </script>
                                </div>

                                @if ($consolidations->isNotEmpty())
                                    <div class="service-sidebar">
                                        @if(Auth::check() && Auth::user()->level === 'Platinum')
                                            <div class="service-info card shadow-sm p-4 rounded-3">
                                                <h4 class="mb-4 fw-bold">Facility & Estate Information</h4>

                                                <div class="row info-list">
                                                    <!-- Facility -->
                                                    <div class="col-md-12">
                                                        <div class="info-item border-bottom py-3">
                                                            <span class="info-label d-block text-muted small">Facility</span>
                                                            @php
                                                                $facilityRows = $consolidations->filter(fn($row) => !empty($row->facilities) && trim($row->facilities) !== '-');
                                                            @endphp
                                                            @if ($facilityRows->isNotEmpty())
                                                                <div class="d-flex flex-column gap-2 mt-2 text-end">
                                                                    @foreach ($facilityRows as $row)
                                                                        @php
                                                                            $activities = collect(preg_split('/[,&]/', $row->principal_activities ?? ''))
                                                                                ->map(fn($a) => trim($a))
                                                                                ->filter(fn($a) => $a !== '' && !preg_match('/estate|plantation/i', $a))
                                                                                ->unique();
                                                                            $coord = (!in_array($row->latitude, ['', '-']) && !in_array($row->longitude, ['', '-']))
                                                                                ? $row->latitude . ', ' . $row->longitude
                                                                                : null;
                                                                        @endphp
                                                                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                                                                            <span class="badge bg-info rounded-pill">{{ $row->facilities }}</span>
                                                                            @foreach ($activities as $activity)
                                                                                <span class="badge bg-secondary rounded-pill">{{ $activity }}</span>
                                                                            @endforeach
                                                                            @if($coord)
                                                                                <span
                                                                                    class="badge bg-warning text-dark rounded-pill">{{ $coord }}</span>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <span class="info-value d-block text-secondary">-</span>
                                                            @endif
                                                        </div>

                                                        <!-- Estate -->
                                                        <div class="info-item border-bottom py-3">
                                                            <span class="info-label d-block text-muted small">Estate</span>
                                                            @php
                                                                $estateRows = $consolidations->filter(fn($row) => !empty($row->estate) && trim($row->estate) !== '-');
                                                            @endphp
                                                            @if ($estateRows->isNotEmpty())
                                                                <div class="d-flex flex-column gap-2 mt-2 text-end">
                                                                    @foreach ($estateRows as $row)
                                                                        @php
                                                                            $activities = collect(preg_split('/[,&]/', $row->principal_activities ?? ''))
                                                                                ->map(fn($a) => trim($a))
                                                                                ->filter(fn($a) => $a !== '' && preg_match('/estate|plantation/i', $a))
                                                                                ->unique();
                                                                            $coord = (!in_array($row->latitude, ['', '-']) && !in_array($row->longitude, ['', '-']))
                                                                                ? $row->latitude . ', ' . $row->longitude
                                                                                : null;
                                                                        @endphp
                                                                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                                                                            <span class="badge bg-info rounded-pill">{{ $row->estate }}</span>
                                                                            @foreach ($activities as $activity)
                                                                                <span class="badge bg-secondary rounded-pill">{{ $activity }}</span>
                                                                            @endforeach
                                                                            @if($coord)
                                                                                <span
                                                                                    class="badge bg-warning text-dark rounded-pill">{{ $coord }}</span>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <span class="info-value d-block text-secondary">-</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Status + Address -->
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="info-item border-bottom py-3">
                                                                    <span class="info-label d-block text-muted small">Operating
                                                                        Status</span>
                                                                    @php
                                                                        $statusList = $consolidations->pluck('status_operation')
                                                                            ->filter(fn($v) => !empty($v) && trim($v) !== '-')
                                                                            ->unique();
                                                                    @endphp
                                                                    @if ($statusList->isNotEmpty())
                                                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                                                            @foreach ($statusList as $status)
                                                                                <span class="badge bg-info rounded-pill">{{ $status }}</span>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <span class="info-value d-block text-secondary">-</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="info-item border-bottom py-3">
                                                                    <span class="info-label d-block text-muted small">Operating
                                                                        Address</span>
                                                                    @php
                                                                        $addressList = $consolidations->pluck('country_operation')
                                                                            ->filter(fn($v) => !empty($v) && trim($v) !== '-')
                                                                            ->unique();
                                                                    @endphp
                                                                    @if ($addressList->isNotEmpty())
                                                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                                                            @foreach ($addressList as $address)
                                                                                <span class="badge bg-info rounded-pill">{{ $address }}</span>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <span class="info-value d-block text-secondary">-</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Map Section -->
                                                <div class="mt-4">
                                                    <h4 class="mb-3 fw-bold">Map of Facilities & Estates</h4>
                                                    <div id="map" style="height: 400px; width: 100%; border: 1px solid #ddd;"></div>

                                                    @php
                                                        $mapData = $consolidations
                                                            ->filter(function ($row) {
                                                                return !empty($row->latitude)
                                                                    && !empty($row->longitude)
                                                                    && $row->latitude !== '-'
                                                                    && $row->longitude !== '-';
                                                            })
                                                            ->map(function ($row) {
                                                                return [
                                                                    'type' => !empty($row->facilities) && trim($row->facilities) !== '-' ? 'facility' : 'estate',
                                                                    'name' => $row->facilities && trim($row->facilities) !== '-' ? $row->facilities : $row->estate,
                                                                    'activities' => $row->principal_activities ?: '-',
                                                                    'status' => $row->status_operation ?: '-',
                                                                    'country' => $row->country_operation ?: '-',
                                                                    'province' => $row->province ?: '-',
                                                                    'regency' => $row->regency ?: '-',
                                                                    'lat' => $row->latitude,
                                                                    'lng' => $row->longitude,
                                                                ];
                                                            })
                                                            ->values()
                                                            ->toArray();
                                                    @endphp

                                                    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                                                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function () {
                                                            const map = L.map("map").setView([0, 0], 2);

                                                            const osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                                                maxZoom: 19,
                                                                attribution: "&copy; OpenStreetMap contributors"
                                                            }).addTo(map);

                                                            const googleSat = L.tileLayer("https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}", {
                                                                maxZoom: 20,
                                                                attribution: "&copy; Google"
                                                            });

                                                            const googleHybrid = L.tileLayer("https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}", {
                                                                maxZoom: 20,
                                                                attribution: "&copy; Google"
                                                            });

                                                            const esriWorldImagery = L.tileLayer(
                                                                "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
                                                                {
                                                                    maxZoom: 20,
                                                                    attribution: "Tiles &copy; Esri"
                                                                }
                                                            );

                                                            const baseMaps = {
                                                                "OpenStreetMap": osm,
                                                                "Google Satellite": googleSat,
                                                                "Google Hybrid": googleHybrid,
                                                                "Esri World Imagery": esriWorldImagery
                                                            };
                                                            L.control.layers(baseMaps).addTo(map);

                                                            const locations = @json($mapData);
                                                            const markers = [];

                                                            locations.forEach((loc) => {
                                                                const color = loc.type === "facility" ? "blue" : "green";

                                                                const marker = L.circleMarker([loc.lat, loc.lng], {
                                                                    radius: 8,
                                                                    color: color,
                                                                    fillColor: color,
                                                                    fillOpacity: 0.8
                                                                }).addTo(map);

                                                                marker.bindPopup(
                                                                    "<b>" + loc.name + "</b><br/>" +
                                                                    "Activities: " + loc.activities + "<br/>" +
                                                                    "Operating Status: " + loc.status + "<br/>" +
                                                                    "Country: " + loc.country + "<br/>" +
                                                                    "Province: " + loc.province + "<br/>" +
                                                                    "District: " + loc.regency
                                                                );

                                                                markers.push(marker);
                                                            });

                                                            if (markers.length > 0) {
                                                                const group = L.featureGroup(markers);
                                                                map.fitBounds(group.getBounds().pad(0.2));
                                                            }

                                                            const legend = L.control({ position: "bottomright" });
                                                            legend.onAdd = function () {
                                                                const div = L.DomUtil.create("div", "info legend bg-white p-2 rounded shadow-sm");
                                                                div.innerHTML =
                                                                    '<div><span style="display:inline-block;width:12px;height:12px;background:blue;margin-right:6px;border-radius:50%;"></span> Facility/Mill</div>' +
                                                                    '<div><span style="display:inline-block;width:12px;height:12px;background:green;margin-right:6px;border-radius:50%;"></span> Estate</div>';
                                                                return div;
                                                            };
                                                            legend.addTo(map);
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Non-Platinum user --}}
                                            <div class="card shadow-sm border-0 rounded-3 text-center p-4 bg-light">
                                                <i class="bi bi-lock-fill text-secondary fs-1 mb-3"></i>
                                                <p>
                                                    Access to <strong>Facility & Estate Information</strong> is
                                                    <span class="fw-bold text-danger">restricted</span>. <br>
                                                    Upgrade to <span class="badge bg-dark">Platinum</span> level to view this
                                                    content.
                                                </p>
                                                {{-- <a href="#" class="btn btn-outline-dark btn-sm">
                                                    <i class="bi bi-arrow-up-circle me-1"></i> Upgrade Now
                                                </a> --}}
                                            </div>
                                        @endif
                                    </div>
                                @endif

                            </div>

                            <div class="col-lg-4">
                                <div class="service-sidebar">
                                    <div class="service-hero" style="margin-bottom: -10px">

                                        @if(isset($consolidations) && $consolidations->isNotEmpty())
                                            @php
                                                $directory = public_path('file/notary-deed/');
                                                $filesInDirectory = scandir($directory);
                                            @endphp

                                            @foreach($consolidations->unique('subsidiary') as $subs)
                                                @php
                                                    $subsidiary = $subs->subsidiary;
                                                    $selectedFile = null;

                                                    // Cari file yang cocok (abaikan 1 kata pertama pada nama file)
                                                    $matchingFiles = collect($filesInDirectory)->filter(function ($file) use ($subsidiary) {
                                                        if (in_array($file, ['.', '..']))
                                                            return false;

                                                        $nameOnly = pathinfo($file, PATHINFO_FILENAME);

                                                        // buang angka tahun + bulan di depan (misalnya "2024 08")
                                                        $cleanName = preg_replace('/^\d{4}\s+\d{2}\s+/', '', $nameOnly);

                                                        // abaikan 1 kata pertama
                                                        $cleanNameParts = explode(' ', $cleanName, 2);
                                                        $cleanNameForMatch = isset($cleanNameParts[1]) ? $cleanNameParts[1] : $cleanNameParts[0];

                                                        return trim(strtolower($cleanNameForMatch)) === trim(strtolower($subsidiary));
                                                    });

                                                    if ($matchingFiles->isNotEmpty()) {
                                                        // Ambil file terbaru berdasarkan tanggal
                                                        $selectedFile = $matchingFiles->sortByDesc(function ($file) {
                                                            if (preg_match('/^(\d{4})\s+(\d{2})/', $file, $m)) {
                                                                return intval($m[1] . $m[2]);
                                                            }
                                                            return 0;
                                                        })->first();

                                                        $fileUrl = asset('file/notary-deed/' . $selectedFile);
                                                    } else {
                                                        $fileUrl = null;
                                                    }
                                                @endphp

                                                <div class="col-12 mb-4">
                                                    @if(Auth::check() && Auth::user()->level === 'Platinum')
                                                        {{-- Hanya Platinum yang bisa lihat dokumen --}}
                                                        @if($fileUrl)
                                                            <div class="card shadow-sm border-0 rounded-3">
                                                                <div class="card-header bg-light border-bottom-0">
                                                                    <h6 class="mb-0 fw-bold">
                                                                        The Notary Deed document of
                                                                        <span class="text-primary">{{ $subsidiary }}</span>
                                                                    </h6>
                                                                </div>
                                                                <div class="card-body p-0">
                                                                    <iframe src="{{ $fileUrl }}" class="iframe-preview" allowfullscreen></iframe>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="card shadow-sm border-0 rounded-3 text-center p-4">
                                                                <img src="{{ asset('template/Passion/assets/img/services/services-7.webp') }}"
                                                                    alt="Data Not Found" class="img-fluid mb-3 d-block mx-auto"
                                                                    style="max-width: 220px; max-height: 150px;">
                                                                <p>
                                                                    Notary deed document for <strong>{{ $subsidiary }}</strong> is not available.
                                                                    Please Contact Us at <a
                                                                        href="mailto:helpdesk@earthqualizer.org">helpdesk@earthqualizer.org</a> to
                                                                    request this information.
                                                                    {{-- <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                                        data-bs-target="#contactModal">Contact Us</a> --}}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    @else
                                                        {{-- Non-Platinum user --}}
                                                        <div class="card shadow-sm border-0 rounded-3 text-center p-4 bg-light">
                                                            <i class="bi bi-lock-fill text-secondary fs-1 mb-3"></i>
                                                            <p>
                                                                Access to <strong>Notary Deed</strong> documents is
                                                                <span class="fw-bold text-danger">restricted</span>. <br>
                                                                Upgrade to <span class="badge bg-dark">Platinum</span> level to view this
                                                                content.
                                                            </p>
                                                            {{-- <a href="#" class="btn btn-outline-dark btn-sm">
                                                                <i class="bi bi-arrow-up-circle me-1"></i> Upgrade Now
                                                            </a> --}}
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="no-data text-center p-5">
                                                <img src="{{ asset('template/Passion/assets/img/services/services-7.webp') }}"
                                                    alt="No Data Found" class="img-fluid mb-3" style="max-width: 300px;">
                                                {{-- <p>
                                                    Notary deed document for this company is not available.
                                                    Please <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#contactModal">
                                                        Contact Us
                                                    </a> to request this information.
                                                </p> --}}
                                            </div>
                                        @endif

                                        <style>
                                            .iframe-preview {
                                                width: 100%;
                                                min-height: 400px;
                                                height: 70vh;
                                                border: none;
                                            }
                                        </style>

                                        <!-- Modal Popup (sama untuk semua kondisi) -->
                                        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <!-- Body -->
                                                    <div class="modal-body">
                                                        <div class="contact-form-container">
                                                            <h3>Request Notary Deed</h3>
                                                            <p>Silahkan masukan pesan anda terkait request company group structure!
                                                            </p>

                                                            <form action="forms/contact.php" method="post" class="php-email-form">
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group">
                                                                        <input type="text" name="name" class="form-control"
                                                                            id="name" placeholder="Your Name" required="">
                                                                    </div>
                                                                    <div class="col-md-6 form-group mt-3 mt-md-0">
                                                                        <input type="email" class="form-control" name="email"
                                                                            id="email" placeholder="Your Email" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mt-3">
                                                                    <input type="text" class="form-control" name="organization"
                                                                        id="organization" placeholder="Organization/Company"
                                                                        required="">
                                                                </div>
                                                                <div class="form-group mt-3">
                                                                    <textarea class="form-control" name="message" rows="5"
                                                                        placeholder="Message" required=""></textarea>
                                                                </div>

                                                                <div class="my-3">
                                                                    <div class="loading">Loading</div>
                                                                    <div class="error-message"></div>
                                                                    <div class="sent-message">Your message has been sent. Thank you!
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="form-submit d-flex justify-content-between align-items-center">
                                                                    <button type="submit" class="btn btn-success">Send
                                                                        Message</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="service-sidebar">
                                        <div class="service-info card shadow-sm p-4 rounded-3">
                                            @if($companyOwnership->isNotEmpty() || $consolidations->isNotEmpty())
                                                <h4 class="mb-4 fw-bold">Certification</h4>

                                                <div class="row info-list">
                                                    <div class="col-md-12">
                                                        <div class="info-item border-bottom py-3">
                                                            <span class="info-label d-block text-muted small">RSPO Certified</span>

                                                            @php
                                                                $acts = $consolidations->pluck('rspo_certified')
                                                                    ->filter()
                                                                    ->unique()
                                                                    ->values();
                                                            @endphp

                                                            @if($acts->isNotEmpty())
                                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                                    @foreach($acts as $activity)
                                                                        <span class="badge bg-success rounded-pill">{{ $activity }}</span>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <span class="info-value d-block text-secondary">-</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="info-item border-bottom py-3">
                                                            <span class="info-label d-block text-muted small">Other Certification</span>

                                                            @php
                                                                $acts = $consolidations->pluck('other_certification')
                                                                    ->filter()
                                                                    ->unique()
                                                                    ->values();
                                                            @endphp

                                                            @if($acts->isNotEmpty())
                                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                                    @foreach($acts as $activity)
                                                                        <span class="badge bg-success rounded-pill">{{ $activity }}</span>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <span class="info-value d-block text-secondary">-</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-muted">No certification available.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="service-sidebar">
                                        <div class="service-info card shadow-sm p-4 rounded-3">
                                            @if ($companyOwnership->isNotEmpty())
                                                <h4 class="mb-4 fw-bold">Registration Details</h4>

                                                <div class="info-list">
                                                    @php
                                                        $fields = [
                                                            'incorporatioin_detail' => 'Incorporation Detail',
                                                            'taxpayer_identification_number' => 'Taxpayer Identification Number',
                                                            'company_number' => 'Company Number',
                                                            'date_company_number' => 'Date Company Number',
                                                            'change_company_number' => 'Change Company Number',
                                                            'date_change_company_number' => 'Date Change Company Number',
                                                            'country_of_registration_address' => 'Country of Registration Address',
                                                            'registered_address' => 'Registered Address',
                                                        ];
                                                    @endphp

                                                    @foreach ($fields as $field => $label)
                                                        <div class="info-item border-bottom py-3">
                                                            <span class="info-label d-block text-muted small">
                                                                {{ $label }}
                                                            </span>

                                                            <div class="text-end">
                                                                @foreach ($companyOwnership->pluck($field)->unique() as $value)
                                                                    @if ($field === 'registered_address')
                                                                                        <p
                                                                                            class="info-value mb-1 {{ $value ? 'fw-bold text-teal' : 'text-secondary' }}">
                                                                                            {!! $value
                                                                        ? nl2br(
                                                                            e(
                                                                                collect(explode("\n", $value))
                                                                                    ->map(fn($line) => \Illuminate\Support\Str::lower(trim($line)))
                                                                                    ->implode("\n")
                                                                            )
                                                                        )
                                                                        : '-' !!}
                                                                                        </p>
                                                                    @else
                                                                        <p
                                                                            class="info-value mb-1 {{ $value ? 'fw-bold text-teal' : 'text-secondary' }}">
                                                                            {!! $value ? nl2br(e($value)) : '-' !!}
                                                                        </p>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-muted">No registration details available.</p>
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Call To Action Section -->
                    <section id="call-to-action" class="call-to-action section light-background">

                        <div class="container">

                            <div class="cta-wrapper">
                                <div class="cta-shapes">
                                    <div class="shape shape-1"></div>
                                    <div class="shape shape-2"></div>
                                    <div class="shape shape-3"></div>
                                </div>

                                <div class="row g-0">
                                    <div class="col-lg-7">
                                        <div class="cta-content p-5">
                                            <span class="badge-custom">Data Not Found</span>
                                            <h2 class="mt-4 mb-4">Please contact us to get the data</h2>
                                            <p class="mb-4">Now the data not available, please contact us to access the
                                                data.</p>

                                            <div class="row benefits-row mb-5 contact contact-content">
                                                <div class="contact-card col-lg-6 col-md-6">
                                                    <div class="icon-box">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                    <div class="contact-text">
                                                        <h4>Email</h4>
                                                        <p>info@examplecompany.com</p>
                                                    </div>
                                                </div>

                                                <div class="contact-card col-lg-6 col-md-6">
                                                    <div class="icon-box">
                                                        <i class="bi bi-clock"></i>
                                                    </div>
                                                    <div class="contact-text">
                                                        <h4>Open Hours</h4>
                                                        <p>Monday-Friday: 9AM - 6PM</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="action-buttons">
                                                {{-- <a href="#" class="btn btn-primary">Start Now</a>
                                                <a href="#" class="btn btn-outline">Learn More</a> --}}
                                                <div class="guarantee-badge">
                                                    <i class="bi bi-patch-check-fill"></i>
                                                    <span>We will process your request within 3 working days</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="cta-image-container">
                                            <div class="contact contact-form-container">
                                                <h3>Get in Touch</h3>
                                                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod
                                                    tempor
                                                    incididunt
                                                    ut labore et dolore magna aliqua consectetur adipiscing.</p>

                                                <form action="forms/contact.php" method="post" class="php-email-form">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <input type="text" name="name" class="form-control" id="name"
                                                                placeholder="Your Name" required="">
                                                        </div>
                                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                                            <input type="email" class="form-control" name="email" id="email"
                                                                placeholder="Your Email" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <input type="text" class="form-control" name="subject" id="subject"
                                                            placeholder="Subject" required="">
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <textarea class="form-control" name="message" rows="5"
                                                            placeholder="Message" required=""></textarea>
                                                    </div>

                                                    <div class="my-3">
                                                        <div class="loading">Loading</div>
                                                        <div class="error-message"></div>
                                                        <div class="sent-message">Your message has been sent. Thank you!
                                                        </div>
                                                    </div>

                                                    <div class="form-submit">
                                                        <button type="submit">Send Message</button>
                                                        <div class="social-links">
                                                            <a href="#"><i class="bi bi-twitter"></i></a>
                                                            <a href="#"><i class="bi bi-facebook"></i></a>
                                                            <a href="#"><i class="bi bi-instagram"></i></a>
                                                            <a href="#"><i class="bi bi-linkedin"></i></a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                    </section><!-- /Call To Action Section -->
                @endif
            </div>
        </section><!-- /Service Details Section -->

    </main>
@endsection