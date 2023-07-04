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

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Users</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admindashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Users</li>
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
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Member since</th>
                                <th scope="col">Last Login</th>
                                <th scope="col">Member Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1) @endphp
                            @foreach ($user as $item)
                                <tr>
                                    <td scope="row">{{$i++}}</td>
                                    <td scope="row">{{$item->name}}</td>
                                    <td scope="row">{{$item->email}}</td>
                                    <td scope="row">{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</td>
                                    <td scope="row">{{Carbon\Carbon::parse($item->updated_at)->diffForHumans()}}</td>
                                    <td scope="row"><div class="badge rounded-pill bg-light-success text-success w-100">Active</div></td>
                                   

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{$user->links('vendor.pagination.custom')}}
        </div>
    </div>
@endsection
