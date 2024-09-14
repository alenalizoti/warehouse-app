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
<h1 class="text-center mt-3">Add the existing product</h1>

<form action="{{route('existing.product')}}" method="post">
    @csrf
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 form-group">
            <label for="">Choose product:</label>
            <select class="form-control" name="group_id" id="">
                @foreach ($groups as $group)
                <option value="{{$group->id}}">{{$group->model}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-6 form-group">
            <label for="">Choose product:</label>
            <input class="form-control" type="number" name="quantity" placeholder="Enter quantity...">
        </div>
    </div>
    <button class="btn btn-primary mt-5 d-block mx-auto">Save</button>
</form>
@endsection