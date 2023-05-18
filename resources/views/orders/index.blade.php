@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
               <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float:left">Order Products</h4>
                        @if(auth()->user()->is_admin ==1)
                        <a href="#" style="float:right" class="btn btn-dark" 
                        data-toggle="modal" data-target="#addproduct">
                            
                        <i class="fa fa-plus" ></i>ADD NEW PRODUCT</a>
                        @endif
                        </div>
                        <form action="{{route('orders.store')}}" method="post">
                            @csrf
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        {{-- <th>Phone</th> --}}
                                        <th>Price</th>
                                        <th>Discount (%)</th>
                                        <th>Total</th>
                                        <th><a href="#" class="btn btn-sm btn-success add_more"><i class="fa fa-plus"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody class="addMoreProduct"> 
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="product_id" id="product_id" class="form-control product_id">
                                                <option value="">Select Item</option>
                                                @foreach ($products as $product)
                                                <option data-price="{{$product->price}}" 
                                                    value="{{$product->id}}">{{$product->product_name}} 
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[]" id="quantity" class="form-control quantity">
                                        </td>
                                        <td>
                                            <input type="number" name="price[]" id="price" class="form-control price">
                                        </td>
                                        <td>
                                            <input type="number" name="discount[]" id="discount" class="form-control discount">
                                        </td>
                                        <td>
                                            <input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount">
                                        </td>
                                        <th><a href="#" class="btn btn-sm btn-danger delete" ><i class="fa fa-times"></i></a></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
               </div>
               <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h4>Total <b class="total">0.00</b></h4></div>
                        <div class="card-body">
                        <div class="panel">
                            <div class="row">
                                <table class="table table-stripped">
                                    <tr>
                                        <td>
                                            <label for="">Customer Name</label>
                                            <input type="text" name="customer_name" id="" class="form-control">
                                            
                                        </td>

                                        <td>
                                            <label for="">Customer Phone</label>
                                            <input type="number" name="customer_phone" id="" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                              
                                <td>
                                    Payment Method <br>
                                    <span class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_method" 
                                        class="true" value="cash" checked="checked">
                                        <label for="payment_method"><i class="fa fa-money-bill text-success"></i>Cash</label>
                                    </span>

                                    <span class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_method" 
                                        class="true" value="bank transfer" checked="checked">
                                        <label for="payment_method"><i class="fa fa-university text-danger"></i>Bank</label>
                                    </span>

                                    <span class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_method" 
                                        class="true" value="credit card" checked="checked">
                                        <label for="payment_method"><i class="fa fa-credit-card text-info"></i>Credit Card</label>
                                    </span>
                                </td><hr>

                                <td>
                                    Payment <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                                </td>

                                <td>
                                    Change <input type="number" name="balance" id="balance" class="form-control">
                                </td>

                                <td>
                                    <button class="btn-primary btn-lg btn-block mt-5" onclick="return confirm('Succesful Transaction')">Save</button>
                                </td>
                                <td>
                                    <button class="btn-danger btn-lg btn-block mt-2" >Calculator</button>
                                </td>
                                <div class="text-center" style="text-align:center !important">
                                    <a href="#" class="text-danger text-center"><i class="fa fa-sign-out-alt"></i></a>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
               </div>
            </form>
            </div>
        </div>
    </div>
    
    {{--MODAL FOR ADDING productS--}}
    <div class="modal right fade" id="addproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">Add Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Alert Stock</label>
                        <input type="number" name="alert_stock" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">Save Product</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

      
      <style>
        .modal.right .modal-dialog{
            /* position: absolute; */
            top: 0;
            right: 0;
            margin-right: 17vh;
        }

        .modal.fade:not(.in).right .modal-dialog{
            -webkit-transform: translate3d(25%,0,0);
            transform: translate3d(%25,0,0);
        }

        .radio-item input[type="radio"]{
            visibility: hidden;
            width: 20px;
            height: 20px;
            margin: 0 5px 0 5px;
            padding: 0;
            cursor: pointer;
        }
        /*before style radio*/
        .radio-item input[type="radio"]:before{
            position: relative;
            margin: 4px -25px -4px 0;
            display: inline-block;
            visibility: visible;
            width: 20px;
            height: 20px;
            border-radius: 10px;
            border:2px inset rgb(150, 150,150,0.75);
            background: radial-gradient(ellipse at top left, rgb(255,255,255)0%, rgb(250,250,250)5%,
            rgb(230,230,230)95%,rgb(225,225,225)100%);
            content: '';
            cursor: pointer;
        }

        /*after style radio*/
        .radio-item input[type="radio"]:checked:after{
            position: relative;
            top: 0;
            left: 9px;
            display: inline-block;
            border-radius: 6px;
            visibility: visible;
            width: 12px;
            height: 12px;
            border-radius: 10px;
            border:2px inset rgb(150, 150,150,0.75);
            background: radial-gradient(ellipse at top left, rgb(250,255,220)0%, rgb(225,250,100)5%,
            rgb(75,75,0)95%,rgb(25,100,0)100%);
            content: '';
            cursor: pointer;
        }

        /*after selected*/
        .radio-item input[type="radio"].true:checked::after{
            background: radial-gradient(ellipse at top left, rgb(250,255,220)0%, rgb(225,250,100)5%,
            rgb(75,75,0)95%,rgb(25,100,0)100%);
        }
        
        .radio-item input[type="radio"].false:checked::after{
            background: radial-gradient(ellipse at top left, rgb(255,255,255)0%, rgb(250,250,250)5%,
            rgb(230,230,230)95%,rgb(225,225,225)100%);
        }

        .radio-item label{
            display: inline-block;
            margin: 0;
            padding: 0;
            line-height: 25px;
            height: 25px;
            cursor: pointer;
        }

      </style>

