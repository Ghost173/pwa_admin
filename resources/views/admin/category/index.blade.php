@extends('admin.admin_master')

@section('admin')
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
                                        <a href="" target="blank"><i class="fadeIn animated bx bx-edit bx-sm"
                                                style="color: rgb(231, 112, 1);" title="Edit"></i>
                                        </a>

                                        <a href="" id="delete"><i class="fadeIn animated bx bx-trash bx-sm"
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
