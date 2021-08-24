@extends('frontend.layout.index')
@section('content')
<div class="grid">
    <div class="grid__row row--cart">
        @include('frontend.layout.menu')
        <div class="grid__column-10 grid__column-10--cart">
            <div class="cart">
                <div class="cart__title">
                    <h3 class="cart__title-heading">Giỏ hàng của bạn</h3>
                </div>
                @php 
                    $cartItem = Cart::content();
                    $cm_id = Session::get('cm_id');
                @endphp
                @if(isset($cartItem) &&  $cartItem->count() > 0)
                    @foreach($cartItem as $item)
                        <div class="cart__body">
                            <img src="../storage/app/public/image/sanpham/{{ $item->options->image }}" alt="" class="cart__body-img">
                            <span class="cart__body-name">{{ $item->name }}</span>
                            <div class="card-details__qty-btn card-details__qty-btn--cartbody">
                                <button class="btn btn--qty btn--sub-qty" data-id="{{ $item->rowId }}" data-id-product='{{ $item->id }}'>
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="text" class="card-details__qty-input" value="{{ $item->qty }}">
                                <button class="btn btn--qty btn--add-qty" data-id="{{ $item->rowId }}" data-id-product='{{ $item->id }}'>
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
                            <span class="cart__body-total-label">Tổng tiền:</span>
                            <span class="cart__body-total-price">{{ Cart::total() }}đ</span>
                            <a href="{{ url('/home') }}" class="btn btn--primary btn--continue">Tiếp tục mua hàng</a>
                            @if(isset($cm_id) && $cm_id!="")
                                <a href="{{ url('/home/checkout') }}" class="btn btn--primary btn--continue">Thanh Toán</a>
                            @else
                                <a href="{{ url('/home/login') }}" class="btn btn--primary btn--continue">Thanh Toán</a>
                            @endif
                        </div>
                @else
                        <div class="cart__body-total">
                            <span class="cart__body-total-label">Giỏ hàng rổng</span>
                            <a href="{{ url('/home') }}" class="btn btn--primary btn--continue">Tiếp tục mua hàng</a>
                        </div>
                @endif
            </div>
    </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            // Giảm
            $(document).on('click','.btn--sub-qty',function(){
                var qty = $(this).parent().find('.card-details__qty-input').val();
                var rowId = $(this).data('id');
                var idProduct = $(this).data('id-product');
                var action = "sub";
                if(qty < 2){
                    alert("Sản phẩm số lượng nhỏ nhất đã là 1 bạn không được giảm thêm!!!");
                }else{
                    $.ajax({ 
                        url:'home/updatecart',
                        method:'get',
                        data:{qty:qty,rowId:rowId,idProduct:idProduct,action:action},
                        success:function(data){
                            if(data.errors !== "undefined"){
                                window.location.reload();
                            }else{
                                alert(data.errors);
                            } 
                        }
                    });
                }   
            });
            // Tăng
            $(document).on('click','.btn--add-qty',function(){
                var qty = $(this).parent().find('.card-details__qty-input').val();
                var rowId = $(this).data('id');
                var idProduct = $(this).data('id-product');
                var action = "add";
                $.ajax({ 
                    url:'home/updatecart',
                    method:'get',
                    data:{qty:qty,rowId:rowId,idProduct:idProduct,action:action},
                    success:function(data){
                        if(data.errors !== "undefined"){
                            window.location.reload();
                        }else{
                            alert(data.errors);
                        } 
                    }
                });
            });
            //Chọn tỉnh thành
        });
    </script>
@endsection