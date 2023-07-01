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
                <div class="breadcrumb-title pe-3">Categories</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Categories</li>
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
                                <th scope="col">Category Name</th>
                                <th scope="col">Category Image</th>
                                <th scope="col">Category Icon</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Product Count</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1) @endphp
                            @foreach ($allcategories as $item)
                                @php
                                    
                                    $productCount = DB::table('product_lists')
                                        ->where('product_category_id', $item->id)
                                        ->count();
                                    
                                @endphp
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{ $item->category_name }}</td>
                                    <td><img src="{{ asset($item->category_image) }}" style="width: 50px; height: 50px">
                                    </td>
                                    <td><img src="{{ asset($item->category_icon) }}" style="width: 50px; height: 50px"></td>
                                    <td>{{ $item['userName']['name'] }}</td>
                                    <td>{{$productCount}}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{route('admin.editcategory',$item->id)}}" class="ms-2 editIcon"><i class="bx bxs-edit"></i></a>
                                            <a href="{{route('admin.deletecategory',$item->id)}}" id="delete" class="ms-2 deleteIcon"><i class="bx bxs-trash" ></i></a>
                                        </div>
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
