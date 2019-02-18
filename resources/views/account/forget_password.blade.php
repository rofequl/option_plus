@extends('account.layout.app')
@section('content')

    <div class="h-100 no-gutters row">
        <div class="auth-form mx-auto mt-3 col-md-5 col-lg-3">
            <div class="card">
                <div class="card-body"><img class="auth-form__logo d-table mx-auto mb-3"
                                            src="images/shards-dashboards-logo.svg"
                                            alt="Shards Dashboards - Register Template"><h5
                            class="auth-form__title text-center mb-4">Reset Password</h5>
                    <form class="">
                        <div class="form-group"><label for="exampleInputEmail1">Email address</label><input type="email"
                                                                                                            id="exampleInputEmail1"
                                                                                                            placeholder="Enter email"
                                                                                                            autocomplete="email"
                                                                                                            class="form-control">
                            <small class="form-text text-muted text-center">You will receive an email with a unique
                                token.
                            </small>
                        </div>
                        <button type="submit" class="d-table mx-auto btn btn-accent btn-pill">Reset Password</button>
                    </form>
                </div>
            </div>
            <div class="auth-form__meta d-flex mt-4"><a class="mx-auto" href="{{route('login')}}">Take
                    me
                    back to login.</a></div>
        </div>
    </div>

@endsection