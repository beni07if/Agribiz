@extends('layout.app')

@section('content')
    <div class="main">

        @include('headerSection.headerGroup')

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content">
                            <h2>Corporate Group Structure</h2>
                            <p>We are an experienced team in identifying and formulating the structure of the
                                company's group hierarchy which includes relationships with other companies, share
                                ownership, and who are the benefits of ownership from the group to encourage meaningful
                                results for businesses throughout the world.</p>
                            <p class="lead">Type the group name you want to search in the search bar</p>
                            <div class="content-box">
                                <div class="row g-4">
                                    <form action="{{ route('searchFunctionGroup') }}" method="GET" class="d-flex">
                                        <input type="text" class="form-control me-2" name="group_name"
                                            placeholder="Group name..">
                                        <button type="submit" class="btn btn-info"
                                            style="border-radius: 5px; transition: background-color 0.3s;">
                                            Search
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="stats-container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="stat-item">
                                            <div class="number">
                                                {{ number_format(floor($groupCountsDistinct / 100) * 100) }}+
                                            </div>
                                            <div class="label">Group Identified</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="stat-item">
                                            <div class="number">
                                                {{ number_format(floor($groupCountsDistinct / 100) * 100) }}+
                                            </div>
                                            <div class="label">Group Structure Assessed</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="image-wrapper">
                            <img src="{{ ('template/Passion/assets/img/illustration/company-hierarchy2.jpg') }}"
                                alt="About Us" class="img-fluid main-image">
                            <div class="floating-card">
                                <div class="card-content">
                                    <i class="bi bi-gem"></i>
                                    <div class="text">
                                        <h5>Featured Feature</h5>
                                        <span>Corporate Group Structure</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->
    </div>
@endsection