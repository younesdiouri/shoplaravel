

<html>
<head>
    <title>Laravel eshop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/js/shop.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
@section('sidebar')
    <nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Laravel digital Shop</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                        @if (Route::has('login'))

                                @if (Auth::check())
                                   <li> <a href="{{ url('/') }}">Home</a></li>
                            <li><a href="/order">My Order <span class="fa fa-briefcase"></span></a></li>
                            <li><a href="cart.blade.php">Cart <span class="fa fa-shopping-cart"><?php foreach(Cart::content() as $row) :?><strong><?php echo (isset($row->qty))?$row->qty:''; ?></strong>
                                        <?php endforeach;?>
                                </span></a></li>
                                @else
                            <li>  <a href="{{ url('/login') }}">Login</a></li>
                            <li> <a href="{{ url('/register') }}">Register</a></li>
                                @endif
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>

