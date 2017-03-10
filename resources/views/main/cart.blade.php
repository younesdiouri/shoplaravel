
@extends('layouts.master')

@section('Digital shop', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')


<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th class="text-center">Price (HT)</th>
                    <th class="text-center">Total (TTC)</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach(Cart::content() as $row) :?>

                <tr>
                    <td class="col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?php echo $row->name; ?></a></h4>

                                <span>Status: </span><span class="text-success"><strong>In stock</strong></span>
                            </div>
                        </div></td>
                    <td class="col-md-1 text-center"><strong><?php echo $row->qty; ?></strong></td>
                    <td class="col-md-1 text-center"><strong><?php echo $row->price; ?>€</strong></td>
                    <td class="col-md-1 text-center"><strong><?php echo $row->total; ?>€</strong></td>
                    <td class="col-md-1">
                        <form action="/delete" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <input type="hidden" name="rowid" value="<?php echo $row->rowId; ?>" />
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button></td>
                        </form>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>Subtotal (HT)</h5></td>
                    <td class="text-right"><h5><strong><?php echo Cart::subtotal(); ?> €</strong></h5></td>
                </tr>

                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Total (TTC)</h3></td>
                    <td class="text-right"><h3><strong><?php echo Cart::total(); ?> €</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <button type="button" class="btn btn-default" onclick="window.location.href='/'">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </button></td>
                    <td>


                    <td class="col-md-2">
                        <form action="/checkout" method="POST">
                            {!! csrf_field() !!}
                            <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="pk_test_duCcCwuIqdpydw3NdEVJpMJi"
                                    data-amount="<?php echo Cart::total()*100; ?>"
                                    data-name="<?php echo Auth::user(); ?>"
                                    data-description="Complete Payment"
                                    data-image=""
                                    data-locale="auto">
                            </script>
                        </form>
                    </td>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    @endsection