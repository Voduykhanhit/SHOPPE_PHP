@extends('frontend.layout.index')
@section('content')
<div class="grid">
    <div class="grid__row row--cart">
        @include('frontend.layout.menu')
        <div class="grid__column-10 grid__column-10--cart">
            <!-- Shopping Cart -->
        <div class="cart">
            <div class="cart__title">
                <h3 class="cart__title-heading">Giỏ hàng của bạn</h3>
            </div>
            @php 
                $cartItem = Cart::content();
            @endphp
            @if(isset($cartItem) &&  $cartItem->count() > 0)
                @foreach($cartItem as $item)
                    <div class="cart__body">
                        <img src="../storage/app/public/image/sanpham/{{ $item->options->image }}" alt="" class="cart__body-img">
                        <span class="cart__body-name">{{ $item->name }}</span>
                        <div class="card-details__qty-btn card-details__qty-btn--cartbody">
                            <button class="btn btn--qty">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="text" class="card-details__qty-input" value="{{ $item->qty }}">
                            <button class="btn btn--qty">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="cart__body-payment"> 
                            <span class="cart__body-price">{{ number_format($item->price) }}đ</span>
                            <span class="cart__body-multi">x</span>
                            <span class="cart__body-quantity">{{ $item->qty }}</span>
                        </div>
                        <a href="{{ url('/home/delcart/'.$item->rowId) }}" class="btn btn--primary btn--primary-del"><i class="fas fa-backspace"></i></a>
                    </div>
                @endforeach
                    <div class="cart__body-total">
                        @php 
                            if(Session::get('fee_ship')){
                                $fee = (int)Session::get('fee_ship');
                            }else{
                                $fee = 0;
                            }
                            $total = 0;
                            $subtotal = $item->price * $item->qty;
                            $total += $subtotal;
                           
                        @endphp
                        <span class="cart__body-total-label">Tổng tiền:</span>
                        <span class="cart__body-total-price">{{  number_format($total + $fee) }}đ</span>
                        <a href="{{ url('/home') }}" class="btn btn--primary btn--continue">Tiếp tục mua hàng</a>
                    </div>
            @else
                    <div class="cart__body-total">
                        <span class="cart__body-total-label">Giỏ hàng rổng</span>
                        <a href="{{ url('/home') }}" class="btn btn--primary btn--continue">Tiếp tục mua hàng</a>
                    </div>
            @endif
        </div>
        <div class="form">
            <h2 class="form__title"><i class="fas fa-shipping-fast"></i> Phí vận chuyển</h2>
            <form action="" class="form__content">
                @csrf
                <div class="form__group">
                    <label for="" class="form__label">Tỉnh</label>
                    <select name="" class="form__select chon" id="Tinh">
                        <option value="">--Chọn tỉnh--</option>
                        @foreach($city as $key => $ct)
                            <option value="{{ $ct->matp }}">{{ $ct->name_city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form__group">
                    <label for="" class="form__label">Quận Huyện</label>
                    <select name="" id="QuanHuyen" class="form__select chon">
                        <option value="">--Chọn quận huyện--</option>
                    </select>
                </div>
                <div class="form__group">
                    <label for=""  class="form__label">Xã</label>
                    <select name="" id="Xa" class="form__select">
                        <option value="">--Chọn xã phường--</option>
                    </select>
                </div>
                    <button id="submit" class="btn btn--primary btn--action" type="button">Tính phí</button>
                    <button class="btn btn--primary btn--action" type="reset">Huỷ</button>
            </form>
        </div>
        <!-- End Shopping Cart -->
        <div class="form">
            <h2 class="form__title"><i class="fas fa-money-check form__title-icon"></i> Thông tin người nhận</h2>
            <form action="{{ url('/home/checkout') }}" method="post" class="form__content">
                @csrf
                <div class="form__group">
                    <label for="Ten" class="form__label">Tên người nhận</label>
                    <input type="text" class="form__input" name="Ten" id="Ten" value="" placeholder="Nhập tên người nhận">
                    @if ($errors->has('Ten'))
                        <p class="help is-danger">{{ $errors->first('Ten') }}</p>
                    @endif
                </div>
                <div class="form__group">
                    <label for="DiaChi" class="form__label">Địa chỉ</label>
                    <textarea name="DiaChi" class="form__input" id="DiaChi" cols="30" rows="10"></textarea>
                    @if ($errors->has('DiaChi'))
                        <p class="help is-danger">{{ $errors->first('DiaChi') }}</p>
                    @endif
                </div>
                <div class="form__group">
                    <label for="SoDienThoai" class="form__label">Số điện thoại</label>
                    <input type="text" class="form__input" name="SoDienThoai" id="SoDienThoai" value="" placeholder="Nhập số điện thoại">
                    @if ($errors->has('SoDienThoai'))
                        <p class="help is-danger">{{ $errors->first('SoDienThoai') }}</p>
                    @endif
                </div>
                <div class="form__group">
                    <label for="Email" class="form__label">Email</label>
                    <input type="email" class="form__input" name="Email" id="Email"  value="" placeholder="Nhập số email">
                    @if ($errors->has('Email'))
                        <p class="help is-danger">{{ $errors->first('Email') }}</p>
                    @endif
                </div>
                <div class="form__group">
                    <label for="GhiChu" class="form__label">Ghi chú</label>
                    <textarea name="GhiChu" class="form__input" id="GhiChu" cols="30" rows="10"></textarea>
                    @if ($errors->has('GhiChu'))
                        <p class="help is-danger">{{ $errors->first('GhiChu') }}</p>
                    @endif
                </div>
                <div class="form__group">
                    <label for=""  class="form__label">Hình thức thanh toán</label>
                    <select name="Payment"  class="form__select">
                        <option value="">--Chọn hình thức thanh toán--</option>
                        <option value="1">Khi nhận hàng</option>
                        <option value="2">Thẻ ATM</option>
                    </select>
                </div>
                <button type="submit" class="btn btn--primary btn--action" type="button">Gửi</button>
                <button class="btn btn--primary btn--action" type="reset">Huỷ</button>
                <!-- <div class="form__check">
                    <input type="checkbox" class="form__checkbox" value="Checkmeout" id="Example">
                    <label for="Example" class="form__label">ok</label>
                </div> -->
                <!-- <div class="form__row">
                    <div class="form__column-4">
                        <label for="" class="form__label mr-2">Danh mục</label>
                        <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                    </div>
                    <div class="form__column-4">
                        <label for="" class="form__label mr-2">Sản phẩm</label>
                        <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                    </div>
                    <div class="form__column-4">
                        <label for="" class="form__label mr-2">Sản phẩm</label>
                        <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__column-4">
                        <label for="" class="form__label mr-2">Danh mục</label>
                        <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                    </div>
                    <div class="form__column-8">
                        <label for="" class="form__label mr-2">Sản phẩm</label>
                        <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                    </div>
                </div> -->
            </form>
        </div>
    </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.chon').on('change',function(){
                var action = $(this).attr('id');
                var matp = $(this).val();
                var result = '';
                var _token = $('input[name="_token"]').val();
                if(action == "Tinh"){
                    result = "QuanHuyen";
                }else if(action == "QuanHuyen"){
                    result = "Xa";
                }
                console.log(action);
                $.ajax({
                    url:"home/charge",
                    method:"post",
                    data:{
                            action:action,
                            matp:matp,
                            _token:_token
                        },
                    success:function(data)
                    {
                        console.log(data);
                       $('#'+result).html(data);
                    }
                });
            });
        });
        $(document).ready(function(){
            $('#submit').on('click',function(){
                var matp = $('#Tinh').val();
                var maqh = $('#QuanHuyen').val();
                var xaid = $('#Xa').val();
                var actionpvc = "TinhPVC";
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"home/charge",
                    method:"post",
                    data:{
                        actionpvc:actionpvc,
                            matp:matp,
                            maqh:maqh,
                            xaid:xaid,
                            _token:_token
                        },
                    success:function(data)
                    {
                        window.location.reload();
                    }
                });
            })
        })
    </script>
@endsection