@extends('layout.app')

@section('content')
    <div class="main">

        @include('headerSection.headerSra')

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content">
                            <h2>Sustainability Risk Assessment (SRA)</h2>
                            <p>Sustainability Risk Assessment (SRA) is a comprehensive assessment that we do in the company
                                group, assess the level of transparency, compliance with RSPO standards, and commitment to
                                the NDPE principle. With this assessment, we help ensure your business runs according to the
                                best sustainability standards and increase stakeholder trust.</p>
                            <p class="lead">Type the group name you want to search in the search bar</p>
                            <div class="content-box">
                                <div class="row g-4">
                                    <form action="{{ route('searchFunctionSRA') }}" method="GET" class="d-flex">
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
                                            <div class="label">SRA Group Assessed</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="image-wrapper">
                            <img src="{{ ('template/Passion/assets/img/illustration/sra4.jpg') }}" alt="About Us"
                                class="img-fluid main-image">
                            <div class="floating-card">
                                <div class="card-content">
                                    <i class="bi bi-pie-chart-fill"></i>
                                    <div class="text">
                                        <h5>Featured Feature</h5>
                                        <span>Sustainability Risk Assessment (SRA)</span>
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