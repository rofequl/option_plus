@extends('layout.app')

@section('content')
    @include('inc.sidebar')
    <style>
        #upload_form {
            display: none;
        }
    </style>

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
                        <button class="btn btn-primary btn-sm ml-auto no-shadow edit" id="{{$supplier->id}}">Edit
                            Profile
                        </button>
                    </div>
                    <div class="row animated fadeIn profile">
                        <div class="col-md-6 pl-md-5">
                            <div class="mb-3 mx-auto">
                                <img class="rounded-circle previewLogo" src=""
                                     alt="User Avatar"
                                     width="110">
                            </div>
                            <h4 class="mb-0">Company Information</h4>
                            <span class="text-muted d-block my-2"><i class="material-icons mr-3"></i> <span class="company_name"></span></span>
                            <span class="text-muted d-block my-2"><i class="material-icons mr-3"></i> <span class="company_phone"></span></span>
                            <span class="text-muted d-block my-2"><i class="material-icons mr-3"></i> <span class="company_location"></span></span>
                            <span class="text-muted d-block my-2"><i class="material-icons mr-3"></i> <span class="company_email"></span></span>
                            <span class="text-muted d-block my-2"><i class="material-icons mr-3"></i> <span class="company_reg_no"></span></span>
                            <span class="text-muted d-block my-2"><i class="material-icons mr-3"></i> <span class="total_employ"></span></span>

                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-4">


                                    <strong class="text-muted d-block mb-2">Accountant Details:</strong>
                                    <div class="row">
                                        <div class="col-5">
                                            <span>Accountant Name: </span>
                                        </div>
                                        <div class="col-7">
                                            <span class="accountant_name"></span>
                                        </div>
                                        <div class="col-5">
                                            <span>Address: </span>
                                        </div>
                                        <div class="col-7">
                                            <span class="accountant_address"></span>
                                        </div>
                                        <div class="col-5">
                                            <span>Phone Number: </span>
                                        </div>
                                        <div class="col-7">
                                            <span class="accountant_phone"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <strong class="text-muted d-block mb-2">Bank Details:</strong>
                                    <div class="row">
                                        <div class="col-5">
                                            <span>Name of Bank: </span>
                                        </div>
                                        <div class="col-7">
                                            <span class="bank_name"></span>
                                        </div>
                                        <div class="col-5">
                                            <span>Branch Address: </span>
                                        </div>
                                        <div class="col-7">
                                            <span class="bank_address"></span>
                                        </div>
                                        <div class="col-5">
                                            <span>Account Number: </span>
                                        </div>
                                        <div class="col-7">
                                            <span class="account_no"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <strong class="text-muted d-block mb-2">Directors::</strong>
                                    <div class="row">
                                        <div class="col-5">
                                            <span>Name of Bank: </span>
                                        </div>
                                        <div class="col-7">
                                            <span class="director_name"></span>
                                        </div>
                                        <div class="col-5">
                                            <span>D.O.B: </span>
                                        </div>
                                        <div class="col-7">
                                            <span class="director_dob"></span>
                                        </div>
                                        <div class="col-5">
                                            <span>Address: </span>
                                        </div>
                                        <div class="col-7">
                                            <span class="director_address"></span>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>

                    <form method="post" class="py-4 animated fadeIn" id="upload_form" enctype="multipart/form-data" style="display: none">
                        {{csrf_field()}}
                        <div class="form-row mx-4">
                            <div class="col mb-3">
                                <p class="form-text text-muted m-0">Enter Company Information:</p>
                            </div>
                        </div>
                        <div class="form-row mx-4">
                            <div class="col-lg-4">
                                <div class="edit-user-details__avatar m-auto">
                                    <img src="" class="img-fluid rounded"
                                         style="height: 150px;width: 150px;display: none"
                                         id="previewLogo">
                                </div>
                                <input type="file" name="ProductPic" class="d-none" id="ImageUpload">
                                <input type="text" name="id" class="d-none" id="id">
                                <button type="button" class="btn btn-sm btn-white d-table mx-auto mt-4"
                                        onclick="chooseFile()"><i class="material-icons"></i> Upload Company Logo
                                </button>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstName">Name</label>
                                        <input type="text" class="form-control" name="company_name" id="company_name"
                                               placeholder="Enter Company Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phoneNumber">Company Phone Number</label>
                                        <div class="input-group input-group-seamless">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="company_phone"
                                                   id="company_phone" placeholder="+40 1234 567 890">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="userLocation">Company Location</label>
                                        <div class="input-group input-group-seamless mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="company_location" id="company_location"
                                                   class="form-control"
                                                   placeholder="Enter location">
                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="emailAddress">Email</label>
                                        <div class="input-group input-group-seamless">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="email" class="form-control" name="company_email"
                                                   id="company_email" placeholder="Enter Company Email">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="userLocation">Company Registration Number</label>
                                        <div class="input-group input-group-seamless mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="company_reg_no" id="company_reg_no"
                                                   class="form-control"
                                                   placeholder="845674">
                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="emailAddress">No of Employ</label>
                                        <div class="input-group input-group-seamless">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="email" class="form-control" name="total_employ"
                                                   id="total_employ"
                                                   placeholder="No of Employ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row mx-4">
                            <div class="col mb-3">
                                <p class="form-text text-muted m-0">Accountant Details:</p>
                            </div>
                        </div>
                        <div class="form-row mx-4">
                            <div class="form-group col-md-4">
                                <label for="firstName">Accountant Name</label>
                                <input type="text" class="form-control" name="accountant_name" id="accountant_name"
                                       placeholder="Enter Accountant Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="firstName">Address</label>
                                <input type="text" class="form-control" name="accountant_address"
                                       id="accountant_address"
                                       placeholder="Enter Address">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="firstName">Phone Number</label>
                                <input type="text" class="form-control" name="accountant_phone" id="accountant_phone"
                                       placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <hr>
                        <div class="form-row mx-4">
                            <div class="col mb-3">
                                <p class="form-text text-muted m-0">Bank Details:</p>
                            </div>
                        </div>
                        <div class="form-row mx-4">
                            <div class="form-group col-md-4">
                                <label for="firstName">Name of Bank</label>
                                <input type="text" class="form-control" name="bank_name" id="bank_name"
                                       placeholder="Enter Name of Bank">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="firstName">Branch Address</label>
                                <input type="text" class="form-control" name="bank_address" id="bank_address"
                                       placeholder="Enter Branch Address">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="firstName">Account Number</label>
                                <input type="text" class="form-control" name="account_no" id="account_no"
                                       placeholder="Enter Account Number">
                            </div>
                        </div>
                        <hr>
                        <div class="form-row mx-4">
                            <div class="col mb-3">
                                <p class="form-text text-muted m-0">Private Address Of Partners / Directors:</p>
                            </div>
                        </div>
                        <div class="form-row mx-4">
                            <div class="form-group col-md-4">
                                <label for="firstName">Name</label>
                                <input type="text" class="form-control" name="director_name" id="director_name"
                                       placeholder="Enter Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="firstName">D.O.B</label>
                                <input type="text" class="form-control" name="director_dob" id="director_dob"
                                       placeholder="D.O.B">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="firstName">Address</label>
                                <input type="text" class="form-control" name="director_address" id="director_address"
                                       placeholder="Enter Address">
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <button type="submit" class="btn btn-sm btn-accent ml-auto mr-3 w-25">Update</button>
                            <button type="button" class="btn btn-sm btn-warning ml-auto mr-3 closer">Close</button>
                        </div>

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

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function () {
            view();
            function view() {
                let id = {{$supplier->id}};
                $.ajax({
                    url: "{{ url('view-single-customer') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $('.previewLogo').attr('src', '{{asset('storage/customer/')."/"}}' + data.company_logo).show();
                        $('.company_name').html(data.company_name);
                        $('.company_phone').html(data.company_phone);
                        $('.company_location').html(data.company_location);
                        $('.company_email').html(data.company_email);
                        $('.company_reg_no').html(data.company_reg_no);
                        $('.total_employ').html(data.total_employ);
                        $('.accountant_name').html(data.accountant_name);
                        $('.accountant_address').html(data.accountant_address);
                        $('.accountant_phone').html(data.accountant_phone);
                        $('.bank_name').html(data.bank_name);
                        $('.bank_address').html(data.bank_address);
                        $('.account_no').html(data.account_no);
                        $('.director_name').html(data.director_name);
                        $('.director_dob').html(data.director_dob);
                        $('.director_address').html(data.director_address);
                    }
                });
            }

            $(document).on('click', '.edit', function () {
                $('.profile,.edit').hide();
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('view-single-customer') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $('#previewLogo').attr('src', '{{asset('storage/customer/')."/"}}' + data.company_logo).show();
                        $('#company_name').val(data.company_name);
                        $('#company_phone').val(data.company_phone);
                        $('#company_location').val(data.company_location);
                        $('#company_email').val(data.company_email);
                        $('#company_reg_no').val(data.company_reg_no);
                        $('#total_employ').val(data.total_employ);
                        $('#accountant_name').val(data.accountant_name);
                        $('#accountant_address').val(data.accountant_address);
                        $('#accountant_phone').val(data.accountant_phone);
                        $('#bank_name').val(data.bank_name);
                        $('#bank_address').val(data.bank_address);
                        $('#account_no').val(data.account_no);
                        $('#director_name').val(data.director_name);
                        $('#director_dob').val(data.director_dob);
                        $('#director_address').val(data.director_address);
                        $('#id').val(data.id);
                    }
                });
                $('#upload_form').show();
            });
            $(document).on('click', '.closer', function () {
                $('.profile,.edit').show();
                $('#upload_form').hide();
            });
            $('#upload_form').on('submit', function () {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('add.customer') }}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        if (data == 1) {
                            Swal.fire(
                                'Customer update successfully!',
                                'success'
                            )
                            view();
                        } else {
                            Swal.fire({
                                title: 'Supplier Submit Error!',
                                html: data,
                            })
                        }

                        $('.profile,.edit').show();
                        $('#upload_form').hide();
                    }

                })
            });

        });


    </script>


@endsection