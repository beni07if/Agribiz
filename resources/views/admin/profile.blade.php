@extends('layout.appAdmin')

@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    {{-- General flash messages --}}
    @if(session('success_password'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success_password') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error_password'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error_password') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- If validation errors for password exist, show a short alert --}}
    @if($errors->has('current_password') || $errors->has('password'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Please fix the errors in the Change Password form below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <!-- Profile Card -->
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo"
                                class="img-thumbnail rounded-circle" width="120">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar"
                                class="img-thumbnail rounded-circle" width="120">
                        @endif
                        <h2>{{ Auth::user()->name }}</h2>
                        <h3>{{ Auth::user()->role ?? 'User' }}</h3>

                        <!-- Buttons -->
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="bi bi-pencil-square"></i> Edit Profile
                        </button>

                        <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="bi bi-lock"></i> Change Password
                        </button>
                    </div>
                </div><!-- End Profile Card -->

            </div>

            <div class="col-xl-8">
                <!-- Details Card -->
                <div class="card">
                    <div class="card-body pt-3">
                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Full Name</div>
                            <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Username</div>
                            <div class="col-lg-9 col-md-8">{{ Auth::user()->username }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Role</div>
                            <div class="col-lg-9 col-md-8">{{ Auth::user()->role ?? '-' }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Level</div>
                            <div class="col-lg-9 col-md-8">{{ Auth::user()->level ?? '-' }}</div>
                        </div>
                    </div>
                </div><!-- End Details Card -->
            </div>
        </div>
    </section>

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="profile_photo" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                        @if(auth()->user()->profile_photo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo"
                                    width="80" class="rounded-circle">
                            </div>
                        @endif
                    </div>

                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Full Name</label>
                            <div class="col-md-8">
                                <input name="name" type="text" class="form-control" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-8">
                                <input name="username" type="text" class="form-control"
                                    value="{{ Auth::user()->username }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input name="email" type="email" class="form-control" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="profile_photo" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                            @if(auth()->user()->profile_photo)
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/profile/' . auth()->user()->profile_photo) }}"
                                        alt="Profile Photo" width="80" class="rounded-circle">
                                </div>
                            @endif
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Role</label>
                            <div class="col-md-8">
                                <input name="role" type="text" class="form-control" value="{{ Auth::user()->role }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Level</label>
                            <div class="col-md-8">
                                <input name="level" type="text" class="form-control" value="{{ Auth::user()->level }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Modal -->

    <!-- Modal Change Password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Current Password</label>
                            <div class="col-md-8">
                                <input name="current_password" type="password"
                                    class="form-control @error('current_password') is-invalid @enderror" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">New Password</label>
                            <div class="col-md-8">
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label">Confirm Password</label>
                            <div class="col-md-8">
                                <input name="password_confirmation" type="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Modal -->

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // jika ada error validasi untuk current_password atau password, buka modal
                @if($errors->has('current_password') || $errors->has('password'))
                    var modalEl = document.getElementById('changePasswordModal');
                    if (modalEl) {
                        var modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                @endif

                // juga jika ada pesan sukses, scroll ke atas supaya user lihat alert
                @if(session('success_password'))
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                @endif
                                                                        });
        </script>
    @endpush


@endsection