@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Profile</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Profilep</li>
                        </ol>
                    </nav>
                </div>
                {{-- <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div> --}}
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        {{-- <img src={{$admindata->profile_photo_path}} /> --}}
                                        <img src="{{ !empty($admindata->profile_photo_path) ? url($admindata->profile_photo_path) : url('admin/assets/images/avatars/profile.jpg') }}"
                                            alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                        <div class="mt-3">
                                            <h4>{{ $admindata->name }}</h4>
                                            <p class="text-secondary mb-1">Administrator    </p>
                                            {{-- <button class="btn btn-primary">Follow</button>
                                        <button class="btn btn-outline-primary">Message</button> --}}
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-globe me-2 icon-inline">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="2" y1="12" x2="22" y2="12">
                                                    </line>
                                                    <path
                                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                                    </path>
                                                </svg>Website</h6>
                                            <span class="text-secondary">https://admin.com</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-github me-2 icon-inline">
                                                    <path
                                                        d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                    </path>
                                                </svg>Github</h6>
                                            <span class="text-secondary">admin</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-twitter me-2 icon-inline text-info">
                                                    <path
                                                        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                    </path>
                                                </svg>Twitter</h6>
                                            <span class="text-secondary">@admin</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-instagram me-2 icon-inline text-danger">
                                                    <rect x="2" y="2" width="20" height="20"
                                                        rx="5" ry="5"></rect>
                                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5">
                                                    </line>
                                                </svg>Instagram</h6>
                                            <span class="text-secondary">admin</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-facebook me-2 icon-inline text-primary">
                                                    <path
                                                        d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                    </path>
                                                </svg>Facebook</h6>
                                            <span class="text-secondary">admin</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="post" action="{{route('admin.profile.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name <span class="text-danger">*</span></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="name" class="form-control"
                                                    value={{ $admindata->name }} />
                                                    @error('name')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                         
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email <span class="text-danger">*</span></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="email" class="form-control"
                                                    value={{ $admindata->email }} />
                                                    @error('email')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone <span class="text-danger">*</span></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="number" name="phone" class="form-control"
                                                    value={{ $admindata->phone }} />
                                                    @error('phone')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Image</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="row">
                                                    <div class="col-sm-8 text-secondary">
                                                        <input class="form-control" type="file" name="image" id="image"
                                                            onChange="profileimage(this)">
                                                    </div>
                                                    <div class="col-sm-4 text-secondary">
                                                        <img src="" id="profileimagepreview">
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4 float-end"
                                                    value="Save Changes" />
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>


                            <div class="card">
                                <div class="card-body">

                                    <form method="post" action="{{route('admin.password.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Current Password <span class="text-danger">*</span></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input  type="password" id="current_password" name="current_password" class="form-control"
                                                    />
                                                    @error('current_password')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                         
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">New password <span class="text-danger">*</span></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" id="password" name="password" class="form-control"
                                                    />
                                                    @error('password')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Reenter New Password <span class="text-danger">*</span></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" id="password_confirmation"
                                                name="password_confirmation" class="form-control"
                                                    />
                                                    @error('phone')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row ">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary ">
                                                <button type="submit" class="btn btn-primary px-4 float-end"
                                                    > Update Password</button>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        function profileimage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileimagepreview').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
