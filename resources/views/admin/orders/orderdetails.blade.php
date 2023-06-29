@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Order Details </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Invoice : <strong> <span
                                        class="text-primary"> {{ $getorders->invoice_no }} </span> </strong> </li>
                        </ol>
                    </nav>
                </div>


            </div>



            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">

                                    <ul class="list-group">
                                        <li class="list-group-item"><strong> <span class="text-dark"> Product Name : </span> </strong> {{ $getorders->product_name }} </li>
                                        <li class="list-group-item"><strong> <span class="text-dark"> Order Id : </span> </strong> {{ $getorders->order_id }} </li>
                                        <li class="list-group-item"><strong> <span class="text-dark"> Customer Name : </span> </strong> {{ $getorders->customer_name }} </li>
                                        <li class="list-group-item"><strong> <span class="text-dark"> Customer Email : </span> </strong> {{ $getorders->customer_email }} </li>
                                        <li class="list-group-item"><strong> <span class="text-dark"> Customer Phone : </span> </strong> {{ $getorders->customer_phone	 }} </li>
                                        <li class="list-group-item"><strong> <span class="text-dark"> Product Code : </span> </strong> {{ $getorders->product_code }} </li>
                                        <li class="list-group-item"><strong> <span class="text-dark"> Product Qty : </span> </strong> {{ $getorders->product_quantity }} </li>
                                        <li class="list-group-item"><strong> <span class="text-dark"> Product Unit Price : </span> </strong> Rs.{{ $getorders->product_unit_price }} </li>
                                        <li class="list-group-item"><strong> <span class="text-dark"> Product Total price : </span> </strong> Rs.{{ $getorders->product_total_price }} </li>
                                    </ul>

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf

                                <div class="card">
                                    <div class="card-body">

                                        <ul class="list-group">
                                            <li class="list-group-item"><strong> <span class="text-dark">Payment Method : </span> </strong> {{ $getorders->payment_method }} </li>
                                            <li class="list-group-item"><strong> <span class="text-dark"> Payment ID : </span> </strong> {{ $getorders->payment_id }} </li>
                                            <li class="list-group-item"><strong> <span class="text-dark"> Order Date : </span> </strong> {{ $getorders->order_date }} </li>
                                            <li class="list-group-item"><strong> <span class="text-dark"> Order Time : </span> </strong> {{ $getorders->order_time }} </li>
                                            <li class="list-group-item"><strong> <span class="text-dark"> Order Status : 
                                            @if ($getorders->customer_cancel_request == 1)
                                            <span class="badge bg-danger">Customer request to cancel this order</span>
                                            
                                            @else
                                            <span class="badge bg-success">Active</span>
                                            @endif


                                            @if ($getorders->customer_cancel_request == 1)
                                            <li class="list-group-item"><strong> <span class="text-dark"> Cancel Reasone : </span> </strong> <span class="text-danger">{{ $getorders->customer_cancel_reason }} </span></li>
                                                
                                            @endif
                                        </ul>

                                    </div>
                            </form>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
