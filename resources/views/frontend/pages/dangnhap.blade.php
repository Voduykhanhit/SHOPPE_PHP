@extends('frontend.layout.index')
@section('content')
<div class="grid">
    <div class="auth">
        <div class="auth-form">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Đăng nhập</h3>
                    <a href="./login.html" class="auth-form__btn-heading">Đăng ký</a>
                </div>
                <form action="{{ url('/home/login') }}" method="post" class="auth-form__form">
                    @csrf
                    <div class="auth-form__row">
                        <input type="text" name="customer_email" class="auth-form__input" placeholder="Nhập email của bạn">
                    </div>
                    <div class="auth-form__row">
                        <input type="password" name="customer_password" class="auth-form__input" placeholder="Nhập mật khẩu của bạn">
                    </div>
                    <div class="auth-form__aside">
                        <div class="auth-form__help">
                            <a href="" class="auth-form__help-link">Quên mật khẩu</a>
                            <a href="" class="auth-form__help-link">Cần trợ giúp?</a>
                        </div>
                    </div>
                    <div class="auth-form__control">
                        <button class="btn auth-form__control-back btn-normal">TRỞ LẠI</button>
                        <button type="submit" class="btn btn--primary">ĐĂNG NHẬP</button>
                    </div>
                </form>
            </div>
            <div class="auth-form__social">
                <a class="auth-form__social--facebook btn btn--size-s btn--with-icon"><i class="auth-form__social-icons fab fa-facebook-square"></i> <span class="auth-form__social-tittle"> Kết nối với FaceBook</span></a>
                <a class="auth-form__social--google btn btn--size-s btn--with-icon"><img src="./assets/img/iconGG.png" class="auth-form__social-icons-gg" alt=""><span class="auth-form__social-tittle">Kết nối với Google</span></a>
            </div> 
        </div>
    </div>
</div>
@endsection