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
                            @foreach ($allcategories as $item)
                                @php
                                    
                                    $productCount = DB::table('product_lists')
                                        ->where('product_category_id', $item->id)
                                        ->count();
                                    
                                @endphp
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
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
