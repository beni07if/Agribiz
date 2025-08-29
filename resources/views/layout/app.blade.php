<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Agribiz - Corporate Profile Platform</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('template/Passion/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('template/Passion/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('template/Passion/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/Passion/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/Passion/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/Passion/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('template/Passion/assets/css/main.css') }}" rel="stylesheet">
    @yield('styleShareholder')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- =======================================================
  * Template Name: Passion
  * Template URL: https://bootstrapmade.com/passion-bootstrap-template/
  * Updated: Jul 21 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header fixed-top">

        <div class="branding d-flex align-items-cente">

            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="{{route('corporateProfileEn')}}" class="logo d-flex align-items-center">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <img src="{{ asset('template/Passion/assets/img/Agribiz_White.png') }}" alt="">
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{route('corporateProfileEn')}}#home" class="active">Home</a></li>
                        <li><a href="{{route('corporateProfileEn')}}#about">About</a></li>
                        <li class="dropdown"><a href="{{route('corporateProfileEn')}}#services"><span>Service</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{route('groupFeature')}}">Group Structure</a></li>
                                <li><a href="{{route('subsidiaryFeature')}}">Corporate Profile</a></li>
                                <li><a href="{{route('shareholderFeature')}}">Shareholder</a></li>
                                <li><a href="{{route('sraFeature')}}">SRA</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('corporateProfileEn')}}#faq">FAQ</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

            </div>

        </div>

    </header>

    @yield('content')

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
                    {{-- <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p> --}}
                    <p><strong>Email:</strong> <span>helpdesk@earthqualizer.org</span></p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Agribiz</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('template/Passion/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('template/Passion/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('template/Passion/assets/js/main.js') }}"></script>

    <script>
        // Data dummy benefit
        const benefits = [
            { icon: "bi-lightning-charge-fill", color: "text-primary", title: "Quick Setup", desc: "Lorem ipsum dolor sit amet, consectetur adipiscing elit." },
            { icon: "bi-shield-check", color: "text-success", title: "Full Security", desc: "Sed ut perspiciatis unde omnis iste natus error sit voluptatem." },
            { icon: "bi-speedometer2", color: "text-warning", title: "High Performance", desc: "Ut enim ad minim veniam, quis nostrud exercitation ullamco." },
            { icon: "bi-cloud-arrow-down-fill", color: "text-info", title: "Cloud Sync", desc: "Duis aute irure dolor in reprehenderit in voluptate." },
            { icon: "bi-people-fill", color: "text-danger", title: "Team Collaboration", desc: "Excepteur sint occaecat cupidatat non proident." },
            { icon: "bi-phone-fill", color: "text-dark", title: "Mobile Ready", desc: "Lorem ipsum dolor sit amet, consectetur adipiscing elit." },
            { icon: "bi-gear-fill", color: "text-secondary", title: "Customizable", desc: "Sed ut perspiciatis unde omnis iste natus error sit voluptatem." },
        ];

        const itemsPerPage = 5;
        let currentPage = 1;

        function renderBenefits(page) {
            const container = document.getElementById("benefit-container");
            container.innerHTML = "";

            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedItems = benefits.slice(start, end);

            paginatedItems.forEach(b => {
                const col = document.createElement("div");
                col.className = "col-md-6";
                col.innerHTML = `
        <div class="benefit-item p-4 shadow-sm rounded bg-white h-100">
          <div class="icon-box mb-2">
            <i class="bi ${b.icon} fs-3 ${b.color}"></i>
          </div>
          <h5>${b.title}</h5>
          <p class="mb-0">${b.desc}</p>
        </div>
      `;
                container.appendChild(col);
            });
        }

        function renderPagination() {
            const totalPages = Math.ceil(benefits.length / itemsPerPage);
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement("li");
                li.className = `page-item ${i === currentPage ? "active" : ""}`;
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                li.addEventListener("click", (e) => {
                    e.preventDefault();
                    currentPage = i;
                    renderBenefits(currentPage);
                    renderPagination();
                });
                pagination.appendChild(li);
            }
        }

        // Initial render
        renderBenefits(currentPage);
        renderPagination();
    </script>

</body>

</html>