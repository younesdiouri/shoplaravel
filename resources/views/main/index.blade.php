

@extends('layouts.master')

@section('Digital shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,700&subset=latin-ext" rel="stylesheet">

    @if(Session::has('alert-success'))
        <p class="col-md-4 alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif

    <!--Item slider text-->
    <div class="container">
        <div class="row" id="slider-text">
            <div class="col-md-6" >
                <h2>NOUVELLE COLLECTION</h2>
            </div>
        </div>
    </div>

    <!-- Item slider-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="carousel carousel-showmanymoveone slide" id="itemslider">
                    <div class="carousel-inner">

                @foreach ($products as $product)

                            <div class="item active">
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <form action="/store" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">

                                   <a href="#"> <img src="{{$product->imageurl}}" class="img-responsive center-block"></a>
                                    <h4 class="text-center">{{$product->name}}</h4>
                                    <h5 class="text-center"><label>{{$product->price}}</label> €</h5>
                                    <h6 class="text-center">{{$product->description}}</h6>
                                        <input type="submit" class="btn btn-success btn-lg" value="Add to Cart">
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    <div id="slider-control">
                        <a class="left carousel-control" href="#itemslider" data-slide="prev"><img src="https://s12.postimg.org/uj3ffq90d/arrow_left.png" alt="Left" class="img-responsive"></a>
                        <a class="right carousel-control" href="#itemslider" data-slide="next"><img src="https://s12.postimg.org/djuh0gxst/arrow_right.png" alt="Right" class="img-responsive"></a>
                    </div>

                            </div>
                        </div>
                    </div>

            </div>

        </div>

    <div class="container">
        <div class="row" id="slider-text">
            <div class="col-md-6" >
                <h2>Vente Flash</h2>
            </div>
        </div>
    </div>

@endsection

