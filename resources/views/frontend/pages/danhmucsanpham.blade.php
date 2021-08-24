@extends('frontend.layout.index')
@section('content')
<div class="grid">
    <div class="grid__row">
        <!-- Menu -->
        @include('frontend.layout.menu')
        <!-- endMenu -->
        <div class="grid__column-10">
            <div class="home-filter">
                <span class="home-filter__label">Sắp xếp theo</span>
                <button class="home-filter__btn btn">Phổ biến</button>
                <button class="home-filter__btn btn btn--primary">Mới nhất</button>
                <button class="home-filter__btn btn">Bán chạy</button>
                <div class="select-input">
                    <span class="select-input__label">Giá</span>
                    <i class="select-input__icon fas fa-chevron-down"></i>
                    <ul class="select-input__list">
                        <li class="select-input__item">
                            <a href="" class="select-input__link">Giá : Thấp đến Cao</a>
                        </li>
                        <li class="select-input__item">
                            <a href="" class="select-input__link">Giá : Cao đến Thấp</a>
                        </li>
                    </ul>
                </div>
                <div class="home-filter__page">
                    <span class="home-filter__page-number">
                        <span class="home-filter__page-current">1</span>/14
                    </span>
                    <div class="home-filter__page-control">
                        <a href="" class="home-filter__page-btn home-filter__page-btn--active">
                            <i class="home-filter__page-icon fas fa-angle-left"></i>
                        </a>
                        <a href="" class="home-filter__page-btn">
                            <i class="home-filter__page-icon fas fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="home-product">
                <div class="grid__row">
                    <!-- grid__column-2-4 -->
                    @foreach($ctg as $key => $value)
                        <div class="grid__column-2-4">
                            <div class="home-product__cart-list">
                                <!-- header cart -->
                                <div class="home-product__header">
                                    <span class="home-product__header-favourite">Yêu thích <i class="home-product__header-favourite-icon fas fa-check"></i></span>
                                    <a href="{{url('home/details/'.$value->product_id)}}"><img src="../storage/app/public/image/sanpham/{{ $value->product_image }}" class="home-product__header-img" alt=""></a>
                                    <div class="home-product__header-sale">
                                        <span class="home-product__header-sale-percent">10%</span>
                                        <span class="home-product__header-sale-status">Giảm</span>
                                    </div>
                                </div>
                                <!-- end header -->
                                <div class="home-product__body">
                                    <span class="home-product__body-title">{{$value->product_name}}</span>
                                    <!-- price -->
                                    <div class="home-product__body-price">
                                        <del class="home-product__body-price-old">&#8363;{{ number_format($value->product_price*1.1) }}</del>
                                        <span class="home-product__body-price-curent">&#8363;{{ number_format($value->product_price) }}</span>
                                    </div>
                                    <!-- end price -->
                                    <!-- Vote Rate -->
                                    <div class="home-product__body-vr">
                                        <span class="home-product__body-rate home-product__body-rate--liked">
                                            <i class="far fa-heart home-product__body-rate-icon-empty"></i>
                                            <i class="fas fa-heart home-product__body-rate-icon-fill"></i>
                                        </span>
                                        <div class="home-product__body-vote">
                                            <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                                            <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                                            <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                                            <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <!-- <i class="fas fa-star"></i> -->
                                        </div>
                                        <span class="home-product__body-rate__sold">66 đã bán</span>
                                    </div>
                                    <!-- end Vote rate -->
                                    <!-- Brand -->
                                    <div class="home-product__body-brand">
                                        <span class="home-product__body-brand-name">Whoo</span>
                                        <span class="home-product__body-brand-name">Hàn Quốc</span>
                                    </div>
                                    <!-- endBrand -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end grid__column-2-4 -->
                </div>
            </div>
            {{ $ctg->links() }}
            <!-- <ul class="home-paginate">
                <li class="home-paginate__item">
                
                    <a href="" class="btn home-paginate__link ">
                        <i class="fas fa-angle-left home-paginate__link-icon-backpage"></i>
                    </a>
                    <a href="" class="btn home-paginate__link home-paginate__link--active">
                   
                    </a>
                    <a href="" class="btn home-paginate__link">
                        <i class="home-paginate__link-icon-nextpage fas fa-angle-right"></i>
                    </a>
                </li>
            </ul> -->
        </div>
    </div>
</div>
@endsection