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
