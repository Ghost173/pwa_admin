@extends('admin.admin_master')

@section('admin')

<style>

    .deleteIcon:hover i {
        color: red; /* Change the color to the desired hover color */
    }

    .editIcon:hover i {
        color: orange; /* Change the color to the desired hover color */
    }
</style>

    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Pending Orders</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pending Orders</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->


            <div class="card">
                <div class="card-body">
                    <table class="table mb-0 table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Payment Method </th>
                                <th scope="col">Order Status </th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1) @endphp
                            @foreach ($pendingorders as $item)
                                <tr>
                                    <td scope="row">{{$i++}}</td>
                                    <td scope="row">
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="{{asset($item->product_image)}}" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class=" font-14">{{$item->product_name}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td scope="row">{{$item->order_id}}</td>
                                    <td scope="row">{{$item->customer_name}}</td>
                                    <td scope="row">{{$item->product_quantity}}</td>
                                    <td scope="row">
                                    @if($item->payment_method == "BT")
                                    <div class="badge rounded-pill bg-info text-dark">Bank tranfer</div>
                                    @else
                                    <div class="badge rounded-pill bg-success text-dark">Paypal</div>
                                    @endif
                                    
                                    </td>
                                    <td scope="row"><div class="badge rounded-pill bg-light-danger text-danger w-100">Pending</div></td>
                                   
                                    <td>
                                        <a href="{{route('admin.orderdetailsbyid', $item->id)}}" class="btn btn-primary btn-sm px-2 ">details</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
