@extends('layout.appAdmin') {{-- layout utama NiceAdmin kamu --}}
@section('title', 'Privacy Policy')

@section('content')
    <div class="pagetitle">
        <h1>Privacy Policy</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Privacy Policy</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile"
                            class="rounded-circle">
                        <h2>{{ auth()->user()->name }}</h2>
                        <h3>{{ auth()->user()->email }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Name</div>
                            <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection