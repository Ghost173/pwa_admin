@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Edit Category</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->




            <div class="container">
                <div class="main-body">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('admin.updatecategoryName', $category->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Category Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="category_name" id="category_name" class="form-control" value="{{$category->category_name}}"/>
                                            @error('category_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4 float-end"
                                            value="Update category name" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>




                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('admin.updatecategoryImage', $category->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Catgegory Image <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div class="row">
                                            <div class="col-sm-8 text-secondary">
                                                <input class="form-control" type="file" name="category_image" id="category_image"
                                                   onchange="catgeoryimage(this)"   
                                                >
                                                @error('category_image')
                                                <span class="text text-danger">{{ $message }}</span>
                                                 @enderror
                                            </div>

                                            <div class="col-sm-4 text-secondary">
                                                <img src="{{$category->category_image}}" id="category_image_preview">
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4 float-end"
                                            value="Update category image" />
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        function catgeoryimage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#category_image_preview').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
