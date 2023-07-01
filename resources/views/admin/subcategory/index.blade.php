@extends('admin.admin_master')

@section('admin')
    <div class="page-wrapper">
        <div class="page-content">


              <!--breadcrumb-->
              <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Sub Categories</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Sub Categories</li>
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
                                <th scope="col">Sub Category Name</th>
                                <th scope="col">Sub Category product count</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategorie as $item)
                                    @php
                                        
                                        $productCount = DB::table('product_lists')
                                            ->where('product_subcategory_id', $item->id)
                                            ->count();
                                    @endphp
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{ $item->subcategory_name }}</td>
                                    <td>{{ $item['categoryName']['category_name'] }}</td>
                                    <td>{{$productCount}}</td>
                                    <td>
                                        <a href="{{route('admin.editsubcategory', $item->id)}}" ><i class="fadeIn animated bx bx-edit bx-sm"
                                                style="color: rgb(231, 112, 1);" title="Edit"></i>
                                        </a>

                                        <a href="{{route('admin.deletesubcategory',$item->id )}}" id="delete"><i class="fadeIn animated bx bx-trash bx-sm"
                                                style="color: rgb(231, 1, 1);" title="Delete"></i>
                                        </a>
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
