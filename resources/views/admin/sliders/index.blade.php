@extends('admin.admin_master')

@section('admin')
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
                                        @if($item->slider_status == 1)
                                        <a href="{{route('admin.deactiveslider',$item->id)}}"><i class="fadeIn animated bx bx-dislike bx-sm"
                                            style="color: rgb(231, 74, 1);" title="Delete"></i>
                                    </a>
                                        @else 
                                        <a href="{{route('admin.activeslider',$item->id)}}"><i class="fadeIn animated bx bx-like bx-sm "
                                            style="color: rgb(1, 170, 43);" title="Delete"></i>
                                    </a>
                                        &nbsp;   
                                        @endif
                                        <a href="{{route('admin.deleteslider',$item->id)}}" id="delete"><i class="fadeIn animated bx bx-trash bx-sm"
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
