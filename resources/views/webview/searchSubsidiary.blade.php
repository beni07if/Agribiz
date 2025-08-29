@extends('layout.app')

@section('content')
    <main class="main">

        @include('headerSection.headerSubsidiary')

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <div class="container">
                <form action="{{ route('subsidiaryShow') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="row gy6">

                        @if($companyOwnerships->isNotEmpty())
                                @foreach($companyOwnerships as $subs)

                                    <div class="col-lg-6 col-md-6 mb-4"> <!-- kasih margin bawah -->
                                        <div class="service-card compact position-relative p-3 h-100">

                                            <!-- Badge di pojok kanan atas tapi agak ke dalam -->
                                            <span class="badge bg-secondary position-absolute top-0 end-0 mt-3 me-3">
                                                {{ $subs->country_operation }}
                                            </span>

                                            <div class="row align-items-center g-3">
                                                <!-- Kolom Kanan: Konten -->
                                                <div class="col-12">
                                                    <div class="service-content">
                                                        <h3 class="mb-1">{{ $subs->company_name }}</h3>
                                                        <p class="mb-2">{{ $subs->registered_address }}</p>

                                                        <button type="submit" name="subsidiary" value="{{ $subs->subsidiary }}"
                                                            class="btn btn-xs">
                                                            <span>Explore</span>
                                                            <i class="bi bi-arrow-right"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $companyOwnerships->links('pagination::bootstrap-5') }}
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

                                <!-- Contact Section -->
                                <section id="contact" class="contact section">
                                    <!-- Section Title -->
                                    <div class="container section-title">
                                        <h2>Contact</h2>
                                        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
                                    </div><!-- End Section Title -->

                                    <div class="container">
                                        <div class="contact-main-wrapper">
                                            <div class="map-wrapper">
                                                <iframe
                                                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                                                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>

                                            <div class="contact-content">
                                                <div class="contact-cards-container">
                                                    <div class="contact-card">
                                                        <div class="icon-box">
                                                            <i class="bi bi-geo-alt"></i>
                                                        </div>
                                                        <div class="contact-text">
                                                            <h4>Location</h4>
                                                            <p>8721 Broadway Avenue, New York, NY 10023</p>
                                                        </div>
                                                    </div>

                                                    <div class="contact-card">
                                                        <div class="icon-box">
                                                            <i class="bi bi-envelope"></i>
                                                        </div>
                                                        <div class="contact-text">
                                                            <h4>Email</h4>
                                                            <p>info@examplecompany.com</p>
                                                        </div>
                                                    </div>

                                                    <div class="contact-card">
                                                        <div class="icon-box">
                                                            <i class="bi bi-telephone"></i>
                                                        </div>
                                                        <div class="contact-text">
                                                            <h4>Call</h4>
                                                            <p>+1 (212) 555-7890</p>
                                                        </div>
                                                    </div>

                                                    <div class="contact-card">
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
                                                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor
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

                        </div>

                    @endif
            </form>
            </div>

        </section><!-- /Services Section -->

    </main>
@endsection