@extends('layout.app')

@section('content')
    <main class="main">

        @include('headerSection.headerGroup')

        <!-- Service Details Section -->
        <section id="service-details" class="service-details section">

            <div class="container">

                <div class="row gy-5">

                    <div class="col-lg-8">
                        <div class="service-content">
                            <div class="service-header">
                                <h2>Group Summary</h2>
                                <p class="service-intro"></p>
                            </div>
                        </div>

                        @if(count($groups) > 0)
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <div class="row">
                                    @php
                                        $directory = public_path('file/group-structure/');
                                        $filesInDirectory = scandir($directory);
                                    @endphp

                                    @foreach($groups->groupBy('group_name') as $subsidiaryGroup)
                                        @php
                                            $subsidiary = $subsidiaryGroup->first()->group_name;
                                            $isOngoing = false;
                                            $selectedVersion = null;
                                            $versionBadge = null;

                                            $matchingFiles = collect($filesInDirectory)->filter(function ($file) use ($subsidiary) {
                                                if (in_array($file, ['.', '..']))
                                                    return false;
                                                $nameOnly = pathinfo($file, PATHINFO_FILENAME);
                                                $cleanName = preg_replace('/^\d{4}\s+\d{2}\s+/', '', $nameOnly);
                                                $cleanNameForMatch = preg_replace('/\s*\(.*\)$/i', '', $cleanName);
                                                return trim(strtolower($cleanNameForMatch)) === trim(strtolower($subsidiary));
                                            });

                                            if ($matchingFiles->isNotEmpty()) {
                                                $latestFile = $matchingFiles->sortByDesc(function ($file) {
                                                    $nameOnly = pathinfo($file, PATHINFO_FILENAME);
                                                    $priority = 0;
                                                    if (preg_match('/\(update v\.2\)$/i', $nameOnly)) {
                                                        $priority = 3;
                                                    } elseif (preg_match('/\(update v\.1\)$/i', $nameOnly)) {
                                                        $priority = 2;
                                                    } elseif (preg_match('/\(ongoing\)$/i', $nameOnly)) {
                                                        $priority = 1;
                                                    }
                                                    $dateScore = 0;
                                                    if (preg_match('/^(\d{4})\s+(\d{2})/', $file, $m)) {
                                                        $dateScore = intval($m[1] . $m[2]);
                                                    }
                                                    return ($priority * 1000000) + $dateScore;
                                                })->first();

                                                $fileNameInDirectory = $latestFile;
                                                $fileExtension = pathinfo($fileNameInDirectory, PATHINFO_EXTENSION);
                                                $selectedVersion = pathinfo($fileNameInDirectory, PATHINFO_FILENAME);

                                                if (preg_match('/\(update v\.2\)$/i', $selectedVersion)) {
                                                    $versionBadge = '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Update v.2</span>';
                                                } elseif (preg_match('/\(update v\.1\)$/i', $selectedVersion)) {
                                                    $versionBadge = '<span class="badge bg-primary"><i class="bi bi-journal-text me-1"></i>Update v.1</span>';
                                                } elseif (preg_match('/\(ongoing\)$/i', $selectedVersion)) {
                                                    $versionBadge = '<span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Ongoing</span>';
                                                    $isOngoing = true;
                                                } else {
                                                    $versionBadge = '<span class="badge bg-secondary"><i class="bi bi-file-earmark-text me-1"></i>Latest</span>';
                                                }

                                                if ($fileExtension === 'pdf') {
                                                    $googleDocsUrl = asset('file/group-structure/' . $fileNameInDirectory);
                                                } elseif ($fileExtension === 'pptx') {
                                                    $googleDocsUrl = 'https://docs.google.com/viewer?url=' . urlencode(asset('file/group-structure/' . $fileNameInDirectory));
                                                } else {
                                                    $googleDocsUrl = '';
                                                }
                                            } else {
                                                $googleDocsUrl = '';
                                            }
                                        @endphp

                                        <div class="col-12 mb-4">
                                            @if($googleDocsUrl)
                                                <div class="card shadow-sm border-0 rounded-3">
                                                    <div
                                                        class="card-header bg-light border-bottom-0 d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h6 class="mb-0 fw-bold">
                                                                {{ $subsidiary }}
                                                                @if($selectedVersion)
                                                                    <small class="text-muted ms-2">{{ $selectedVersion }}</small>
                                                                @endif
                                                            </h6>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            {!! $versionBadge !!}
                                                            <a href="{{ $googleDocsUrl }}" target="_blank"
                                                                class="btn btn-sm btn-outline-primary" title="View Fullscreen">
                                                                <i class="bi bi-arrows-fullscreen"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <iframe src="{{ $googleDocsUrl }}" class="iframe-preview"
                                                            allowfullscreen></iframe>
                                                    </div>
                                                    @if($isOngoing)
                                                        <div class="card-footer bg-white border-top text-warning fw-semibold">
                                                            ⚠️ The group structure of {{ $subsidiary }} is still in the identification
                                                            stage. To get more updated information about this group, please contact us at
                                                            helpdesk@earthqualizer.org
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="card shadow-sm border-0 rounded-3 text-center p-4">
                                                    <img src="{{ asset('template/Passion/assets/img/services/services-7.webp') }}"
                                                        alt="Data Not Found" class="img-fluid mb-3 d-block mx-auto"
                                                        style="max-width: 220px;">
                                                    <p>
                                                        Group Structure document for <strong>{{ $subsidiary }}</strong> is not available
                                                        at the moment. Please Contact Us at <a
                                                            href="mailto:helpdesk@earthqualizer.org">helpdesk@earthqualizer.org</a> to
                                                        request this information.
                                                        {{-- <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#contactModal">
                                                        </a> --}}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <h6 class="card-title mt-4"><i>*Data source by Inovasi Digital</i></h6>
                            </div>
                        @endif

                        <style>
                            .iframe-preview {
                                width: 100%;
                                min-height: 400px;
                                height: 70vh;
                                /* Responsive tinggi relatif viewport */
                                border: none;
                            }
                        </style>

                        <!-- Modal Popup -->
                        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Body -->
                                    <div class="modal-body">
                                        <div class="contact-form-container">
                                            <h3>Request Group Structure</h3>
                                            <p>Silahkan masukan pesan anda terkait request company group structure!</p>

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
                                                    <input type="text" class="form-control" name="organization"
                                                        id="organization" placeholder="Organization/Company" required="">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <textarea class="form-control" name="message" rows="5"
                                                        placeholder="Message" required=""></textarea>
                                                </div>

                                                <div class="my-3">
                                                    <div class="loading">Loading</div>
                                                    <div class="error-message"></div>
                                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                                </div>

                                                <div class="form-submit d-flex justify-content-between align-items-center">
                                                    <button type="submit" class="btn btn-success">Send Message</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="service-sidebar">
                            <div class="service-features service-sidebar service-info">
                                <div class="row">
                                    @foreach($groups->unique('group_name') as $subs)
                                        <!-- Kolom kiri: Controller (center vertikal) -->
                                        <div class="col-md-6 d-flex align-items-center h-100">
                                            <h4 class="m-0">
                                                {{ $subs->controller }}
                                                <span class="text-muted">(controller)</span>
                                            </h4>
                                        </div>

                                        <!-- Kolom kanan: Management Name & Position -->
                                        <div class="col-md-6">
                                            <div class="info-list">
                                                @php
                                                    $lines = preg_split("/\r\n|\n|\r/", $subs->management_name_and_position ?? '');
                                                @endphp

                                                @foreach($lines as $line)
                                                    @if(trim($line) !== '')
                                                        @php
                                                            preg_match('/\((.*?)\)/', $line, $matches);
                                                            $valueInParentheses = $matches[1] ?? null;
                                                            $label = trim(preg_replace('/\(.*?\)/', '', $line));
                                                        @endphp

                                                        <div class="info-item mb-2">
                                                            <span class="info-label">{{ $label }}</span>
                                                            <span class="info-value">
                                                                {{ $valueInParentheses ?? $line }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="service-sidebar">
                            <div class="service-info">
                                <h4 class="mb-4">General Information</h4>
                                @foreach($groups->unique('group_name') as $subs)

                                    <div class="row info-list">
                                        <!-- Kolom kiri -->
                                        <div class="col-md-6">
                                            <div class="info-item border-bottom py-2">
                                                <span class="info-label d-block text-muted">Group Name</span>
                                                <span class="info-value d-block fw-bold">{{$subs->group_name}}</span>
                                            </div>
                                            <div class="info-item border-bottom py-2">
                                                <span class="info-label d-block text-muted">Official Group Name</span>
                                                <span class="info-value d-block fw-bold">{{$subs->official_group_name}}</span>
                                            </div>
                                            <div class="info-item border-bottom py-2">
                                                <span class="info-label d-block text-muted">Group Status</span>
                                                <span class="info-value d-block fw-bold">{{$subs->group_status}}</span>
                                            </div>
                                            <div class="info-item border-bottom py-2">
                                                <span class="info-label d-block text-muted">Listing Status</span>
                                                <span class="info-value d-block fw-bold">{{$subs->stock_exchange_name}}</span>
                                            </div>
                                        </div>

                                        <!-- Kolom kanan -->
                                        <div class="col-md-6">
                                            <div class="info-item border-bottom py-2">
                                                <span class="info-label d-block text-muted">Incorporation Date</span>
                                                <span class="info-value d-block fw-bold">{{$subs->incorporation_date}}</span>
                                            </div>
                                            <div class="info-item border-bottom py-2">
                                                <span class="info-label d-block text-muted">Country Registration</span>
                                                <span class="info-value d-block fw-bold">{{$subs->country_registration}}</span>
                                            </div>
                                            <div class="info-item border-bottom py-2">
                                                <span class="info-label d-block text-muted">Country Operation</span>
                                                <span class="info-value d-block fw-bold">{{$subs->country_operation}}</span>
                                            </div>
                                        </div>

                                        <!-- Business Address full width -->
                                        <div class="col-12">
                                            <div class="info-item border-bottom py-2">
                                                <span class="info-label d-block text-muted">Business Address</span>
                                                <span class="text-muted">
                                                    {{$subs->business_address}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="service-content">
                            <div class="service-features">
                                <h4 class="card-title">Shareholders</h4>

                                <div class="row gy-3">
                                    @foreach($groups as $subs)
                                        @foreach(range(1, 4) as $i)
                                            @php
                                                $shareholder = $subs->{'shareholder_name' . $i};
                                                $percent = $subs->{'percent_of_share' . $i} ?? null;
                                            @endphp

                                            @if($shareholder && strtolower(trim($shareholder)) !== 'nil')
                                                <div class="col-md-6">
                                                    <form action="{{ route('searchFunctionShareholder') }}" method="GET"
                                                        enctype="multipart/form-data" class="w-100">
                                                        @csrf
                                                        <div class="feature-item d-flex align-items-center">
                                                            <div class="feature-icon">
                                                                <i class="bi bi-people"></i>
                                                            </div>
                                                            <div class="feature-content">
                                                                <h5 class="mb-1">
                                                                    <button type="submit" name="shareholder_name"
                                                                        value="{{ $shareholder }}"
                                                                        class="btn btn-link p-0 text-start text-decoration-none text-muted fw-bold"
                                                                        style="transition: all 0.3s ease;">
                                                                        {{ $shareholder }}
                                                                    </button>
                                                                </h5>
                                                                @if($percent)
                                                                    <span class="badge bg-info text-dark">{{ $percent }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>

                            <div class="service-features">
                                <h4 class="card-title">Related Companies</h4>

                                <form action="{{ route('subsidiaryShow') }}" method="POST" enctype="multipart/form-data"
                                    class="w-100">
                                    @csrf
                                    <div class="row gy-3">
                                        @foreach($consolidations->unique('subsidiary') as $item)
                                            <div class="col-md-6">
                                                <div class="feature-item d-flex align-items-center">
                                                    <div class="feature-icon">
                                                        <i class="bi bi-building"></i>
                                                    </div>
                                                    <div class="feature-content">
                                                        <h5 class="mb-1">
                                                            <button type="submit" name="subsidiary"
                                                                value="{{ $item->subsidiary }}"
                                                                class="btn btn-link p-0 text-start text-decoration-none text-muted fw-bold"
                                                                style="transition: all 0.3s ease;">
                                                                {{ $item->subsidiary }}
                                                            </button>
                                                        </h5>
                                                        <span class="badge bg-light text-dark">
                                                            {{ $item->ownership_status }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </form>
                            </div>


                            <script>
                                document.querySelectorAll('button[name="subsidiary"], button[name="shareholder_name"]').forEach(btn => {
                                    btn.addEventListener('mouseenter', () => {
                                        btn.style.textShadow = "0 0 8px rgba(0, 255, 255, 0.8), 0 0 12px rgba(0, 128, 255, 0.8)";
                                        btn.style.color = "#0dcaf0"; // Bootstrap info color
                                    });
                                    btn.addEventListener('mouseleave', () => {
                                        btn.style.textShadow = "none";
                                        btn.style.color = "";
                                    });
                                });
                            </script>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="service-sidebar">
                            <div class="features">
                                <div class="col-lg-12">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="features-tab-1" role="tabpanel">
                                            <div class="content-box">
                                                <div class="row g-4">
                                                    @foreach($groups->unique('group_name') as $subs)
                                                        <div class="col-lg-12">
                                                            <h3>Business Sector</h3>
                                                            <ul class="features-list">
                                                                @foreach(explode(',', $subs->business_sector ?? '') as $item)
                                                                    @php $item = trim($item); @endphp
                                                                    @if(!empty($item))
                                                                        <li>
                                                                            <i class="bi bi-check2-circle"></i>
                                                                            <span>{{ $item }}</span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>

                            <div class="features">
                                <div class="col-lg-12">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="features-tab-1" role="tabpanel">
                                            <div class="content-box">
                                                <div class="row g-4">
                                                    @foreach($groups->unique('group_name') as $subs)
                                                        <div class="col-lg-12">
                                                            <h3>Main Product</h3>
                                                            <ul class="features-list">
                                                                @foreach(explode(',', $subs->main_product ?? '') as $item)
                                                                    @php $item = trim($item); @endphp
                                                                    @if(!empty($item))
                                                                        <li>
                                                                            <i class="bi bi-check2-circle"></i>
                                                                            <span>{{ $item }}</span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br>

                            <div class="service-info">
                                <h4>Transparency and Responsibility</h4>
                                <div class="info-list">
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->ndpe_policy;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">NDPE Policy Time Bound and Planning:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->ndpe_time_bound_plan_implementation;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">NDPE Policy Time Bound and Planning:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->sustainability_progress_report;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">Sustainability Progress Report:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->supply_chain_traceability;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">Supply Chain Traceability:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->grievance_mechanism;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">Grievance Mechanism:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->recovery_plan;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">Recovery Plan:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="service-info">
                                <h4>Membership in Global Sustainable Scheme</h4>
                                <div class="info-list">
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->rspo_member;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">RSPO Member:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->cgf_member;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">CGF Member:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->asd_member;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">ASD Member:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->gpnsr_member;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-secondary';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">GPNSR Member:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @foreach($groups->unique('group_name') as $subs)
                                        @php
                                            $val = $subs->others_mention;
                                            if ($val && str_contains(strtolower($val), 'yes')) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($val && str_contains(strtolower($val), 'no')) {
                                                $badgeClass = 'bg-light';
                                            } else {
                                                $badgeClass = 'bg-light';
                                            }
                                        @endphp

                                        <div class="info-item">
                                            <span class="info-label">Other Member:</span>
                                            <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                {{ $val ?? '-' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="service-info">
                                <h4>Productivity/Volume Handled (tonnes per year)</h4>
                                <div class="info-list">
                                    @foreach($groups->unique('group_name') as $subs)
                                                                <div class="info-item">
                                                                    <span class="info-label">Annual Productivity by RSPO Certified:</span>
                                                                    <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                                        {{ $subs->annual_productivity_by_rspo_certified
                                        ? substr($subs->annual_productivity_by_rspo_certified, 0, -3)
                                        : '-' }}
                                                                    </span>
                                                                </div>

                                                                <div class="info-item">
                                                                    <span class="info-label">Annual FFB Productivity by RSPO Certified:</span>
                                                                    <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                                        {{ $subs->annual_ffb_productivity
                                        ? substr($subs->annual_ffb_productivity, 0, -3)
                                        : '-' }}
                                                                    </span>
                                                                </div>

                                                                <div class="info-item">
                                                                    <span class="info-label">Annual CPO Productivity:</span>
                                                                    <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                                        {{ $subs->annual_cpo_productivity
                                        ? substr($subs->annual_cpo_productivity, 0, -3)
                                        : '-' }}
                                                                    </span>
                                                                </div>

                                                                <div class="info-item">
                                                                    <span class="info-label">Annual CPK Productivity:</span>
                                                                    <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                                        {{ $subs->annual_cpk_productivity
                                        ? substr($subs->annual_cpk_productivity, 0, -3)
                                        : '-' }}
                                                                    </span>
                                                                </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="service-info">
                                <h4>Land Area (in hectare)</h4>
                                <div class="info-list">
                                    @foreach($groups->unique('group_name') as $subs)
                                                                <div class="info-item">
                                                                    <span class="info-label">Land Area Controlled:</span>
                                                                    <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                                        {{ $subs->land_area_controlled
                                        ? substr($subs->land_area_controlled, 0, -3)
                                        : '-' }}
                                                                    </span>
                                                                </div>

                                                                <div class="info-item">
                                                                    <span class="info-label">Total Planted:</span>
                                                                    <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                                        {{ $subs->total_planted
                                        ? substr($subs->total_planted, 0, -3)
                                        : '-' }}
                                                                    </span>
                                                                </div>

                                                                <div class="info-item">
                                                                    <span class="info-label">Total Smallholders:</span>
                                                                    <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                                        {{ $subs->total_smallholders
                                        ? substr($subs->total_smallholders, 0, -3)
                                        : '-' }}
                                                                    </span>
                                                                </div>

                                                                <div class="info-item">
                                                                    <span class="info-label">Total Land Designated and Managed as HCV/HCS Areas:</span>
                                                                    <span class="info-value badge text-wrap text-break px-2 py-1 {{ $badgeClass }}">
                                                                        {{ $subs->total_land_designated_hcv
                                        ? substr($subs->total_land_designated_hcv, 0, -3)
                                        : '-' }}
                                                                    </span>
                                                                </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="contact-card">
                                <div class="contact-content">
                                    <h4>Need Help?</h4>
                                    <p>Please contact us if you need other information</p>
                                    <div class="contact-info">
                                        {{-- <div class="contact-item">
                                            <i class="bi bi-telephone"></i>
                                            <span>+1 (555) 123-4567</span>
                                        </div> --}}
                                        <div class="contact-item">
                                            <i class="bi bi-envelope"></i>
                                            <span>helpdesk@earthqualizer.org</span>
                                        </div>
                                    </div>
                                    {{-- <a href="#" class="btn btn-primary">Get Quote</a> --}}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Service Details Section -->

    </main>
@endsection