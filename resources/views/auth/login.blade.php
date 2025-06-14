@extends('auth.layouts')
@section('title')
   MBCOE LOGIN
@endsection

@section('content')
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
        <div class="kt-login__logo">
            <a href="#">
                <img src="{{ getImageUrl($setting->logo ?? null) }}" height="100" width="100">
            </a>
        </div>
        <div class="kt-login__signin">
            <div class="kt-login__head">
                <h3 class="kt-login__title">Sign In To Admin</h3>
            </div>
            <form class="kt-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
                </div>
                <div class="input-group">
                    <input class="form-control" type="password" placeholder="Password" name="password">
                </div>
                <div class="row kt-login__extra">
                    <div class="col">
                        <label class="kt-checkbox">
                            <input type="checkbox" name="remember"> Remember me
                            <span></span>
                        </label>
                    </div>
                    <div class="col kt-align-right">
                        <a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Forget Password ?</a>
                    </div>
                </div>
                <div class="kt-login__actions">
                    <button type="submit" class="btn btn-brand btn-pill kt-login__btn-primary">Sign In</button>
                </div>
            </form>
        </div>
        <div class="kt-login__forgot">
            <div class="kt-login__head">
                <h3 class="kt-login__title">Forgotten Password ?</h3>
                <div class="kt-login__desc">Enter your email to reset your password:</div>
            </div>
            <form class="kt-form" action="">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                </div>
                <div class="kt-login__actions">
                    <button id="kt_login_forgot_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Request</button>&nbsp;&nbsp;
                    <button id="kt_login_forgot_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
            </div>
        </div>
    </div>
@endsection
