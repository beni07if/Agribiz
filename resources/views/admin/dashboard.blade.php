@extends('layout.appAdmin') {{-- layout utama NiceAdmin kamu --}}
@section('title', 'Admin Dashboard')


@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Summary Cards -->
            <div class="col-lg-3 col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Group Consolidation</h5>
                        <h6>{{ $groupCount ?? 0 }}</h6>
                    </div>
                </div>
            </div><!-- End Card -->

            <div class="col-lg-3 col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Data Consolidation</h5>
                        <h6>{{ $dataConCount ?? 0 }}</h6>
                    </div>
                </div>
            </div><!-- End Card -->

            <div class="col-lg-3 col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Company Ownership</h5>
                        <h6>{{ $ownershipCount ?? 0 }}</h6>
                    </div>
                </div>
            </div><!-- End Card -->

            <div class="col-lg-3 col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">SRA</h5>
                        <h6>{{ $sraCount ?? 0 }}</h6>
                    </div>
                </div>
            </div><!-- End Card -->

        </div><!-- End row -->

        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Insights Chart</h5>

                        <!-- Example Chart -->
                        <canvas id="dashboardChart" style="min-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right side -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quick Info</h5>
                        <p>Total Groups: {{ $groupCount ?? 0 }}</p>
                        <p>Total Consolidations: {{ $dataConCount ?? 0 }}</p>
                        <p>Total Ownerships: {{ $ownershipCount ?? 0 }}</p>
                        <p>Total SRAs: {{ $sraCount ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dashboardChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Group', 'Data Consolidation', 'Ownership', 'SRA'],
                datasets: [{
                    label: 'Dataset',
                    data: [{{ $groupCount ?? 0 }}, {{ $dataConCount ?? 0 }}, {{ $ownershipCount ?? 0 }}, {{ $sraCount ?? 0 }}],
                    borderWidth: 1,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
@endpush