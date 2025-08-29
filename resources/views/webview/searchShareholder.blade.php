@extends('layout.app')

@section('content')
    <main class="main">

        @include('headerSection.headerShareholder')

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <div class="container">

                <div class="row gy6">

                    @if($shareholderNames->isNotEmpty())
                            @foreach($shareholderNames as $subs)

                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="service-card compact position-relative p-3 h-100">

                                        <div class="row align-items-center g-3">
                                            <div class="col-12">
                                                <div class="service-content">

                                                    {{-- Shareholder Name --}}
                                                    <form action="{{ route('shareholderShow') }}" method="POST"
                                                        enctype="multipart/form-data" class="mb-2">
                                                        @csrf
                                                        <input type="hidden" name="shareholder_name"
                                                            value="{{ $subs->shareholder_name }}">
                                                        <input type="hidden" name="date_of_birth" value="{{ $subs->date_of_birth }}">

                                                        <button type="submit"
                                                            class="btn w-100 text-start fw-bold fs-5 shadow-sm border-0"
                                                            style="background:#fff; transition:all 0.3s ease;">
                                                            {{ $subs->shareholder_name }}
                                                        </button>
                                                    </form>

                                                    {{-- Company Name --}}
                                                    <form action="{{ route('subsidiaryShow') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <span class="me-1 text-muted">Holds shares in:</span>
                                                        <button type="submit" name="subsidiary" value="{{ $subs->company_name }}"
                                                            class="btn btn-light shadow-sm border-0 px-3 fw-semibold"
                                                            style="transition:all 0.3s ease;">
                                                            {{ $subs->company_name }}
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{-- Hover effect pakai Bootstrap + tambahan kecil --}}
                                <style>
                                    .btn:hover {
                                        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2) !important;
                                        transform: translateY(-2px);
                                    }
                                </style>

                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $shareholderNames->links('pagination::bootstrap-5') }}
                        </div>

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
                    </div>

                @endif

            </div>

        </section>
        <!-- /Services Section -->

    </main>
@endsection