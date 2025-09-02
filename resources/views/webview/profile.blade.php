@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">My Profile</h3>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('success_password'))
            <div class="alert alert-success">{{ session('success_password') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            {{-- Update Profile --}}
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label>Full Name</label>
                                <input name="name" type="text" class="form-control"
                                    value="{{ old('name', Auth::user()->name) }}">
                            </div>
                            <div class="mb-3">
                                <label>Username</label>
                                <input name="username" type="text" class="form-control"
                                    value="{{ old('username', Auth::user()->username) }}">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control"
                                    value="{{ old('email', Auth::user()->email) }}">
                            </div>
                            <div class="mb-3">
                                <label>Profile Photo</label>
                                <input type="file" class="form-control" name="profile_photo">
                                @if(Auth::user()->profile_photo)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Photo" width="80"
                                        class="mt-2 rounded-circle">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Update Password --}}
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.password') }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-warning">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection