@extends('admin.admin_master')

@section('admin')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Add SubCategory</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add SubCategory</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <div class="container">
                <div class="main-body">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Sub Category Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="category_name" id="category_name" class="form-control"/>
                                            @error('category_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                 
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Select Category <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        
                                <select class="form-select mb-3" aria-label="Default select example">
                                    @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->category_name}}</option>   
                                    @endforeach
								</select>
                                            @error('category_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                 
                                </div>


                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4 float-end"
                                            value="Create subcategory" />
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
