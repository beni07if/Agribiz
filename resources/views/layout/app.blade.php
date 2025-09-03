<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Agribiz - Corporate Profile Platform</title>

    <link rel="icon" href="{!! asset('template/Passion/assets/img/Logo_Agribiz_Shape.png') !!}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Inter:wght@300;400;500;600;700;900&family=Barlow:wght@300;400;500;600;700;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('template/Passion/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/Passion/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/Passion/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/Passion/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('template/Passion/assets/css/main.css') }}" rel="stylesheet">
    @yield('styleShareholder')

    <!-- Leaflet (if needed) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body class="index-page">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="branding d-flex align-items-center">
            <div class="container position-relative d-flex align-items-center justify-content-between">

                <a href="{{ route('corporateProfileEn') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('template/Passion/assets/img/Agribiz_White.png') }}" alt="">
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{route('corporateProfileEn')}}#home" class="active">Home</a></li>
                        <li><a href="{{route('corporateProfileEn')}}#about">About</a></li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown">
                                <span>Service</span> <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu shadow">
                                <li><a class="dropdown-item" href="{{route('groupFeature')}}">Group Structure</a></li>
                                <li><a class="dropdown-item" href="{{route('subsidiaryFeature')}}">Corporate Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="{{route('shareholderFeature')}}">Shareholder</a></li>
                                <li><a class="dropdown-item" href="{{route('sraFeature')}}">SRA</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('corporateProfileEn')}}#faq">FAQ</a></li>

                        @guest
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                                    ({{ Auth::user()->role }} - {{ Auth::user()->level }})
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('profile.edit') }}">
                                            <i class="bi bi-person-lines-fill me-2"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="dropdown-item d-flex align-items-center text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

            </div>
        </div>
    </header>
    <!-- End Header -->

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer position-relative dark-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="{{route('corporateProfileEn')}}" class="logo d-flex align-items-center">
                        <img src="{{ asset('template/Passion/assets/img/Agribiz_White.png') }}" alt="">
                    </a>
                </div>
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="{{route('groupFeature')}}">Group Structure</a></li>
                        <li><a href="{{route('subsidiaryFeature')}}">Corporate Profile</a></li>
                        <li><a href="{{route('shareholderFeature')}}">Shareholder</a></li>
                        <li><a href="{{route('sraFeature')}}">Sustainability Risk Assessment</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>Anggrek Street</p>
                    <p>Pontianak, West Kalimantan</p>
                    <p>Indonesia</p>
                    <p><strong>Email:</strong> <span>helpdesk@earthqualizer.org</span></p>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <strong class="px-1 sitename">Agribiz</strong> All Rights Reserved</p>
            <p><a href="{{ route('privacyPolicy') }}" class="privacy-link text-decoration-none">Privacy & Policy</a></p>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- Global Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="previewFrame" src="" width="100%" height="600" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('template/Passion/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Bootstrap JS (CDN only, avoid double load) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('template/Passion/assets/js/main.js') }}"></script>

    <script>
        function openPreview(url) {
            document.getElementById('previewFrame').src = url;
            const modal = new bootstrap.Modal(document.getElementById('previewModal'));
            modal.show();
        }
    </script>
</body>

</html>