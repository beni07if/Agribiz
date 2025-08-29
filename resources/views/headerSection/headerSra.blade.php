<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ ('template/Passion/assets/img/bg/bg-14.webp') }}');">
    <div class="container position-relative">
        <h1>Sustainability Risk Assessment (SRA)</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{route('corporateProfileEn')}}">Home</a></li>
                <li class="current">SRA by Group</li>
            </ol>
        </nav>
        <div class="tab-pane fade active show" id="features-tab-1" role="tabpanel">
            <div class="content-box text-center">

                <form action="{{ route('searchFunctionSRA') }}" method="GET"
                    class="search-wrapper d-inline-flex align-items-center bg-white shadow-sm rounded-pill px-3 py-2">

                    {{-- Input (hidden by default, expand on hover/focus) --}}
                    <input type="text" class="form-control border-0 shadow-0 px-2 search-input" name="group_name"
                        placeholder="Type a group name..."
                        style="background: transparent; font-size: 0.95rem; display:none;">

                    {{-- Button with search icon --}}
                    <button type="submit"
                        class="btn btn-primary d-flex align-items-center justify-content-center search-btn rounded-circle"
                        style="width:40px; height:40px;">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

            </div>
        </div>

        @include('styleAdditional.styleSearch')

    </div>
</div><!-- End Page Title -->