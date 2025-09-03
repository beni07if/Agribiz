@extends('layout.app')

@section('content')
    <div class="main">

        <!-- Page Title -->
        <div class="page-title dark-background"
            style="background-image: url('{{ ('template/Passion/assets/img/bg/bg-14.webp') }}');">
            <div class="container position-relative">
                <h1>Privacy & Policy</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{route('corporateProfileEn')}}">Home</a></li>
                        <li class="current">Privacy & Policy</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <section id="faq" class="faq section">

            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="faq-wrapper">

                            @foreach($policies as $policy)
                                <p>{!!$policy->description!!}</p>
                            @endforeach

                        </div>

                    </div>
                </div>

            </div>

        </section>
    </div>
@endsection