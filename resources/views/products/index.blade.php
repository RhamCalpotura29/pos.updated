@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
               <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float:left">ADD PRODUCT</h4>
                        @if(auth()->user()->is_admin ==1)
                        <a href="#" style="float:right" class="btn btn-dark" 
                        data-toggle="modal" data-target="#addproduct">
                           
                        <i class="fa fa-plus" ></i>ADD NEW PRODUCT</a>
                        @endif
                    </div>
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        {{-- <th>Phone</th> --}}
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Alert Stock</th>
                                        <th>Role</th>
                                        @if(auth()->user()->is_admin ==1)
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as  $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->brand}}</td>
                                        <td>{{number_format($product->price,2)}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>
                                            @if($product->alert_stock>=$product->quantity)
                                            <span class="badge badge-danger">Low Stock > {{$product->alert_stock}}</span>
                                            @else 
                                            <span class="badge badge-success">{{$product->alert_stock}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->is_admin==1)Admin
                                            @else Cashier
                                            @endif
                                        </td>
                                        @if(auth()->user()->is_admin ==1)
                                        <td>
                                            
                                            <div class="btn-group">
                                                <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editproduct{{$product->id}}">
                                                    <i class="fa fa-edit"></i>Edit</a>
                                                <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteproduct{{$product->id}}">
                                                    <i class="fa fa-trash"></i>Delete</a>
                                            </div>
                                        </td>
                                        @endif
                                        {{-- <td>{{}}</td> --}}
                                    </tr>

                                    {{--MODAL FOR EDITING productS--}}
                                    <div class="modal right fade" id="editproduct{{$product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title" id="staticBackdropLabel">Edit Product</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('products.update', $product->id)}}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="">Product Name</label>
                                                        <input type="text" name="product_name" id="" value="{{$product->product_name}}" class="form-control">
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <label for="">Brand</label>
                                                        <input type="text" name="brand" id="" value="{{$product->brand}}" class="form-control">
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <label for="">Price</label>
                                                        <input type="number" name="price" id="" value="{{$product->price}}" class="form-control">
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <label for="">Quantity</label>
                                                        <input type="number" name="quantity" id="" value="{{$product->quantity}}" class="form-control">
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <label for="">Alert Stock</label>
                                                        <input type="number" name="alert_stock" id="" value="{{$product->alert_stock}}" class="form-control">
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <label for="">Description</label>
                                                        <textarea name="description" id="" cols="30" rows="2" class="form-control">{{$product->description}}</textarea>
                                                    </div>
                                
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary btn-block" onclick="return confirm('Product Updated')">Update Product</button>
                                                        <button class="btn btn-danger btn-block" >Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                     {{--MODAL FOR EDITING productS--}}
                                     <div class="modal right fade" id="deleteproduct{{$product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title" id="staticBackdropLabel">Delete product</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('products.destroy', $product->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                   <p>ARE YOU SURE YOU WANT TO DELETE THIS {{$product->product_name}} ?</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger" >Delete</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            {{ $products->links()}}
                        </div>
                </div>
               </div>
               <div class="col-md-3">
                <div class="card">
                    <div class="card-header"><h4>SEARCH PRODUCT</h4></div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="{{ route('psearch') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="psearch" placeholder="Search products...">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                
                               </div>
                        </div>
                </div>
               </div>
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
      </style>

@endsection