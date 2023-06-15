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
                <div class="breadcrumb-title pe-3">Products</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Product</th>
                                <th scope="col">Product Category</th>
                                <th scope="col">Product Viwes</th>
                                <th scope="col">Product Qty</th>
                                <th scope="col">Product Status </th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1) @endphp
                            @foreach ($products as $item)
                                <tr>
                                    <td scope="row">{{$i++}}</td>
                                    <td >
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="{{asset($item->product_image)}}" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class=" font-14">{{$item->product_title}}</h6>
                                            </div>
                                        </div>
                                        
                                    </td>
                                    <td>{{ $item['catgeory']['category_name'] }}</td>
                                    <td>{{ $item->product_view }}</td>
                                    <td>
                                        @if($item->product_qty > 0)
                                        <div class="d-flex align-items-center text-primary">	
                                            <span>{{ $item->product_qty }}</span>
                                        </div>
                                        @else 
                                        <div class="d-flex align-items-center text-danger">	
                                            <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span>{{ $item->product_qty }}</span>
                                        </div>
                                        @endif
                                        </td>
                                    <td>
                                       @if($item->product_status == 1)
                                       <div class="badge rounded-pill bg-light-success text-success w-100">Active</div>
                                       @else 
                                       <div class="badge rounded-pill bg-light-danger text-danger w-100">inActive</div>
                                       @endif
                                    </td>

                                    <td>
                                        @if($item->discount_price == 'na')
                                            Rs.{{$item->product_price}}
                                        @else
                                            Rs.{{$item->discount_price}}
                                        @endif
                                    </td>
                                        
                                    <td>
                                        <div class="d-flex order-actions">
                                            @if($item->product_status == 1)
                                                <a href="{{route('admin.deactivateproduct', $item->id)}}" class="ms-2"><i class="bx bx-dislike" title="Makrk this product as inactive"></i></a>
                                            @else
                                            <a href="{{route('admin.activateproduct', $item->id)}}" class="ms-2"><i class="bx bx-like" title="Makrk this product as active"></i></a>
                                            @endif
                                            <a href="" class="ms-2 editIcon"><i class="bx bxs-edit"></i></a>
                                            <a href="" class="ms-2 deleteIcon"><i class="bx bxs-trash" id="delete"></i></a>
                                        </div>
                                    </td>
                                   
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        
            {{$products->links('vendor.pagination.custom')}}
        </div>
    </div>
@endsection 
