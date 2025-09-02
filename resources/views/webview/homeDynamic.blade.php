@extends('layout.app')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="home" class="hero section dark-background">

            <div class="hero-background">
                <img src="{{ ('template/Passion/assets/img/bg/bg-14.webp') }}" alt="" data-aos-duration="1000">
                <div class="overlay"></div>
            </div>

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <span class="hero-badge">Innovative Solutions</span>
                            <h1 style="text-align:left;">Offering insights into it's governance and operational framework
                            </h1>
                            @foreach($landingPages as $landingPage)
                            @endforeach
                            {{-- <div class="hero-actions">
                                <a href="#services" class="btn-primary">Explore Services</a>
                                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn-secondary glightbox">
                                    <i class="bi bi-play-circle"></i>
                                    <span>Watch Demo</span>
                                </a>
                            </div> --}}
                            <div class="hero-stats">
                                <div class="stat-item">
                                    <span
                                        class="stat-number">{{ number_format(floor($groupCountsDistinct / 100) * 100) }}+</span>
                                    <span class="stat-label">Group</span>
                                </div>
                                <div class="stat-item">
                                    <span
                                        class="stat-number">{{ number_format(floor($consolidationCountsDistinct / 100) * 100) }}+</span>
                                    <span class="stat-label">Subsidiary</span>
                                </div>
                                <div class="stat-item">
                                    <span
                                        class="stat-number">{{ number_format(floor($shareholderCountsDistinct / 100) * 100) }}+</span>
                                    <span class="stat-label">Shareholder</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-visual">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="feature-card">
                                        <i class="bi bi-shield-check"></i>
                                        <span>Robust &amp; Reliable</span>
                                    </div>
                                    <div class="feature-card">
                                        <i class="bi bi-people"></i>
                                        <span>Expert Team</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="feature-card">
                                        <i class="bi bi-list-columns"></i>
                                        <span>Comprehensive</span>
                                    </div>
                                    <div class="feature-card">
                                        <i class="bi bi-rocket"></i>
                                        <span>Up to date</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content">
                            <h2>Understanding the hierarchy of beneficial ownership of a Group Company</h2>
                            <p>Welcome to Agribiz, where we help you understand the complexity of the company's
                                structure through clear hierarchical identification. With a focus on entities and
                                subsidiaries, we explain the relationships between companies, as well as provide in-depth
                                insights into shareholders and beneficial ownership. Discover how each element interacts in
                                the business ecosystem, and improve your understanding of the dynamics of corporate
                                governance.</p>
                            {{-- <p class="lead">We are an experienced team in identifying a company around the world which
                                includes the hierarchy and relationships between companies, shareholding, and beneficial
                                ownership of the company.</p>
                            <p>Understanding a company's hierarchy as a whole is crucial in making decisions in the business
                                world. Not everyone
                                can identify this well, it takes people with very good experience and ability to be able to
                                figure this out. In Agribiz you can see how a company is interconnected with other companies
                                with various schemes such as associate, subsidiary, joint venture, etc.</p> --}}

                            <div class="stats-container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stat-item">
                                            <div class="number">25+</div>
                                            <div class="label">Years Experience</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-item">
                                            <div class="number">
                                                {{ number_format(floor($groupCountsDistinct / 100) * 100) }}+
                                            </div>
                                            <div class="label">Group Assessed</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-item">
                                            <div class="number">
                                                {{ number_format(floor($consolidationCountsDistinct / 100) * 100) }}+
                                            </div>
                                            <div class="label">Company Identified</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="cta-wrapper">
                                <a href="#portfolio" class="btn btn-primary">Discover Our Work</a>
                                <a href="#team" class="btn btn-outline">Meet Our Team</a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="image-wrapper">
                            <img src="{{ ('template/Passion/assets/img/illustration/company-hierarchy.jpg') }}"
                                alt="About Us" class="img-fluid main-image">
                            <div class="floating-card">
                                <div class="card-content">
                                    <i class="bi bi-gem"></i>
                                    <div class="text">
                                        <h5>Beneficial Ownership of the Group</h5>
                                        <span>Featured Features</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section light-background" hidden>

            <!-- Section Title -->
            <div class="container section-title">
                <h2>Featured Services</h2>
                <p>Featured Services</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="services-content" data-aos-duration="900">
                            <span class="subtitle">Professional Services</span>
                            <h2> Understanding the Hierarchy of Beneficial Ownership of a Companies Group</h2>
                            <p data-aos-duration="800">Welcome to our platform, where we help you understand the complexity
                                of the company's structure through clear hierarchical identification. With a focus on
                                entities and subsidiaries, we explain the relationships between companies, as well as
                                provide in-depth insights into shareholders and beneficial ownership. Discover how each
                                element interacts in the business ecosystem, and improve your understanding of the dynamics
                                of corporate governance.</p>
                            <div class="mt-4" data-aos-duration="1100">
                                <a href="#" class="btn-consultation"><span>Request a Consultation</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="services-image">
                            <img src="{{ ('template/Passion/assets/img/services/services-9.webp') }}"
                                alt="Business Services" class="img-fluid">
                            <div class="shape-circle"></div>
                            <div class="shape-accent"></div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5" data-aos-duration="1000">
                    <div class="col-12">
                        <div class="services-slider swiper init-swiper">
                            <script type="application/json" class="swiper-config">
                                                            {
                                                                "slidesPerView": 3,
                                                                "spaceBetween": 20,
                                                                "loop": true,
                                                                "speed": 600,
                                                                "autoplay": {
                                                                "delay": 5000
                                                                },
                                                                "navigation": {
                                                                "nextEl": ".swiper-nav-next",
                                                                "prevEl": ".swiper-nav-prev"
                                                                },
                                                                "breakpoints": {
                                                                "320": {
                                                                    "slidesPerView": 1
                                                                },
                                                                "768": {
                                                                    "slidesPerView": 2
                                                                },
                                                                "992": {
                                                                    "slidesPerView": 3
                                                                }
                                                                }
                                                            }
                                                                    </script>
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="service-card">
                                        <div class="icon-box">
                                            <i class="bi bi-bar-chart-fill"></i>
                                        </div>
                                        <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                                        <div class="content">
                                            <h4><a href="#">Financial Strategy Development</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.
                                                Cras vehicula magna eget lectus varius, at finibus massa condimentum.
                                            </p>
                                            <div class="service-number">01</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="service-card">
                                        <div class="icon-box">
                                            <i class="bi bi-graph-up-arrow"></i>
                                        </div>
                                        <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                                        <div class="content">
                                            <h4><a href="#">Market Expansion Advisory</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.
                                                Cras vehicula magna eget lectus varius, at finibus massa condimentum.
                                            </p>
                                            <div class="service-number">02</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="service-card">
                                        <div class="icon-box">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                        <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                                        <div class="content">
                                            <h4><a href="#">Risk Management Solutions</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.
                                                Cras vehicula magna eget lectus varius, at finibus massa condimentum.
                                            </p>
                                            <div class="service-number">03</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="service-card">
                                        <div class="icon-box">
                                            <i class="bi bi-lightbulb-fill"></i>
                                        </div>
                                        <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                                        <div class="content">
                                            <h4><a href="#">Innovation &amp; Digital Transformation</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.
                                                Cras vehicula magna eget lectus varius, at finibus massa condimentum.
                                            </p>
                                            <div class="service-number">04</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="service-card">
                                        <div class="icon-box">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                                        <div class="content">
                                            <h4><a href="#">Talent Management Strategy</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.
                                                Cras vehicula magna eget lectus varius, at finibus massa condimentum.
                                            </p>
                                            <div class="service-number">05</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="swiper-navigation">
                            <button class="swiper-nav-prev"><i class="bi bi-chevron-left"></i></button>
                            <button class="swiper-nav-next"><i class="bi bi-chevron-right"></i></button>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Featured Services Section -->

        <!-- How We Work Section -->
        <section id="how-we-work" class="how-we-work section" hidden>

            <!-- Section Title -->
            <div class="container section-title">
                <h2>How We Work</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="steps-grid">
                    <div class="step-card">
                        <div class="step-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <div class="step-number">Step 1</div>
                        <h3>Research</h3>
                        <p>Nulla facilisi morbi tempus iaculis urna id. Vestibulum ante ipsum primis in faucibus orci
                            luctus et ultrices posuere.</p>
                        <div class="step-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>

                    <div class="step-card">
                        <div class="step-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <div class="step-number">Step 2</div>
                        <h3>Creative Solutions</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam.</p>
                        <div class="step-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>

                    <div class="step-card">
                        <div class="step-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <div class="step-number">Step 3</div>
                        <h3>Development</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna.</p>
                        <div class="step-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>

                    <div class="step-card">
                        <div class="step-icon">
                            <i class="bi bi-rocket-takeoff"></i>
                        </div>
                        <div class="step-number">Step 4</div>
                        <h3>Launch &amp; Support</h3>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum deleniti atque.</p>
                    </div>
                </div>

            </div>

        </section><!-- /How We Work Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title">
                <h2>Services</h2>
                <p>CHECK OUR SERVICES</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 col-md-6">
                        <div class="service-card featured">
                            <div class="service-icon">
                                <i class="bi bi-diagram-3"></i>
                            </div>
                            <div class="service-content">
                                <h3><a href="{{route('groupFeature')}}">Group Structure Hierarchy</a></h3>
                                <p>The structure of the company's group hierarchy which includes relationships with other
                                    companies, share ownership, and who are the benefits of ownership</p>
                                <div class="service-meta">
                                    <span class="badge popular">Featured Feature</span>
                                </div>
                                <a href="{{route('groupFeature')}}" class="btn-cta">
                                    <span>Explore</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="service-bg"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-person-fill-gear"></i>
                            </div>
                            <div class="service-content">
                                <h3><a href="{{route('shareholderFeature')}}">Tracking Shareholder</a></h3>
                                @foreach($landingPages as $landingPage)
                                    <p style="text-align:left;">{!!$landingPage->key_feature_desc3!!}</p>
                                @endforeach
                                <p>Ownership of shares by Individuals and companies in various companies. It helps keep
                                    track of the position, number of shares and percentage of shares in the company.
                                </p>
                                <a href="{{route('shareholderFeature')}}" class="btn-cta">
                                    <span>Explore</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="service-bg"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="service-card compact">
                            <div class="service-icon">
                                <i class="bi bi-buildings"></i>
                            </div>
                            <div class="service-content">
                                <h3><a href="{{route('groupFeature')}}">Group Information</a></h3>
                                @foreach($landingPages as $landingPage)
                                    <p style="text-align:left;">{!!$landingPage->key_feature_desc1!!}</p>
                                @endforeach
                                <p>Contains group information, share ownership, subsidiary, and other important information
                                    to encourage meaningful results for businesses throughout the world.
                                </p>
                                <a href="{{route('groupFeature')}}" class="btn-cta">
                                    <<span>Explore</span>
                                        <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="service-bg"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="service-card compact">
                            <div class="service-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="service-content">
                                <h3><a href="{{route('subsidiaryFeature')}}">Corporate Profile</a></h3>
                                @foreach($landingPages as $landingPage)
                                    <p style="text-align:left;">{!!$landingPage->key_feature_desc2!!}</p>
                                @endforeach
                                <p>This profile presents key information such as the structure of share ownership, mill and
                                    plantation operations, as well as other important data that provides all company
                                    business activities</p>
                                <a href="{{route('subsidiaryFeature')}}" class="btn-cta">
                                    <span>Explore</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="service-bg"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="service-card compact">
                            <div class="service-icon">
                                <i class="bi bi-pie-chart-fill"></i>
                            </div>
                            <div class="service-content">
                                <h3><a href="sraFeature">Sustainability Risk Assessment</a></h3>
                                @foreach($landingPages as $landingPage)
                                    <p style="text-align:left;">{!!$landingPage->key_feature_desc4!!}</p>
                                @endforeach
                                <p>Sustainability Risk Assessment (SRA) is a comprehensive assessment that we do in the
                                    company group, assess the level of
                                    transparency, compliance with RSPO standards, and commitment to the NDPE principle.</p>
                                <a href="sraFeature" class="btn-cta">
                                    <span>Explore</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="service-bg"></div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Features Section -->
        <section id="features" class="features section" hidden>

            <div class="container">

                <div class="row g-4">
                    <div class="col-lg-4">
                        <ul class="nav nav-tabs flex-column" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#features-tab-1" role="tab">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h4>Group</h4>
                                            <p>Quick search for a group companies</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2" role="tab">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box">
                                            <i class="bi bi-heart"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h4>Subsidiary</h4>
                                            <p>Quick search for a subsidiary/companies</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3" role="tab">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box">
                                            <i class="bi bi-house-heart"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h4>Shareholder</h4>
                                            <p>Quick search for a shareholder in a company</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4" role="tab">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box">
                                            <i class="bi bi-person-heart"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h4>Sustainability Risk Assessment</h4>
                                            <p>Quick check for a group RSA assessed</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-8">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="features-tab-1" role="tabpanel">
                                <div class="content-box">
                                    <div class="row g-4">
                                        <form action="{{ route('searchFunctionGroup') }}" method="GET" class="d-flex"
                                            style="width: 100%; background-color: #f8f9fa; border-radius: 10px; padding: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            <input type="text" class="form-control me-2" name="group_name"
                                                placeholder="Type a group name"
                                                style="border: 1px solid #007bff; border-radius: 5px;">
                                            <button type="submit" class="btn btn-info"
                                                style="border-radius: 5px; transition: background-color 0.3s;">
                                                Search
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="features-tab-2" role="tabpanel">
                                <div class="content-box">
                                    <div class="row g-4">
                                        <form action="{{ route('searchFunctionSubsidiary') }}" method="GET" class="d-flex"
                                            style="width: 100%; background-color: #f8f9fa; border-radius: 10px; padding: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            <input type="text" class="form-control me-2" name="subsidiary"
                                                placeholder="Type a company name"
                                                style="border: 1px solid #007bff; border-radius: 5px;">
                                            <button type="submit" class="btn btn-info"
                                                style="border-radius: 5px; transition: background-color 0.3s;">
                                                Search
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="features-tab-3" role="tabpanel">
                                <div class="content-box">
                                    <div class="row g-4">
                                        <form action="{{ route('searchFunctionShareholder') }}" method="GET" class="d-flex"
                                            style="width: 100%; background-color: #f8f9fa; border-radius: 10px; padding: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            <input type="text" class="form-control me-2" name="shareholder_name"
                                                placeholder="Type a shareholder name"
                                                style="border: 1px solid #007bff; border-radius: 5px;">
                                            <button type="submit" class="btn btn-info"
                                                style="border-radius: 5px; transition: background-color 0.3s;">
                                                Search
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="features-tab-4" role="tabpanel">
                                <div class="content-box">
                                    <div class="row g-4">
                                        <form id="search-form" action="{{ route('searchFunctionSRA') }}" method="GET"
                                            class="d-flex">
                                            <label for="search-input" class="visually-hidden">Search</label>
                                            <div class="input-group">
                                                <input type="text" id="search-input" name="group_name" class="form-control"
                                                    placeholder="Group name">
                                                <button type="submit" class="btn btn-info">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section><!-- /Features Section -->

        <!-- Pricing Section -->
        <section id="pricing" class="pricing section" hidden>

            <!-- Section Title -->
            <div class="container section-title">
                <h2>Pricing</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4 justify-content-center">

                    <!-- Basic Plan -->
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-item">
                            <div class="pricing-icon">
                                <i class="bi bi-star"></i>
                            </div>
                            <h3>Standard</h3>
                            <div class="price">
                                <span class="currency">$</span>9<span class="period">/month</span>
                            </div>
                            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                                eiusmod tempor.</p>
                            <ul class="features-list">
                                <li>
                                    <i class="bi bi-check2"></i>
                                    Vestibulum ante ipsum primis
                                </li>
                                <li>
                                    <i class="bi bi-check2"></i>
                                    Fusce vulputate eleifend
                                </li>
                                <li>
                                    <i class="bi bi-check2"></i>
                                    Nullam ac tortor vitae
                                </li>
                            </ul>
                            <a href="#" class="btn-pricing">Buy Now</a>
                        </div>
                    </div><!-- End Basic Plan -->

                    <!-- Professional Plan -->
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-item featured">
                            <div class="pricing-badge">Recommended</div>
                            <div class="pricing-icon">
                                <i class="bi bi-stars"></i>
                            </div>
                            <h3>Professional</h3>
                            <div class="price">
                                <span class="currency">$</span>29<span class="period">/month</span>
                            </div>
                            <p class="description">Maecenas tempus tellus eget condimentum rhoncus semper.</p>
                            <ul class="features-list">
                                <li>
                                    <i class="bi bi-check2"></i>
                                    Donec quam felis ultricies
                                </li>
                                <li>
                                    <i class="bi bi-check2"></i>
                                    Aenean massa imperdiet
                                </li>
                                <li>
                                    <i class="bi bi-check2"></i>
                                    Cras dapibus vivamus
                                </li>
                            </ul>
                            <a href="#" class="btn-pricing">Buy Now</a>
                        </div>
                    </div><!-- End Professional Plan -->

                    <!-- Ultimate Plan -->
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-item">
                            <div class="pricing-icon">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <h3>Ultimate</h3>
                            <div class="price">
                                <span class="currency">$</span>49<span class="period">/month</span>
                            </div>
                            <p class="description">Etiam rhoncus maecenas tempus tellus eget condimentum.</p>
                            <ul class="features-list">
                                <li>
                                    <i class="bi bi-check2"></i>
                                    Phasellus viverra nulla
                                </li>
                                <li>
                                    <i class="bi bi-check2"></i>
                                    Quisque rutrum aenean
                                </li>
                                <li>
                                    <i class="bi bi-check2"></i>
                                    Etiam ultricies nisi vel
                                </li>
                            </ul>
                            <a href="#" class="btn-pricing">Buy Now</a>
                        </div>
                    </div><!-- End Ultimate Plan -->

                </div>

            </div>

        </section><!-- /Pricing Section -->

        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <div class="container section-title">
                <h2>Frequently Asked Questions</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="faq-wrapper">

                            @foreach($faqs as $faq)
                                <div class="faq-item">
                                    <div class="faq-header">
                                        <div class="faq-icon">
                                            <i class="bi bi-question-circle"></i>
                                        </div>
                                        <h4>{!!$faq->question!!}</h4>
                                        <div class="faq-toggle">
                                            <i class="bi bi-plus"></i>
                                            <i class="bi bi-dash"></i>
                                        </div>
                                    </div>
                                    <div class="faq-content">
                                        <div class="content-inner">
                                            <p>{!!$faq->answer!!}</p>
                                        </div>
                                    </div>
                                </div><!-- End FAQ Item -->

                            @endforeach

                        </div>

                    </div>
                </div>

            </div>

        </section><!-- /Faq Section -->

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section light-background" hidden>

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
                                <span class="badge-custom">Premium Offer</span>
                                <h2 class="mt-4 mb-4">Transform Your Experience With Our Solution</h2>
                                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

                                <div class="row benefits-row mb-5">
                                    <div class="col-md-6">
                                        <div class="benefit-item">
                                            <div class="icon-box">
                                                <i class="bi bi-lightning-charge-fill"></i>
                                            </div>
                                            <div class="benefit-content">
                                                <h5>Quick Setup</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="benefit-item">
                                            <div class="icon-box">
                                                <i class="bi bi-shield-check"></i>
                                            </div>
                                            <div class="benefit-content">
                                                <h5>Full Security</h5>
                                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="action-buttons">
                                    <a href="#" class="btn btn-primary">Start Now</a>
                                    <a href="#" class="btn btn-outline">Learn More</a>
                                    <div class="guarantee-badge">
                                        <i class="bi bi-patch-check-fill"></i>
                                        <span>30-Day Money Back</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="cta-image-container">
                                <img src="{{ ('template/Passion/assets/img/illustration/illustration-3.webp') }}"
                                    alt="Illustration" class="img-fluid main-image">
                                <div class="floating-element element-1">
                                    <i class="bi bi-star-fill"></i>
                                    <span>4.9 Rating</span>
                                </div>
                                <div class="floating-element element-2">
                                    <i class="bi bi-people-fill"></i>
                                    <span>10k+ Users</span>
                                </div>
                                <div class="pattern-dots"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Call To Action Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section" hidden>
            <!-- Section Title -->
            <div class="container section-title">
                <h2>Contact</h2>
                {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
            </div><!-- End Section Title -->

            <div class="container">
                <div class="contact-main-wrapper">
                    <div class="map-wrapper">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d396.29641525454466!2d109.3290!3d-0.0391164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d59223736d773%3A0x2770035cd14138c6!2sEarthqualizer%20Foundation%20-%20Pontianak!5e0!3m2!1sid!2sid!4v1714200000000!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div class="contact-content">
                        <div class="contact-cards-container">
                            <div class="contact-card">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Location</h4>
                                    <p>Jl. Anggrek No. 6 Pontianak.</p>
                                </div>
                            </div>

                            <div class="contact-card">
                                <div class="icon-box">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Email</h4>
                                    <p>helpdesk@earthqualizer.org</p>
                                </div>
                            </div>

                            <div class="contact-card" hidden>
                                <div class="icon-box">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Call</h4>
                                    <p>+1 (212) 555-7890</p>
                                </div>
                            </div>

                            <div class="contact-card" hidden>
                                <div class="icon-box">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Open Hours</h4>
                                    <p>Monday-Friday: 9AM - 6PM</p>
                                </div>
                            </div>
                        </div>

                        <div class="contact-form-container">
                            <h3>Get in Touch</h3>

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
                                    <textarea class="form-control" name="message" rows="5" placeholder="Message"
                                        required=""></textarea>
                                </div>

                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
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
        </section><!-- /Contact Section -->

    </main>
@endsection