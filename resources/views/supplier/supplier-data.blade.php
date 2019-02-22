@extends('layout.app')

@section('content')
    @include('inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Supplier</h3>
                </div>
            </div>

            <div class="card mb-4 pt-3">
                <div class="card-header">
                    <div class="row">
                        <button class="btn btn-primary btn-sm ml-auto no-shadow">Edit Profile</button>
                    </div>
                    <div class="row d-none">
                        <div class="col-md-6 pl-md-5">
                            <div class="mb-3 mx-auto">
                                <img class="rounded-circle" src="{{asset('storage/supplier/'.$supplier->image)}}"
                                     alt="User Avatar"
                                     width="110">
                            </div>
                            <h4 class="mb-0">{{$supplier->name}}</h4>
                            <span class="text-muted d-block my-2"><i class="material-icons mr-3"></i> {{$supplier->location}}</span>
                            <span class="text-muted d-block my-2"><i class="material-icons mr-3"></i> {{$supplier->phone}}</span>
                            <span class="text-muted d-block my-2"><i class="material-icons mr-3"></i> {{$supplier->email}}</span>

                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-4">
                                    <strong class="text-muted d-block mb-2">Description</strong>
                                    <span>{{$supplier->details}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <form method="post" id="upload_form" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-row mx-4">
                            <div class="col-lg-4">
                                <label for="userProfilePicture" class="text-center w-100 mb-4">Profile Picture</label>
                                <div class="edit-user-details__avatar m-auto">
                                    <img src="{{asset('images/avatars/0.jpg')}}" id="previewLogo" alt="User Avatar shadow">
                                </div>
                                <input type="file" name="ProductPic" class="d-none" id="ImageUpload">
                                <button type="button" class="btn btn-sm btn-white d-table mx-auto mt-4" onclick="chooseFile()"><i class="material-icons"></i> Upload Image</button>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstName">Name</label>
                                        <input type="text" class="form-control" name="name" id="firstName" placeholder="Enter Supplier Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phoneNumber">Phone Number</label>
                                        <div class="input-group input-group-seamless">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="+40 1234 567 890">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="userLocation">Location</label>
                                        <div class="input-group input-group-seamless mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="location" class="form-control" placeholder="Enter location">
                                        </div>
                                        <label for="emailAddress">Email</label>
                                        <div class="input-group input-group-seamless">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="email" class="form-control" name="emailAddress" id="emailAddress" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="userBio">Details</label>
                                        <textarea style="min-height: 108px;" id="userBio" name="userBio" class="form-control" placeholder="Supplier Information"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning float-right mx-2 closer">Close</button>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-sm-3 text-center">
                            <h4 class="m-0">112</h4>
                            <span class="text-light text-uppercase">Purchase Product</span>
                        </div>
                        <div class="col-6 col-sm-3 text-center">
                            <h4 class="m-0">7221$</h4>
                            <span class="text-light text-uppercase">Payment</span>
                        </div>
                        <div class="col-6 col-sm-3 text-center">
                            <h4 class="m-0">4023$</h4>
                            <span class="text-light text-uppercase">Payable</span>
                        </div>
                        <div class="col-6 col-sm-3 text-center">
                            <h4 class="m-0">3</h4>
                            <span class="text-light text-uppercase">Points</span>
                        </div>
                    </div>
                </div>

                <div class="card-footer py-0">
                    <div class="row">
                        <div class="col-12 col-sm-6 border-top pb-3 pt-2 border-right">
                            <div class="progress-wrapper">
                                <span class="progress-label">Workload</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="80"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                        <span class="progress-value">80%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 border-top pb-3 pt-2">
                            <div class="progress-wrapper">
                                <span class="progress-label">Performance</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                         aria-valuenow="92" aria-valuemin="0" aria-valuemax="100" style="width: 92%;">
                                        <span class="progress-value">92%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>


@endsection