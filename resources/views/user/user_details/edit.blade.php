@extends('Home.layouts.main')

@section('content')
    <div class="container-fluid p-5">
        <h1 class="text-center">Edit Your Profile</h1>

        <form action="{{ route('user_details.update', $userDetail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $userDetail->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control"
                    value="{{ old('phone', $userDetail->phone) }}" required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $userDetail->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control"
                    value="{{ old('address', $userDetail->address) }}" required>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                @if ($userDetail->profile_picture)
                    <img src="{{ asset($userDetail->profile_picture) }}" alt="Profile Picture" width="100">
                @endif
                @error('profile_picture')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary float-end">Update</button>
        </form>
    </div>
@endsection
