<a href="#" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-outline rounded-pill"><i class="fa fa-list"></i></a>
<a href="{{route('users.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-user"></i>User</a>
<a href="{{route('products.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-box"></i>Products</a>
<a href="{{route('orders.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-desktop"></i>Cashier</a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-file"></i>Reports</a>
<a href="{{route('transactions.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-money-bill"></i>Transactions</a>

<style>
    .btn-outline{
        border-color:#008B8B;
        color: #008B8B; 
    }

    .btn-outline:hover{
        background:#008B8B;
        color: #ffffff; 
    }
</style>