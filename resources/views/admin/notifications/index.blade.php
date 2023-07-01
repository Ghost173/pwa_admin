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
                <div class="breadcrumb-title pe-3">Notification</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Notification</li>
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
                                <th scope="col">Title</th>
                                <th scope="col">Message</th>
                                <th scope="col">status</th>
                                <th scope="col">Created Date</th>
                                <th scope="col"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1) @endphp
                            @foreach ($notification as $item)

                                <tr>
                                    <td scope="row">{{$i++}}</td>
                                    <td scope="row">{{$item->title}}</td>
                                    <td scope="row">{{$item->message}}</td>
                                    <td scope="row">
                                        @if ($item->status == 1)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-primary">Pending</span>
                                        @endif
                                       </td>
                                    <td scope="row">{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}s</td>

                                    <td>
                                        <div class="d-flex order-actions">
                                            @if ($item->status == 1)
                                            <a href="{{route('admin.notificationdeactive',$item->id)}}" class="ms-2 dislikeIcon" >
                                                <i class="bx bx-dislike" title="Deactive this notification"></i></a>
                                            @else
                                            <a href="{{route('admin.notificationactive',$item->id)}}" 
                                                class="ms-2 likeIcon"><i class="bx bx-like" title="Active this notification"></i></a>
                                            @endif
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
