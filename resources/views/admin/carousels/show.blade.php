@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1>{{ $carousel->title }}</h1>
        <img src="{{ asset('storage/' . $carousel->image) }}" alt="galeri" width="300">
        <a href="{{ route('carousels.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection
