@extends('frontend.layout.index')
@section('content')
<div class="grid">
    @if(session('error'))
        <div class="alert alert--danger mt-2 mb-2" id="alert">
           {{   session('error') }}
        </div>
    @endif
    <div class="auth">
        <div class="auth-form">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Đăng ký</h3>
                    <a href="register.html" class="auth-form__btn-heading">Đăng nhập</a>
                </div>
                <form action="{{ url('/home/register') }}" method="post" class="auth-form__form">
                    @csrf
                    <div class="auth-form__row">
                        <input type="text" name="customer_name" class="auth-form__input" placeholder="Nhập tên của bạn">
                        @if ($errors->has('customer_name'))
                            <p class="help is-danger">{{ $errors->first('customer_name') }}</p>
                        @endif
                    </div>
                    <div class="auth-form__row">
                        <input type="text" name="customer_email" class="auth-form__input" placeholder="Nhập email của bạn">
                        @if ($errors->has('customer_email'))
                            <p class="help is-danger">{{ $errors->first('customer_email') }}</p>
                        @endif
                    </div>
                    <div class="auth-form__row">
                        <input type="text" name="customer_phone" class="auth-form__input" placeholder="Nhập Số điện thoại">
                        @if ($errors->has('customer_phone'))
                            <p class="help is-danger">{{ $errors->first('customer_phone') }}</p>
                        @endif
                    </div>
                    <div class="auth-form__row">
                        <input type="password" name="customer_password" class="auth-form__input" placeholder="Nhập mật khẩu của bạn">
                        @if ($errors->has('customer_password'))
                            <p class="help is-danger">{{ $errors->first('customer_password') }}</p>
                        @endif
                    </div>
                    <div class="auth-form__row">
                        <input type="password" name="customer_passwordAgain" class="auth-form__input" placeholder="Nhập lại mật khẩu">
                        @if ($errors->has('customer_passwordAgain'))
                            <p class="help is-danger">{{ $errors->first('customer_passwordAgain') }}</p>
                        @endif
                    </div>
                    <div class="auth-form__aside">
                        <p class="auth-form__note">
                            Bằng việc đăng kí, bạn đã đồng ý với Shopee về
                            <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a> &
                            <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
                        </p>
                    </div>
                    <div class="auth-form__control">
                        <button class="btn auth-form__control-back btn-normal">TRỞ LẠI</button>
                        <button type="submit" class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </form>
            </div>
            <div class="auth-form__social auth-form__social--bg-white">
                <a class="auth-form__social--facebook btn btn--size-s btn--with-icon"><i class="auth-form__social-icons fab fa-facebook-square"></i> <span class="auth-form__social-tittle"> Kết nối với FaceBook</span></a>
                <a class="auth-form__social--google btn btn--size-s btn--with-icon"><img src="./assets/img/iconGG.png" class="auth-form__social-icons-gg" alt=""><span class="auth-form__social-tittle">Kết nối với Google</span></a>
            </div> 
        </div>
    </div>
</div>
@endsection