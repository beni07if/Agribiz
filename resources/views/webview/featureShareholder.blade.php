@extends('layout.app')

@section('content')
    <div class="main">

        @include('headerSection.headerShareholder')

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content">
                            <h2>Tracking Share Ownership</h2>
                            <p>We have share ownership data by individuals and companies in various industrial sectors. This
                                helps track the position, shares number and percentage in the company.</p>
                            <p class="lead">Type the shareholder name you want to search in the search bar</p>
                            <div class="content-box">
                                <div class="row g-4">
                                    <form action="{{ route('searchFunctionShareholder') }}" method="GET" class="d-flex">
                                        <input type="text" class="form-control me-2" name="shareholder_name"
                                            placeholder="Company name..">
                                        <button type="submit" class="btn btn-info"
                                            style="border-radius: 5px; transition: background-color 0.3s;">
                                            Search
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="image-wrapper">
                            <img src="{{ ('template/Passion/assets/img/about/about-square-8.webp') }}" alt="About Us"
                                class="img-fluid main-image">
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->
    </div>
@endsection