@endsection

@section('script')
<script>
    //$(document).ready(function()
    //{
         //alert(1);
    //})

    //Add product row
    $('.add_more').on('click', function()
    {
        var product = $('.product_id').html();
        var numberofrow = ($('.addMoreProduct tr').length - 0) + 1; 
        var tr = '<tr><td class="no">' + numberofrow + '</td>' + 
            '<td><select class="form-control product_id" name="product_id[]" >' + product + 
            '</select></td>' + 
            '<td><input type="number" name="quantity[]" class="form-control quantity"></td>'+
            '<td><input type="number" name="price[]" class="form-control price"></td>'+
            '<td><input type="number" name="discount[]" class="form-control discount"></td>'+
            '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>'+
            '<td><a class="btn btn-sm btn-danger delete"><i class="fa fa-times"></a></td>';
            $('.addMoreProduct').append(tr);
    });

    //Delete a Row
    $('.addMoreProduct').delegate('.delete', 'click', function()
    {
        $(this).parent().parent().remove();
    });
    
    function TotalAmount()
    //make all the logic here
    //computations of total and discounts
    {
        var total = 0;
        $('.total_amount').each(function(i, e)
        {
            var amount = $(this).val() -0;
            total += amount;
        });

        $('.total').html(total);
    }

    //Get Product price/quantity/total
     $('.addMoreProduct').delegate('.product_id', 'change', function()
     {
        var tr = $(this).parent().parent();
        var price = tr.find('.product_id option:selected').attr('data-price');
        tr.find('.price').val(price);
        var quantity = tr.find('.quantity').val()-0;
        var discount = tr.find('.discount').val()-0;
        var price = tr.find('.price').val()-0;
        var total_amount = (quantity * price) - ((quantity * price * discount)/ 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount()
     });

     //Get Total amount to be paid
     $('.addMoreProduct').delegate('.quantity, .discount', 'keyup', function()
     {
        var tr = $(this).parent().parent();
        var quantity = tr.find('.quantity').val()-0;
        var discount = tr.find('.discount').val()-0;
        var price = tr.find('.price').val()-0;
        var total_amount = (quantity * price) - ((quantity * price * discount)/ 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount()
     });

     /*Calculate total minus cash tendered*/
     $('#paid_amount').keyup(function(){
        var total = $('.total').html();
        var paid_amount = $(this).val();
        var tot =  paid_amount - total;
        $('#balance').val(tot).toFixed(2);
     });
</script>
@endsection