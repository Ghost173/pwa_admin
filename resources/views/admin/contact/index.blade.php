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
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0 table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Message</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1) @endphp
                            @foreach ($Contact as $item)

                                <tr>
                                    <td scope="row">{{$i++}}</td>
                                    <td scope="row">{{$item->name}}</td>
                                    <td scope="row">{{$item->email}}</td>
                                    <td scope="row">{{$item->message}}</td>
                                    <td scope="row">{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}s</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{$Contact->links('vendor.pagination.custom')}}
        </div>
    </div>
@endsection
