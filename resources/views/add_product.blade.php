@extends('layout')
@section('main')
<h2>Create product</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="mt-6" enctype="multipart/form-data" action="{{route('create.product')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="">Name of product:</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <label for="">Image:</label>
            <input type="file" class="form-control" name="image" id="">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6 form-group">
            <label for="">Quantity:</label>
            <input type="number" name="quantity" class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <label for="">Price:</label>
            <input type="text"  name="price" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 d-block mx-auto form-group mt-3">
            <label for="">Description:</label>
            <textarea class="form-control" name="description" id=""></textarea>
        </div>
    </div>

    <button class="d-block btn btn-primary mx-auto mt-4">Create</button>

</form>


@endsection