@extends('admin.admin_master')

@section('admin')
<style>

    .deleteIcon:hover i {
        color: red; /* Change the color to the desired hover color */
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
                    <div class="breadcrumb-title pe-3">Sliders</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">All Slider</li>
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
                                <th scope="col">Slider image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                  
                                    <td><img src="{{ asset($item->slider_image) }}" style="width: 50px; height: 50px"></td>
                                    <td>

                                        <div class="d-flex order-actions">
                                            @if($item->slider_status == 1)
                                                <a href="{{route('admin.deactiveslider', $item->id)}}" class="ms-2 dislikeIcon" ><i class="bx bx-dislike" title="Makrk this slider as inactive"></i></a>
                                            @else
                                            <a href="{{route('admin.activeslider', $item->id)}}" class="ms-2 likeIcon"><i class="bx bx-like" title="Makrk this slider as active"></i></a>
                                            @endif
                                            <a href="{{route('admin.deleteslider',$item->id)}}" id="delete" class="ms-2 deleteIcon"><i class="bx bxs-trash" title="Delete"></i></a>
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
