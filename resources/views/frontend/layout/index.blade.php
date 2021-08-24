<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- reset CSS -->
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="./fe_asset/css/normalize.min.css">
    <link rel="stylesheet" href="{{asset('./fe_asset/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('./fe_asset/css/main.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./fe_asset/fonts/fontawesome-free-5.15.3-web/css/all.min.css">
    <style>
        .pagination{
            margin-top:20px 0px;
            justify-content:center;
            align-items:center;
            display:flex;
            padding:0px;
            
        }
        .page-item{
            list-style: none;
            font-size:1.4rem;
            background-color:var(--white-color);
        }
        .page-item:first-child{
            border-bottom-left-radius:2px ;
            border-top-left-radius:2px ;
        }
        .page-item:last-child{
            border-bottom-right-radius:2px ;
            border-top-right-radius:2px;
        }
        .page-item.active{
            background-color:var(--primary-color);
            color:var(--white-color);
        }
        .page-link{
            display:block;
            padding:10px;
            font-size:1.4rem;
            text-decoration:none;
            border-right:1px solid #E8E8E8;
        }
        .page-item:last-child .page-link{
            border-right:unset;
        }
    </style>
</head>
<body>
    <!-- Block Element Modifier:dùng thay đổi Element Block__element--modifier -->
    <div class="app">
      @include('frontend.layout.header')
        <div class="container">
            @if(session('error'))
                <div class="alert alert--danger  mt-2 mb-2" id="alert">{{ session('error') }}</div>
            @elseif(session('message'))
                <div class="alert alert--success" id="alert">{{ session('message') }}</div>
            @endif
            <!-- main content -->
            @yield('content')
            <!-- end content -->
        </div>
        <!-- footer -->
        @include('frontend.layout.footer')
        <!-- end footer -->
    </div>
    <!-- Modal layout -->
    <div class="modal" id="modal-login">
        <div class="modal__overlay"></div>
        <div class="modal__body">
            <div class="auth-form">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng ký</h3>
                        <button class="auth-form__btn-heading">Đăng nhập</button>
                        <i class="fas fa-times auth-form__header-iconclose" id="close"></i>
                    </div>
                    <form action="" class="auth-form__form">
                        <div class="auth-form__row">
                            <input type="text" class="auth-form__input" placeholder="Nhập email của bạn">
                        </div>
                        <div class="auth-form__row">
                            <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu của bạn">
                        </div>
                        <div class="auth-form__row">
                            <input type="password" class="auth-form__input" placeholder="Nhập lại mật khẩu">
                        </div>
                    </form>
                    <div class="auth-form__aside">
                        <p class="auth-form__note">
                            Bằng việc đăng kí, bạn đã đồng ý với Shopee về
                            <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a> &
                            <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
                        </p>
                    </div>
                    
                    <div class="auth-form__control">
                        <button class="btn auth-form__control-back btn-normal">TRỞ LẠI</button>
                        <button class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </div>
                <div class="auth-form__social">
                    <a class="auth-form__social--facebook btn btn--size-s btn--with-icon"><i class="auth-form__social-icons fab fa-facebook-square"></i> <span class="auth-form__social-tittle"> Kết nối với FaceBook</span></a>
                    <a class="auth-form__social--google btn btn--size-s btn--with-icon"><img src="./assets/img/iconGG.png" class="auth-form__social-icons-gg" alt=""><span class="auth-form__social-tittle">Kết nối với Google</span></a>
                </div> 
            </div>
            <!-- <div class="auth-form">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng nhập</h3>
                        <button class="auth-form__btn-heading">Đăng ký</button>
                    </div>
                    <form action="" class="auth-form__form">
                        <div class="auth-form__row">
                            <input type="text" class="auth-form__input" placeholder="Nhập email của bạn">
                        </div>
                        <div class="auth-form__row">
                            <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu của bạn">
                        </div>
                    </form>
                    <div class="auth-form__aside">
                        <div class="auth-form__help">
                            <a href="" class="auth-form__help-link auth-form__help">Quên mật khẩu</a>
                            <a href="" class="auth-form__help-link">Cần trợ giúp?</a>
                        </div>
                    </div>
                    
                    <div class="auth-form__control">
                        <button class="btn auth-form__control-back btn-normal">TRỞ LẠI</button>
                        <button class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </div>
                <div class="auth-form__social">
                    <a class="auth-form__social--facebook btn btn--size-s btn--with-icon"><i class="auth-form__social-icons fab fa-facebook-square"></i> <span class="auth-form__social-tittle"> Kết nối với FaceBook</span></a>
                    <a class="auth-form__social--google btn btn--size-s btn--with-icon"><img src="./assets/img/iconGG.png" class="auth-form__social-icons-gg" alt=""><span class="auth-form__social-tittle">Kết nối với Google</span></a>
                </div> 
            </div> -->
        </div>
    </div>
    <script src="./fe_asset/js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            window.setTimeout(() => {
                $('#alert').remove();
            },4000);
        });
    </script>
    @yield('script')
    <!-- <script>
        if(document.getElementById('login').onclick){
            const ChangeStyle = ()=> {
                document.getElementById('modal-login').style = 'display:flex;';
            }
            document.getElementById('login').onclick = ChangeStyle();
        }else if(document.getElementById('close').onclick){
            const CloseModal = () => {
                document.getElementById('modal-login').style = 'display:none;';
            }
            document.getElementById('close').onclick = CloseModal(); 
        }
    </script> -->
</body>
</html>



