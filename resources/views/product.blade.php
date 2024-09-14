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
    <div class="mx-auto mt-4">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset( $product->image) }}" class="card-img-top" alt="...">
            </div>
            <div class="col-md-6">
                <h1 class="text-center">{{$product->name}}</h1>
                <p>{{$product->description}}</p>
                <p><i>Barcode:</i> <b>{{$product->barcode}}</b></p>
                <p><i>Price:</i> <b>{{$product->price}}$</b></p>
                <p><i>Quantity:</i> <b>{{$product->group->quantity}}</b></p>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif
                <form action="{{route('product.single',$product->id)}}" method="post">
                    @csrf
                    <div class="form-group mt-5">
                        <input type="text" name="quantity" class="form-control" placeholder="Enter quantity...">
                        <button class="mx-auto d-block mt-2 btn btn-primary">Pack</button>
                    </div>
                </form>
            </div>
        </div>
        
        
    </div>


@endsection