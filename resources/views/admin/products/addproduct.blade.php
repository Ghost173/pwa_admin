@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .deleteIcon:hover i {
            color: red;
            /* Change the color to the desired hover color */
        }

        .editIcon:hover i {
            color: orange;
            /* Change the color to the desired hover color */
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
                            <li class="breadcrumb-item"><a href="{{ route('admindashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->




            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Product</h5>
                    <hr>
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Title</label>
                                        <input type="text" class="form-control" name="product_title" id="product_title"
                                            placeholder="Enter product title">
                                        @error('product_title')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_code" class="form-label">Product Code</label>
                                        <input type="text" class="form-control" name="product_code" id="product_code"
                                            placeholder="Enter product code">
                                        @error('product_code')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_long_description" class="form-label">Description</label>
                                        <textarea class="form-control" name="product_long_description" id="product_long_description" rows="3"></textarea>
                                    </div>

                                    {{-- pruduct tamnail image start  --}}
                                    <div class="row mb-3">
                                        <label for="product_image" class="form-label">Product Thumnail</label>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="row">
                                                <div class="col-sm-8 text-secondary">
                                                    <input class="form-control" type="file" name="product_image"
                                                        id="product_image" onchange="catgegoryImage(this)">
                                                    @error('product_image')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4 text-secondary">
                                                    <img src="" id="product_image_preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- pruduct tamnail image end  --}}
<hr>
                                     {{-- pruduct extra image one start  --}}
                                    <div class="row mb-3">
                                        <label for="image_one" class="form-label">Product Extra image 1</label>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="row">
                                                <div class="col-sm-8 text-secondary">
                                                    <input class="form-control" type="file" name="image_one" id="image_one"
                                                    onchange="catgegoryImage(this)" >
                                                    @error('image_one')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4 text-secondary">
                                                    <img src="" id="image_one_preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- pruduct extra image one end  --}}

                                      {{-- pruduct extra image two start  --}}
                                      <div class="row mb-3">
                                        <label for="image_two" class="form-label">Product Extra image 2</label>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="row">
                                                <div class="col-sm-8 text-secondary">
                                                    <input class="form-control" type="file" name="image_two" id="image_two"
                                                    onchange="catgegoryImage(this)" >
                                                    @error('image_two')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4 text-secondary">
                                                    <img src="" id="image_two_preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- pruduct extra image two end  --}}

                                    {{-- pruduct extra image three start  --}}
                                    <div class="row mb-3">
                                        <label for="image_three" class="form-label">Product Extra image 3</label>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="row">
                                                <div class="col-sm-8 text-secondary">
                                                    <input class="form-control" type="file" name="image_three" id="image_three"
                                                    onchange="catgegoryImage(this)" >
                                                    @error('image_three')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4 text-secondary">
                                                    <img src="" id="image_three_preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- pruduct extra image three end  --}}

                                    {{-- pruduct extra image four start  --}}
                                    <div class="row mb-3">
                                        <label for="image_four" class="form-label">Product Extra image 4</label>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="row">
                                                <div class="col-sm-8 text-secondary">
                                                    <input class="form-control" type="file" name="image_four" id="image_four"
                                                    onchange="catgegoryImage(this)" >
                                                    @error('image_four')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-4 text-secondary">
                                                    <img src="" id="image_four_preview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- pruduct extra image four end  --}}



                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="product_price" class="form-label">Price</label>
                                            <input type="number" class="form-control" id="product_price"
                                                name="product_price" placeholder="50">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="discount_price" class="form-label">Discount Price</label>
                                            <input type="number" class="form-control" id="discount_price"
                                                name="discount_price" placeholder="20">
                                        </div>

                                        <div class="col-12">
                                            <label for="product_category_id" class="form-label">Product Category</label>
                                            <select class="form-select" id="product_category_id" name="product_category_id">
                                                @foreach ($category as $item)
                                                <option value="{{$item->id}}">{{$item->category_name}}</option>   
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="product_subcategory_id" class="form-label">Product SubCategory</label>
                                            <select class="form-select" id="product_subcategory_id" name="product_subcategory_id">
                                                <option value="" selected disabled>Select SubCategory</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">product color</label>
                                                <input type="text" name="product_color" class="form-control" data-role="tagsinput" value="" placeholder="use , to separate color ">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">product size</label>
                                                <input type="text" name="product_size" class="form-control" data-role="tagsinput" value="" placeholder="use , to separate size ">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Product Brand</label>
                                            <input type="text" class="form-control" id="inputProductTags"
                                                placeholder="Enter Product Tags">
                                        </div>

                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Product quantity</label>
                                            <input type="text" class="form-control" id="inputProductTags"
                                                placeholder="Enter Product Tags">
                                        </div>
                                        

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">Feature_product</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">product_collection</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-primary">Save Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>



        </div>
    </div>


    <script>
        $(document).ready(function() {
        $('select[name="product_category_id"]').on('change', function(){
            var product_category_id = $(this).val();
            if(product_category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax/') }}/"+product_category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="product_subcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="product_subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
        });
</script>


    <script type="text/javascript">
        function catgegoryImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#product_image_preview').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
