@extends('account.layout.app')
@section('content')

    <div class="h-100 no-gutters row">
        <div class="auth-form mx-auto mt-3 col-md-5 col-lg-3">
            <div class="card">
                <div class="card-body"><img class="auth-form__logo d-table mx-auto mb-3"
                                            src="images/shards-dashboards-logo.svg"
                                            alt="Shards Dashboards - Login Template"><h5
                            class="auth-form__title text-center mb-4">Access Your Account</h5>
                    @if(session()->has('message'))
                        <div class="alert alert-success rounded">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form method="post" action="{{url('login')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" id="exampleInputEmail1" placeholder="Enter email"
                                   autocomplete="email"
                                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" placeholder="Password"
                                   autocomplete="current-password"
                                   class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-group"><label class="custom-control custom-checkbox"><input
                                        id="dr-checkbox-dCBByBa_x" type="checkbox"
                                        class="custom-control-input"><label id="dr-checkbox-dCBByBa_x"
                                                                            class="custom-control-label"
                                                                            aria-hidden="true"></label><span
                                        class="custom-control-description">Remember me</span></label>
                        </div>
                        <button type="submit" class="d-table mx-auto btn btn-accent btn-pill">Access Account
                        </button>
                    </form>
                </div>
            </div>
            <div class="auth-form__meta d-flex mt-4">
                <a href="{{route('forget-password')}}">Forgot your password?</a>
            </div>
        </div>
    </div>

@endsection