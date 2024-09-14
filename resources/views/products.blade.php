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
    <h1>Products</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    </div>
    
    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <form action="{{route('product.search')}}" method="post">
        @csrf
        <div class="row justify-content-center mb-3">
            <div class="form-group col-md-6 text-center">
                <input type="text" class="form-control" name="barcode" placeholder="Search product...">
                <button class="btn btn-primary mt-2">Search</button>
            </div>
        </div>
    </form>
    @if (isset($product))
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{ asset( $product->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">
                            @php
                                $limitedDescription = strlen($product->description) > 50 ? substr($product->description, 0, 100) . '...' : $product->description;
                            @endphp
                            {{$limitedDescription}}
                        </p>
                        <p class="card-text text-success">${{$product->price}}.99</p>
                        <a href="{{route('product.single',$product->id)}}" class="btn btn-primary">View product</a>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-3">
            <div class="card mb-3">
                <img src="{{ asset( $product['product']->image) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$product['product']->name}}</h5>
                    <p class="card-text">
                    @php
                        $description = $product['product']->description ?? $product->description;
                        $limitedDescription = strlen($description) > 50 ? substr($description, 0, 100) . '...' : $description;
                    @endphp
                        {{$limitedDescription}}
                    </p>
                    <p class="card-text text-success">${{$product['product']->price}}.99</p>
                    <a href="{{route('product.single',$product['product']->id)}}" class="btn btn-primary">View product</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
@endsection