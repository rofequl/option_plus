@extends('account.layout.app')
@section('content')

    <div class="row">
        <div class="card card-small mx-auto my-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Create admin account and ready this app prepare for work</h6>
            </div>
            <form method="post" class="needs-validation" action="{{url('Register')}}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-secondary rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-3">
                            <strong class="text-muted d-block mb-2">Admin Information</strong>
                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">person</i>
                              </span>
                            </span>
                                    <input type="text"
                                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           id="form1-username" name="name" placeholder="Username">
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                @
                              </span>
                            </span>
                                    <input type="text"
                                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="email" id="form1-username" placeholder="Email">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                                    <input type="password"
                                           class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" id="form2-password"
                                           placeholder="Password">
                                    <span class="input-group-append">
                              <span class="input-group-text">
                                <i class="material-icons">lock</i>
                              </span>
                            </span>
                                </div>
                            </div>

                            <!-- Input Groups -->
                            <!-- Seamless Input Groups -->
                            <strong class="text-muted d-block mb-2">Company Information</strong>
                            <div class="input-group mb-3">
                                <div class="input-group input-group-seamless">
                                    <input type="text"
                                           class="form-control {{ $errors->has('company_name') ? ' is-invalid' : '' }}"
                                           id="form1-username" name="company_name"
                                           placeholder="Company Name">
                                </div>
                            </div>
                            <input type="file" class="d-none" name="company_logo" id="CompanyLogo">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="d-table mt-4 btn btn-white btn-sm"
                                            onclick="logoUpload()"><i class="material-icons"></i> Upload Logo
                                    </button>
                                </div>
                                <div class="col">
                                    <img src="" class="img-fluid rounded"
                                         style="height: 150px;width: 150px;display: none"
                                         id="previewLogo">
                                </div>
                            </div>
                            <div class="form-inline my-3">
                                <label for="inputPassword" class="col-form-label mr-2">Select Plan: </label>
                                <div class="">
                                    <select class="form-control" name="plan">
                                        <option value="1">Free</option>
                                        <option value="2">Premium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3 d-table">
                                <div class="custom-control custom-checkbox mb-1">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">I agree with the <a href="#">Terms &amp; Conditions</a>.</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer border-top py-3">
                    <button type="submit" class="ml-auto d-table mr-3 btn btn-accent btn-sm submit">Submit Form</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).on('click', '.submit', function () {

        });
    </script>


@endsection
