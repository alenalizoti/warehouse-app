@extends('layout')

@section('main')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container d-flex justify-content-between align-items-center">
    <h1>Warehouse</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    </div>
<div class="d-flex justify-content-center align-items-center" style="height: 80vh">
    <div class="row justify-content-center">
        <div class="col-lg-6 mb-4">
            <a class="btn btn-primary" href="{{route('create.product')}}">Add new</a>
        </div>
        <div class="col-lg-8">
            <a class="btn btn-primary" href="{{route('existing.product')}}">Add the existing</a>
        </div>
    </div>
</div>
@endsection