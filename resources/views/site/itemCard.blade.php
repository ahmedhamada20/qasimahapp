<div class="col-12 col-md-6 col-lg-4">
    <div class="mmain_card">
        <div class="card_head">
            @if(!request()->is('*coupons') && !request()->is('couponFilter'))
            <div class="ci_img">
                <img src="{{$item->brand ? $item->brand->image : asset('site/img/logo.svg')}}" alt="">
                <div class="ci_img_info">
                    <h6>{{$item->title[App::getLocale()]}}</h6>
                    <span>@lang('data.offer'): {{$item->discount_percent}}</span>
                </div>
            </div>
            @else
                <a href="{{optional(optional($item->brand)->seoPage)->uri ?? '#'}}" class="ci_img">
                    <img src="{{$item->brand ? $item->brand->image : asset('site/img/logo.svg')}}" alt="">
                    <div class="ci_img_info">
                        <h6>{{$item->title[App::getLocale()]}}</h6>
                        <span>@lang('data.offer'): {{$item->discount_percent}}</span>
                    </div>
                </a>
            @endif

            <div class="ci_icon">
                <div class="m_icons">
                    <a href="{{route('favItem',$item->id)}}">


                        @if(\Auth::check() && checkItemFav(auth()->id(),$item->id) == true)
                            <img src="{{asset('site/img/red-heart.svg')}}" alt="">
                        @else
                            <img src="{{asset('site/img/heart.svg')}}" alt="">

                        @endif

                    </a>
                    @if(isset($category) && $category == 'Used Coupons')
                        <a href="{{route('removeUsedCoupon',$item->id)}}">
                            <img src="{{asset('site/img/close.svg')}}" alt="">
                        </a>
                    @endif

                    <div class="share-l">
                        <img src="{{asset('site/img/share.svg')}}" alt="">

                        <?php
                        $sharedContent = "{$item->title[App::getLocale()]}" . "--" . " خصم {$item->discount_percent} " . "-- " . " كود الخصم  {$item->discount_code} ";
                        ?>
                        <div class="icon_shear">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{$item->url}}&quote={!! $sharedContent !!}"
                               target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="http://twitter.com/share?text={{$sharedContent}}&url={!! $item->url !!}"
                               target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card_body">
            <p style="height: 102px; overflow: hidden;">{{$item->description[App::getLocale()]}} </p>
        </div>
        <div class="card_foot">
            <a href="" class="copy_code" onClick='copy_data(select_txt{{$item->id}},"{{$item->id}}","{{$item->title[App::getLocale()]}}")'>
                <p>@lang('data.copyCode')</p>
                <span id="select_txt{{$item->id}}">{{$item->discount_code}}</span>
            </a>
            <a href="{{$item->url}}" target="_blank" class="main_btn">@lang('data.shopNow')</a>
        </div>
    </div>
</div>

