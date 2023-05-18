@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float:left">Transactions</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Paid amount</th>
                                    <th>Transaction Amount</th>
                                    <th>Change</th>
                                    {{-- <th>Phone</th> --}}
                                    <th>Payment Method</th>
                                    <th>Transaction Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction) 
                                <tr>
                                    <td>{{$transaction->order_id}}</td>
                                    <td>{{$transaction->paid_amount}}</td>
                                    <td>{{$transaction->transac_amount}}</td>
                                    <td>{{$transaction->balance}}</td>
                                    <td>{{$transaction->payment_method}}</td>
                                    <td>{{$transaction->transac_date}}</td>
                                    <td>{{$transaction->status}}</td>

                                    <td>
                                        @if($transaction->status == 'Paid')
                                           <p>This Transaction is Paid</p>
                                        @else
                                            @if(auth()->user()->is_admin == 1)
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#approveCancelModal{{$transaction->id}}">Approve Cancellation</button>
                                                @if($transaction->status=='Pending')
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal{{$transaction->id}}">Approve</button>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal{{$transaction->id}}">Cancel</button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($transactions as $transaction)
    @if($transaction->status != 'Cancelled' && $transaction->status != 'Approved')
        <div class="modal fade right" id="approveModal{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel{{$transaction->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel{{$transaction->id}}">Approve Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to approve this transaction?</p>
                        <form action="{{ route('transactions.approve', $transaction->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve Transaction</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->is_admin == 1)
            <div class="modal fade right" id="approveCancelModal{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="approveCancelModalLabel{{$transaction->id}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="approveCancelModalLabel{{$transaction->id}}">Approve Cancellation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to approve the cancellation of this transaction?</p>
                            <p>Cancellation Reason: {{$transaction->cancellation_reason}}</p> <!-- Display cancellation reason -->
                            <form action="{{ route('transactions.approveCancellation', $transaction->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Approve Cancellation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="modal fade right" id="cancelModal{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel{{$transaction->id}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelModalLabel{{$transaction->id}}">Cancel Transaction</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('transactions.cancel', $transaction->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="reason">Cancellation Reason</label>
                                    <input type="text" class="form-control" id="reason" name="reason" required>
                                </div>
                                <button type="submit" class="btn btn-danger">Request Cancellation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endforeach

@endsection
