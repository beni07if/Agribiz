@extends('layout.appAdmin')
@section('title', 'Admin Dashboard')

@section('content')
    <div class="pagetitle">
        <h1>SRA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">SRA</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data SRA</h5>

                        <!-- Import / Export -->
                        <form action="{{ route('admin.sra.import') }}" method="POST" enctype="multipart/form-data"
                            class="mb-3 d-flex align-items-center gap-2">
                            @csrf
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                            <button type="submit" class="btn btn-primary">Import Excel</button>
                            <a href="{{ route('admin.sra.export') }}" class="btn btn-success">Download Excel</a>
                        </form>

                        <table id="sraTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Group</th>
                                    <th>Group Name</th>
                                    <th>Transparency</th>
                                    <th>% Transparency</th>
                                    <th>RSPO Compliance</th>
                                    <th>% RSPO Compliance</th>
                                    <th>NDPE Compliance</th>
                                    <th>% NDPE Compliance</th>
                                    <th>Total</th>
                                    <th>% Total</th>
                                    {{-- <th>Last Updated</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sras as $sra)
                                    <tr>
                                        <td>{{ $sra->idGroup }}</td>
                                        <td>{{ $sra->group_name }}</td>
                                        <td>{{ $sra->transparency }}</td>
                                        <td>{{ $sra->percent_transparency }}</td>
                                        <td>{{ $sra->rspo_compliance }}</td>
                                        <td>{{ $sra->percent_rspo_compliance }}</td>
                                        <td>{{ $sra->ndpe_compliance }}</td>
                                        <td>{{ $sra->percent_ndpe_compliance }}</td>
                                        <td>{{ $sra->total }}</td>
                                        <td>{{ $sra->percent_total }}</td>
                                        {{-- <td>{{ $sra->updated_at->format('d M Y') }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#sraTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        className: 'btn btn-success mb-3'
                    }
                ]
            });
        });
    </script>
@endsection