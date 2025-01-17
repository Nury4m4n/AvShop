@extends('Home.layouts.main')

@section('content')
    <div class="container-fluid p-5">
        <div class="card border-0 shadow-sm rounded-lg">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="profile-picture me-4">
                        @if ($userDetail->profile_picture)
                            <img src="{{ asset('storage/' . $userDetail->profile_picture) }}" alt="Profile Picture"
                                class="rounded-circle" width="120" height="120" style="object-fit: cover;">
                        @else
                            <img src="{{ asset('img/alshafwah.png') }}" alt="Default Profile Picture" class="rounded-circle"
                                width="120" height="120" style="object-fit: cover;">
                        @endif
                    </div>
                    <div>
                        <h2 class="font-weight-bold mb-2">{{ $userDetail->user->name }}</h2>
                        <a href="{{ route('user_details.edit', $userDetail->id) }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>

                <h4 class="font-weight-bold mb-4">My Profile</h4>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="text-muted">Name</label>
                        <input type="text" class="form-control border-0" value="{{ $userDetail->name }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="text-muted">email</label>
                        <input type="text" class="form-control border-0" value="{{ auth()->user()->email }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="text-muted">Phone</label>
                        <input type="text" class="form-control border-0" value="{{ $userDetail->phone }}" readonly>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="text-muted">Address</label>
                        <textarea class="form-control border-0" rows="2" readonly>{{ $userDetail->address }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
