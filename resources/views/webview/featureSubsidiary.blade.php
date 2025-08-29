@extends('layout.app')

@section('content')
    <div class="main">

        @include('headerSection.headerSubsidiary')

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content">
                            <h2>Corporate Profile Identification</h2>
                            <p>Our corporate profile service is designed to describe all company business activities as a
                                whole, ranging from gardens, mill, production facilities, to manufacturing. This profile
                                presents key information such as the structure of share ownership, mill and plantation
                                operations, as well as other important data that provides a complete and transparent picture
                                of the strengths and capabilities of the company's business.</p>
                            <p>With a professional design and accurate data, this Corporate Profile becomes an effective
                                strategic tool to identify the company's profile comprehensively.</p>
                            <p hidden>Layanan corporate profile kami dirancang untuk menggambarkan seluruh aktivitas bisnis
                                perusahaan secara menyeluruh, mulai dari kebun, mill, fasilitas produksi, hingga manufaktur.
                                Profil ini menyajikan informasi kunci seperti struktur kepemilikan saham, operasional pabrik
                                dan kebun, serta data penting lainnya yang memberikan gambaran lengkap dan transparan
                                mengenai kekuatan dan kapabilitas bisnis perusahaan.
                                Dengan desain profesional dan data yang akurat, corporate profile ini menjadi alat strategis
                                yang efektif untuk mengidentifikasi profile perusahaan secara komprehensif.</p>
                            <p class="lead">Type the company name you want to search in the search bar</p>
                            <div class="content-box">
                                <div class="row g-4">
                                    <form action="{{ route('searchFunctionSubsidiary') }}" method="GET" class="d-flex">
                                        <input type="text" class="form-control me-2" name="subsidiary"
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