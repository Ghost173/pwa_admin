@extends('admin.admin_master')

@section('admin')

<style>

    .deleteIcon:hover i {
        color: red; /* Change the color to the desired hover color */
    }

    .editIcon:hover i {
        color: orange; /* Change the color to the desired hover color */
    }
    .dislikeIcon:hover i {
        color: blue; 
    }
    .likeIcon:hover i {
        color: blue; 
    }

</style>

    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Reviews</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Pending Reviews</li>
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
                                <th scope="col">Review rating</th>
                                <th scope="col">review comment</th>
                                <th scope="col">Customer name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1) @endphp
                            @foreach ($productpendingreviews as $item)
                                <tr>
                                    <td scope="row">{{$i++}}</td>
                                    <td >
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="{{asset($item['products']['product_image'])}}" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class=" font-14"> {{ $item['products']['product_title'] }} {{$item->product_name}}</h6>
                                            </div>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        @if ($item->reviewer_rating == 1)
                                        <div class="row">
                                            <div class="col-lg-2"><div class="font-22 text-warning"> <i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                        </div>
                                        @elseif($item->reviewer_rating == 2 ) 
                                        <div class="row">
                                            <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                            <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                        </div>
                                        @elseif($item->reviewer_rating == 3 ) 
                                        <div class="row">
                                            <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                            <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                            <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                        </div>
                                        @elseif($item->reviewer_rating == 4 ) 
                                        <div class="row">
                                            <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                            <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                            <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                            <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                        </div>

                                        @elseif($item->reviewer_rating == 5 ) 
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                                <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                                <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                                <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                                <div class="col-lg-2"><div class="font-22 text-warning"> 	<i class="fadeIn animated lni lni-star-filled"></i></div> </div>
                                            </div>
                                        </div>
                                        @endif

                                    </td>
                                    <td>{{ $item->reviewer_comments	 }}</td>
                                    <td>{{ $item->reviewer_name	 }}</td>
                                    <td> <span class="badge bg-primary">Pending</span></td> 
                                    <td>
                                        <div class="d-flex order-actions">
                                                <a href="{{route('admin.approvereview', $item->id)}}" class="ms-2 dislikeIcon" ><i class="bx bx-dislike" title="Approve this review"></i></a>
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
