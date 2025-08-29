@extends('layout.app')

@section('content')
    <main class="main">

        @include('headerSection.headerShareholder')

        <section id="shareholders" class="services section-bg">
            <div class="container" data-aos="fade-up">

                @if($allShareholderNames->isNotEmpty())

                    {{-- Basic Information --}}
                    <div class="row mb-5">
                        <div class="col-lg-12">
                            <div class="card shadow-sm border-0 rounded p-4" data-aos="fade-up" data-aos-delay="100">
                                <h4 class="fw-bold mb-3">Basic Information</h4>
                                <div class="row gy-3">
                                    <div class="col-md-6"><strong>👤 Name:</strong>
                                        {{ $allShareholderNames->pluck('shareholder_name')->unique()->join(', ') ?? '-' }}
                                    </div>
                                    <div class="col-md-6"><strong>🪪 ID/Company No:</strong>
                                        {{ $allShareholderNames->pluck('ic_pasport_comp_number')->unique()->join(', ') ?? '-' }}
                                    </div>
                                    <div class="col-md-6"><strong>🎂 Date of Birth:</strong>
                                        {{ $allShareholderNames->pluck('date_of_birth')->unique()->join(', ') ?? '-' }}
                                    </div>
                                    <div class="col-md-6"><strong>📍 Address:</strong>
                                        {{ $allShareholderNames->pluck('address')->unique()->join(', ') ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shareholder Ownership Section -->
                    <section id="share-ownership" class="how-we-work section">

                        <!-- Section Title -->
                        <div class="container section-title">
                            @foreach($allShareholderNames->pluck('shareholder_name')->unique() as $subs)
                                <h2>The following are the business ownership related to {{ $subs }}</h2>
                            @endforeach
                        </div><!-- End Section Title -->

                        <div class="container">
                            <div class="steps-grid">
                                @foreach($allShareholderNames->unique('company_name') as $shareholder)
                                    @if($shareholder->company_name)
                                        <div class="step-card">
                                            <div class="step-icon"><i class="bi bi-building"></i></div>
                                            <div class="step-number">{{ $loop->iteration }}</div>

                                            <h3>
                                                <form action="{{ route('subsidiaryShow') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="subsidiary" value="{{ $shareholder->company_name }}">
                                                    <button type="submit"
                                                        style="background:none; border:none; color:#012970; font-weight:bold; cursor:pointer;">
                                                        {{ $shareholder->company_name }}
                                                    </button>
                                                </form>
                                            </h3>

                                            <p>
                                                <strong>Position:</strong> {{ $shareholder->position ?? '-' }} <br>
                                                <strong>Percentage:</strong> {{ $shareholder->percentage_of_shares ?? '-' }} <br>
                                                <strong>Shares:</strong> {{ $shareholder->number_of_shares ?? '-' }}
                                                ({{ $shareholder->currency ?? '-' }}) <br>
                                                <strong>Update:</strong> {{ $shareholder->data_update ?? '-' }}
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="container mt-4 text-center">
                            <h6 class="text-muted"><i>*Data source by Inovasi Digital</i></h6>
                        </div>
                    </section><!-- /Shareholder Ownership Section -->

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
                                            <p class="mb-4">Currently the data is not available, please reach out to us to
                                                request access.</p>

                                            <div class="row benefits-row mb-5 contact contact-content">
                                                <div class="contact-card col-lg-6 col-md-6">
                                                    <div class="icon-box"><i class="bi bi-envelope"></i></div>
                                                    <div class="contact-text">
                                                        <h4>Email</h4>
                                                        <p>info@examplecompany.com</p>
                                                    </div>
                                                </div>
                                                <div class="contact-card col-lg-6 col-md-6">
                                                    <div class="icon-box"><i class="bi bi-clock"></i></div>
                                                    <div class="contact-text">
                                                        <h4>Open Hours</h4>
                                                        <p>Monday-Friday: 9AM - 6PM</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="action-buttons">
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
                                                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor
                                                    incididunt ut labore et dolore magna aliqua consectetur adipiscing.</p>

                                                <form action="forms/contact.php" method="post" class="php-email-form">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <input type="text" name="name" class="form-control"
                                                                placeholder="Your Name" required>
                                                        </div>
                                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                                            <input type="email" class="form-control" name="email"
                                                                placeholder="Your Email" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <input type="text" class="form-control" name="subject"
                                                            placeholder="Subject" required>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <textarea class="form-control" name="message" rows="5"
                                                            placeholder="Message" required></textarea>
                                                    </div>
                                                    <div class="form-submit mt-3">
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
                        </div>
                    </section><!-- /Call To Action Section -->

                @endif

            </div>
        </section>


    </main>
@endsection