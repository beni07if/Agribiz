@extends('layout.app')

@section('content')
    <main class="main">

        @include('headerSection.headerSra')

        <section id="sra-dashboard" class="py-5 bg-light">
            <div class="container">
                @if($sras->isNotEmpty())
                    @foreach($sras as $subs)
                        <!-- Hero -->
                        <div class="text-center section-title mb-5">
                            <h1 class="fw-bold display-5">SRA Performance of {{$subs->group_name}}</h1>
                            <p class="lead text-muted">Comprehensive compliance and transparency overview</p>
                        </div>

                        <div class="row">
                            <!-- Metrics Cards -->
                            <div class="col-lg-6 mb-4">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="card shadow-lg border-0 rounded-4 p-4 text-center h-100">
                                            <div class="mb-3"><i class="bi bi-eye-fill fs-1 text-primary"></i></div>
                                            <h6 class="fw-bold text-uppercase">Transparency</h6>
                                            <p class="mb-1 fs-4 fw-bold text-primary">{{$subs->transparency}} / 10</p>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 8%;"></div>
                                            </div>
                                            <small class="text-muted">{{$subs->percent_transparency}} %</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card shadow-lg border-0 rounded-4 p-4 text-center h-100">
                                            <div class="mb-3"><i class="bi bi-shield-x fs-1 text-danger"></i></div>
                                            <h6 class="fw-bold text-uppercase">RSPO Compliance</h6>
                                            <p class="mb-1 fs-4 fw-bold text-danger">{{$subs->rspo_compliance}} / 10</p>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 0%;"></div>
                                            </div>
                                            <small class="text-muted">{{$subs->percent_rspo_compliance}} %</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card shadow-lg border-0 rounded-4 p-4 text-center h-100">
                                            <div class="mb-3"><i class="bi bi-tree-fill fs-1 text-success"></i></div>
                                            <h6 class="fw-bold text-uppercase">NDPE Compliance</h6>
                                            <p class="mb-1 fs-4 fw-bold text-success">{{$subs->ndpe_compliance}} / 21</p>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%;"></div>
                                            </div>
                                            <small class="text-muted">{{$subs->percent_ndpe_compliance}} %</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card shadow-lg border-0 rounded-4 p-4 text-center h-100">
                                            <div class="mb-3"><i class="bi bi-graph-up-arrow fs-1 text-info"></i></div>
                                            <h6 class="fw-bold text-uppercase">Overall</h6>
                                            <p class="mb-1 fs-4 fw-bold text-info">{{$subs->total}} / 41</p>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 15%;"></div>
                                            </div>
                                            <small class="text-muted">{{$subs->percent_total}} %</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart Section -->
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow-lg rounded-4 p-4 h-100">
                                    <h5 class="fw-bold mb-3">📊 SRA Percentage Overview</h5>
                                    <canvas id="sraChart" style="height:300px;"></canvas>
                                </div>
                            </div>

                            <!-- Chart.js -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                // Data dari Controller
                                const labels = @json($labels);   // ['Transparency', 'RSPO Compliance', 'NDPE Compliance', 'Overall']
                                const data = @json($data);       // [[10,20,30,40], [15,25,35,45], ...]

                                // Hitung rata-rata setiap kolom
                                const avgData = labels.map((_, colIndex) => {
                                    let sum = 0;
                                    data.forEach(row => sum += row[colIndex] || 0);
                                    return Math.round(sum / (data.length || 1));
                                });

                                // Render Chart.js
                                const ctx = document.getElementById('sraChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Average Score %',
                                            data: avgData,
                                            backgroundColor: ['#0d6efd', '#dc3545', '#198754', '#0dcaf0']
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: { display: false }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                max: 100,
                                                ticks: {
                                                    callback: function (value) {
                                                        return value + '%'; // tampilkan persen
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>

                        </div>

                        <section id="assessment-detail" class="py-5 bg-light">
                            <div class="container">
                                <!-- Title -->
                                <div class="text-center mb-5">
                                    <h3 class="fw-bold text-primary mb-2">📝 SRA Assessment Details</h3>
                                    <div class="d-inline-flex gap-2 small align-items-center">
                                        <span class="badge rounded-pill bg-success">High</span>
                                        <span class="badge rounded-pill bg-warning text-dark">Medium</span>
                                        <span class="badge rounded-pill bg-danger">Low</span>
                                        <span class="badge rounded-pill bg-secondary">No Data</span>
                                    </div>
                                </div>

                                <div class="accordion" id="assessmentAccordion">

                                    <!--  TRANSPARENCY  -->
                                    <div class="accordion-item border-0 shadow-sm rounded-3 mb-4">
                                        <h2 class="accordion-header" id="tHeading">
                                            <button class="accordion-button gap-2 fw-semibold text-primary" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#tCollapse" aria-expanded="true"
                                                aria-controls="tCollapse">
                                                <i class="bi bi-eye-fill text-primary"></i>
                                                <span>Transparency</span>
                                                <span class="badge ms-2 bg-danger">Score 0</span>
                                            </button>
                                        </h2>

                                        <div id="tCollapse" class="accordion-collapse collapse show" aria-labelledby="tHeading"
                                            data-bs-parent="#assessmentAccordion">
                                            <div class="accordion-body">

                                                <!-- Upstream Transparency -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-diagram-3-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Upstream transparency</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_transparency_upstream}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">{{$subs->desc_transparency_upstream}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#tUpstreamDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="tUpstreamDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped align-middle small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>2 = High</td>
                                                                            <td>
                                                                                Availability and sufficient level of detail on:
                                                                                <ul class="mb-0 mt-2">
                                                                                    <li>Company subsidiaries (including mills,
                                                                                        refineries, etc.)</li>
                                                                                    <li>Total landbank and planted land</li>
                                                                                    <li>Location of concessions and mills</li>
                                                                                    <li>Up-to-date supplier lists (at least one
                                                                                        quarter before research)</li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>0 = Low</td>
                                                                            <td>
                                                                                <ul class="mb-0">
                                                                                    <li>Substantial parts of the above-mentioned
                                                                                        criteria are not clear, not complete, not
                                                                                        up-to-date, or there are other reasons to
                                                                                        doubt</li>
                                                                                    <li>No or very limited information available on
                                                                                        the above-mentioned criteria</li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Sustainability & Policy Implementation -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-journal-text text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Sustainability and Policy Implementation
                                                                    report</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_transparency_sustainability}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_transparency_sustainability}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#tSustainDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="tSustainDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped align-middle small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>2 = High</td>
                                                                            <td>
                                                                                Company is reporting (at least) annually on
                                                                                implementation progress
                                                                                (e.g. sustainability report, progress report, or
                                                                                dashboard); and/or
                                                                                company is actively engaging with NGOs; and/or
                                                                                company is active in
                                                                                working groups (e.g. POIG).
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>0 = Low</td>
                                                                            <td>There is no evidence that the company is actively
                                                                                implementing any commitments, and there are no signs
                                                                                that this will change soon.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Refiners & Grievance -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-chat-dots-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Refiners and grievance management</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_transparency_refiners}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">{{$subs->desc_transparency_refiners}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#tGrievDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="tGrievDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped align-middle small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>2 = High</td>
                                                                            <td>
                                                                                Availability and sufficient level of details on:
                                                                                <ul class="mb-0 mt-2">
                                                                                    <li>Grievance and complaint handling</li>
                                                                                    <li>Supplier mill list at refinery level</li>
                                                                                </ul>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Medium</td>
                                                                            <td>Substantial parts of the above-mentioned criteria
                                                                                are not clear or not complete.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>0 = Low</td>
                                                                            <td>No grievance information available.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Publish Maps -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-map-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Publish Maps</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_transparency_publish_maps}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_transparency_publish_maps}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-warning text-dark" style="width:33%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#tMapsDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="tMapsDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped align-middle small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = High</td>
                                                                            <td>Full submission.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = Medium</td>
                                                                            <td>Partial submission.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Low</td>
                                                                            <td>No submission and no RSPO membership.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- % of Concessions Legal Status -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-patch-check-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">% of concessions that obtain legal status
                                                                    (HGU, SHM, MPOB)</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_transparency_concessions}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_transparency_concessions}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2 mt-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#tLegalDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="tLegalDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped align-middle small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>2 = 70% to 100%</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = 30% to &lt; 70%</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>0 = less than 30%</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Website -->
                                                <div class="assess-card card border-0 shadow-sm">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-globe2 text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Website</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_transparency_website}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">{{$subs->desc_transparency_website}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#tWebDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="tWebDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped align-middle small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>1 = Yes</td>
                                                                            <td>Does the company have a website?</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>0 = No</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!--  RSPO COMPLIANCE  -->
                                    <div class="accordion-item border-0 shadow-sm rounded-3 mb-4">
                                        <h2 class="accordion-header" id="rHeading">
                                            <button class="accordion-button collapsed gap-2 fw-semibold text-danger" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#rCollapse" aria-expanded="false"
                                                aria-controls="rCollapse">
                                                <i class="bi bi-shield-x text-danger"></i>
                                                <span>RSPO Compliance</span>
                                                <span class="badge ms-2 bg-secondary">Score 0</span>
                                            </button>
                                        </h2>

                                        <div id="rCollapse" class="accordion-collapse collapse" aria-labelledby="rHeading"
                                            data-bs-parent="#assessmentAccordion">
                                            <div class="accordion-body">

                                                <!-- Registration at the group level -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-people-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Registration at the group level</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_rspo_certification_progress}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_rspo_certification_progress}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#rGroupDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="rGroupDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>2 = High</td>
                                                                            <td>Group and complete info on subsidiaries.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Medium</td>
                                                                            <td>Group but not complete info on subsidiaries.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>0 = Low</td>
                                                                            <td>One entity registered only.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- RSPO certification progress -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-award-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">RSPO certification progress since first
                                                                    membership</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_rspo_certification_progress}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_rspo_certification_progress}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#rProgressDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="rProgressDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 : &gt; 10 years membership</td>
                                                                            <td>Between 70%–100% certification.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 : &lt; 5–10 years membership</td>
                                                                            <td>Between 30%–70% certification.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 : 0–5 years membership</td>
                                                                            <td>Between 0–30% certification.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- % of plantations RSPO audited -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-clipboard-check-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">% of plantations RSPO audited</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_rspo_percent_plantations}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_rspo_percent_plantations}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#rAuditDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="rAuditDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>2 : 70% to 100%</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 : 30% to &lt; 70%</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>0 : less than 30%</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- RSPO Complaints -->
                                                <div class="assess-card card border-0 shadow-sm">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-exclamation-octagon-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">RSPO Complaints</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_rspo_complaints}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_rspo_complaints}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#rComplaintDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="rComplaintDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:190px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = High</td>
                                                                            <td>No complaints detected.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = Medium</td>
                                                                            <td>Cases have been detected and closed.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Low</td>
                                                                            <td>Cases have been detected and investigation is in
                                                                                progress.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- NDPE COMPLIANCE  -->
                                    <div class="accordion-item border-0 shadow-sm rounded-3">
                                        <h2 class="accordion-header" id="nHeading">
                                            <button class="accordion-button collapsed gap-2 fw-semibold text-success" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#nCollapse" aria-expanded="false"
                                                aria-controls="nCollapse">
                                                <i class="bi bi-tree-fill text-success"></i>
                                                <span>NDPE Compliance</span>
                                                <span class="badge ms-2 bg-success">Score 6</span>
                                            </button>
                                        </h2>

                                        <div id="nCollapse" class="accordion-collapse collapse" aria-labelledby="nHeading"
                                            data-bs-parent="#assessmentAccordion">
                                            <div class="accordion-body">

                                                <!-- NDPE Policy adopted -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-shield-check text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">NDPE Policy adopted</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_ndpe_policy_adopted}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_ndpe_policy_adopted}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#nPolicyDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="nPolicyDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:210px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = Publicly available and adopted</td>
                                                                            <td>NDPE policy is available on company website and
                                                                                adopted.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = Adopted but not made public</td>
                                                                            <td>NDPE policy is not available, but it is known that
                                                                                the company has adopted a policy.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = NDPE policy published, but not adopted</td>
                                                                            <td>The company has published a NDPE policy but not
                                                                                adopted it.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>0 = No NDPE policy adopted</td>
                                                                            <td>The company has not published and not adopted a NDPE
                                                                                policy.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Social issues -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-emoji-frown-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Social issues (reported or identified by
                                                                    EQ)</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_ndpe_social_issues}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_ndpe_social_issues}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#nSocialDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="nSocialDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:210px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = No issues since January 2016</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = ≤ 30% of subsidiaries since 2016</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = 30–70% of subsidiaries since Jan 2016</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>0 = &gt; 70% of subsidiaries</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Deforestation -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-activity text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Deforestation (ha)</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_ndpe_deforestation}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_ndpe_deforestation}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-warning text-dark" style="width:33%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#nDeforDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="nDeforDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:210px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = Not detected after 1 January 2016</td>
                                                                            <td>No deforestation since 2016.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = Detected 1 Jan 2016 – 31 Dec 2018</td>
                                                                            <td>Deforestation was detected after 2016 and stopped.
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Detected after 1 January 2019</td>
                                                                            <td>Deforestation has been detected in 2019.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Peatland development -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-moisture text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Peatland development (including peatforest)
                                                                </h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_ndpe_peatland_development}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_ndpe_peatland_development}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-success" style="width:66%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#nPeatDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="nPeatDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:210px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = Not detected after 1 January 2016</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = Detected 1 Jan 2016 – 31 Dec 2018</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Detected after 1 January 2019</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Burn areas -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-fire text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Burn areas (ha)</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_ndpe_burn_areas}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_ndpe_burn_areas}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-warning text-dark" style="width:33%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#nBurnDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="nBurnDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:210px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = Not detected after 1 January 2016</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = Detected 1 Jan 2016 – 31 Dec 2018</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Detected after 1 January 2019</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Land protection and usage -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-shield-fill-check text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Land protection and usage</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_ndpe_land_protection}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_ndpe_land_protection}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-warning text-dark" style="width:33%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#nLandDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="nLandDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:210px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = High</td>
                                                                            <td>No burning.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = Medium</td>
                                                                            <td>Burning was detected but not planted with oil palm.
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Low</td>
                                                                            <td>Burning and oil palm planting have been detected.
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Restoration in Peatland -->
                                                <div class="assess-card card border-0 shadow-sm mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-arrow-counterclockwise text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">Restoration in Peatland</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_ndpe_restoration_in_peatland}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_ndpe_restoration_in_peatland}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2" style="height:10px;">
                                                            <div class="progress-bar bg-warning text-dark" style="width:33%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#nRestoreDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="nRestoreDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:210px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = High</td>
                                                                            <td>No peatland conversion.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = Medium</td>
                                                                            <td>Peatland conversion and restoration have been
                                                                                detected.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Low</td>
                                                                            <td>Peatland conversion detected but no restoration
                                                                                measures have been taken.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- HCV/HCS Assessment -->
                                                <div class="assess-card card border-0 shadow-sm">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="bi bi-layers-fill text-primary fs-5"></i>
                                                                <h6 class="mb-0 fw-bold">HCV/HCS Assessment</h6>
                                                            </div>
                                                            <span class="badge bg-danger">Score
                                                                {{$subs->score_hcvhcs_assessment}}</span>
                                                        </div>
                                                        <p class="text-muted small mt-2 mb-3">
                                                            {{$subs->desc_hcvhcs_assessment}}
                                                        </p>
                                                        <div class="progress progress-slim mb-2 mt-2" style="height:10px;">
                                                            <div class="progress-bar bg-danger" style="width:0%"></div>
                                                        </div>
                                                        <a class="link-primary small text-decoration-none" data-bs-toggle="collapse"
                                                            href="#nHcvDetail">Click here to details</a>

                                                        <div class="collapse mt-3" id="nHcvDetail">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-striped small mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width:210px;">Score Parameter</th>
                                                                            <th>Description</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>3 = High</td>
                                                                            <td>Have commitment and completed full assessment for
                                                                                all concessions.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>2 = Medium</td>
                                                                            <td>Have commitment and/or assessment, but not complete
                                                                                for all concessions.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>1 = Low</td>
                                                                            <td>No commitment and assessment has been made.</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div> <!-- /accordion -->
                            </div>

                            <!-- tiny styling to polish cards -->
                            <style>
                                #assessment-detail .assess-card .card-body {
                                    padding: 1rem 1.1rem;
                                }

                                #assessment-detail .accordion-button {
                                    background: #f7fbff;
                                }

                                #assessment-detail .progress-slim {
                                    border-radius: 999px;
                                    overflow: hidden;
                                }

                                #assessment-detail .badge {
                                    font-weight: 600;
                                }
                            </style>
                        </section>
                    @endforeach
                @endif
            </div>
        </section>

    </main>
@endsection