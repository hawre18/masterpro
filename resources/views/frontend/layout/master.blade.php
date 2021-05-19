<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ساکا مارکت</title>
    <meta name="description" content="Responsive and clean html template design for any kind of ecommerce webshop">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/frontend/styles/font.css">
    <link rel="stylesheet" href="/frontend/styles/owl.carousel.min.css" />
    <link rel="stylesheet" href="/frontend/styles/owl.theme.default.min.css" />
    <link type="text/css" rel="stylesheet" href="/frontend/magiczoomplus/magiczoomplus.css"/>
    <script type="text/javascript" src="/frontend/magiczoomplus/magiczoomplus.js"></script>
    <link rel="stylesheet" href="/frontend/styles/custom.css" />
    <link rel="stylesheet" href="/frontend/styles/font.css" />
    <link rel="stylesheet" href="/frontend/styles/app.css" />
    <link rel="stylesheet" href="/frontend/styles/responsive.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<div class="responsive-menu-container menu">
    <div class="container">
        <div class="responsive-men d-flex align-items-center justify-content-between">
            <img src="/images/nav-bar/logo-12" alt="logo" class="logo" />
            <i class="fas fa-bars menu-icon"></i>
        </div>
        <ul class="p-0 responsive-ul">
            <li>
                <a href="#"> خانه </a>
            </li>
            <li class="list-item multi" id="product">
                <a href="#" class="d-flex align-items-center justify-content-between">
                    محصولات
                    <i class="fas fa-angle-down under-menu-angle"></i>
                </a>
            </li>
            @foreach($brands as $brand)
                <li class="list-item multi sub moh" data-for="product" id="sub-product">
                    @foreach($brand->photo as $pic)
                        <a href="#"> <img src="{{$brand->photo['path']}}" width="70" alt=""> </a>
                    @endforeach
                    @foreach($brand->categories as $bcat)
                        <li class="m-0 list-item sub" data-for="product sub-product">
                            <a href="{{route('category.index',['id'=>$bcat])}}"> {{$bcat->name}} </a>
                        </li>
                    @endforeach
                </li>
            @endforeach
            <li>
                <a href="#"> آموزش </a>
            </li>
            <li>
                <a href="#"> ارتباط با ما </a>
            </li>
            <li>
                <a href="#"> تماس با ما </a>
            </li>
        </ul>
    </div>
</div>
<div class="menu-container menu">
    <div class="line-top-header"></div>
    <div class="container-5s">
        <nav class="d-flex align-items-center justify-content-between">
            <ul class="d-flex align-items-center p-0">
                <li class="hover-product">
                    <a href="#" class="hover-product-a">
                        <i class="fas fa-bars first-bars"></i>
                        <span class="categori">محصولات بازرگانی موسوی</span>
                        <i class="fa fa-angle-down down-arrow"></i>
                    </a>
                    <div class="big-menu-items">
                        <div class="container container-2">
                            <div class="d-flex">
                                <div>
                                    <button type="submit" class="d-flex align-items-center justify-content-between brand-product">
                                        <img src="images/nav-bar/logo-1.jpg" alt="logo">
                                        <i class="fas fa-angle-left"></i>
                                        @foreach($brands=App\Models\Brand::with('photo')->get() as $brand)
                                            <div class="main-container-items-menu active">
                                                <div class="d-flex">
                                                    @foreach($brand->photo as $pic)
                                                        <img src="{{$brand->photo['path']}}" alt="logo" class="logo" id="show-logo">
                                                    @endforeach
                                                </div>
                                                <hr size="5" color="#19365e">
                                                @foreach($categories=App\Models\Category::where('parent_id',null)->get() as $cat)
                                                    <div class="d-flex flex-column bg-white bg-white">
                                                        <div class="menu-items menu-items-2 d-flex justify-content-between">
                                                            <div class="menu-item">
                                                                @if( $cat->parent_id == null )
                                                                    <h5 class="dark-color">{{$cat->name}}</h5>
                                                                    @if(!$cat->children->isEmpty())
                                                                        <ul class="item-ul">
                                                                            @include('frontend.partials.menu',['categories'=>$cat->childrenRecursive, 'level'=>1])
                                                                        </ul>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="index.html">خانه</a></li>
                <li>|</li>
                <li><a href="learning.html">آموزش</a></li>
                <li>|</li>
                <li><a href="#">درباره ما</a></li>
                <li>|</li>
                <li><a href="#">ارتباط با ما</a></li>
                <li>|</li>
                <li><a href="#" class="web-sell">سامانه فروش</a></li>
            </ul>
            <img src="images/nav-bar/logo-12" alt="logo" width="160">
        </nav>
    </div>
</div>
<div class="makesh" style="margin-top: -31px;"></div>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($slides as $slide)
        <div class="carousel-item active">
            @foreach($slide->photos as $photo)
            <img src="{{$photo->path}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>{{$photo->title}}</h5>
                <p>{{mb_substr($photo->description, 0, 15).' ...' }}</p>
                <a href="" class="btn btn-secondary">بیشتر</a>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">قبلی</span>
    </button>
    <button id="nexttt" class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">بعدی</span>
    </button>
</div>
<div class="container-fluid">
    <div class="row text-life">
        <div class="col text-center mt-3">
            <div class="search-box">
                <form class="form-search" action="">
                    <input class="form-control text-right rounded-0" type="text" placeholder="جستجوی محصول">
                    <select name="" id="">
                        <option value="">autonic</option>
                        <option value="">autonic</option>
                        <option value="">autonic</option>
                        <option value="">autonic</option>
                    </select>
                    <button><img src="images/search/f9bb81e576c1a361c61a8c08945b2c48-search-icon-by-vexels.png" width="25" alt=""></button>
                </form>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-left justify-content-between">
            <h4 class="mt-4 text-secondary">قیمت های ویژه</h4><br>
            <h4 class="mt-4 text-secondary">محصولات جدید</h4><br>
        </div>
    </div>
</div>
<hr class="mb-4">
<div class="container-fluid mt-4 mb-5">
    <div class="row products">
        @foreach($products as $product)
        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-2 mt-1 text-center">
            <a href="{{route('products.single',['id'=>$product->id])}}">
                <div class="card">
                    <div class="card-body">
                        <img src="{{$product->photos->path}}"  width="100%" alt="{{$product->title}}" title="{{$product->title}}">
                    </div>
                </div>
            </a>
        </div>
        @endforeach
       </div>
</div>
<div class="text-center mt-5">
    <h4>News</h4>
</div>
<div class="container">
    <hr>
</div>
<div class="container-fluid mt-5 mb-5">
    <div id="owl-demo" class="owl-carousel owl-theme owl-loaded owl-drag">
<div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1325px, 0px, 0px); transition: all 0.25s ease 0s; width: 5300px;"><div class="owl-item" style="width: 1325px;"><div>
                        <div class="row align-items-center slider-section-4">
                            <div class="col-12 col-lg-5">
                                <div class="left-sction-slider">
                                    <div class="description-slider">
                                        <div class="slider-image-icon-container">
                                            <i class="fas fa-video camera-icon"></i>
                                        </div>
                                        <h2 class="slider-title">
                                            Lorem ipsum <br>
                                            dolor sit amet.
                                        </h2>
                                        <p class="lightgray-color self-description">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Numquam, at amet voluptatem aut quas eos magni
                                            asperiores sequi quo, possimus modi, dignissimos quos.
                                            Incidunt animi veritatis cumque dolore pariatur omnis.
                                        </p>
                                        <a href="" class="btn btn-secondary">بیشتر</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div>
                                    <img src="images/section-4-slider-img/Screenshot (310).png" alt="slider img" class="section-4-slider-img">
                                </div>
                            </div>
                        </div>
                    </div></div><div class="owl-item active" style="width: 1325px;"><div>
                        <div class="row align-items-center slider-section-4">
                            <div class="col-12 col-lg-5">
                                <div class="left-sction-slider">
                                    <div class="description-slider">
                                        <div class="slider-image-icon-container">
                                            <i class="fas fa-video camera-icon"></i>
                                        </div>
                                        <h2 class="slider-title">
                                            Lorem ipsum <br>
                                            dolor sit amet.
                                        </h2>
                                        <p class="lightgray-color self-description">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Numquam, at amet voluptatem aut quas eos magni
                                            asperiores sequi quo, possimus modi, dignissimos quos.
                                            Incidunt animi veritatis cumque dolore pariatur omnis.
                                        </p>
                                        <a href="" class="btn btn-secondary">بیشتر</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div>
                                    <img src="images/section-4-slider-img/Screenshot (310).png" alt="slider img" class="section-4-slider-img">
                                </div>
                            </div>
                        </div>
                    </div></div><div class="owl-item" style="width: 1325px;"><div>
                        <div class="row align-items-center slider-section-4">
                            <div class="col-12 col-lg-5">
                                <div class="left-sction-slider">
                                    <div class="description-slider">
                                        <div class="slider-image-icon-container">
                                            <i class="fas fa-video camera-icon"></i>
                                        </div>
                                        <h2 class="slider-title">
                                            Lorem ipsum <br>
                                            dolor sit amet.
                                        </h2>
                                        <p class="lightgray-color self-description">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Numquam, at amet voluptatem aut quas eos magni
                                            asperiores sequi quo, possimus modi, dignissimos quos.
                                            Incidunt animi veritatis cumque dolore pariatur omnis.
                                        </p>
                                        <a href="" class="btn btn-secondary">بیشتر</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div>
                                    <img src="images/section-4-slider-img/Screenshot (310).png" alt="slider img" class="section-4-slider-img">
                                </div>
                            </div>
                        </div>
                    </div></div><div class="owl-item" style="width: 1325px;"><div>
                        <div class="row align-items-center slider-section-4">
                            <div class="col-12 col-lg-5">
                                <div class="left-sction-slider">
                                    <div class="description-slider">
                                        <div class="slider-image-icon-container">
                                            <i class="fas fa-video camera-icon"></i>
                                        </div>
                                        <h2 class="slider-title">
                                            Lorem ipsum <br>
                                            dolor sit amet.
                                        </h2>
                                        <p class="lightgray-color self-description">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Numquam, at amet voluptatem aut quas eos magni
                                            asperiores sequi quo, possimus modi, dignissimos quos.
                                            Incidunt animi veritatis cumque dolore pariatur omnis.
                                        </p>
                                        <a href="" class="btn btn-secondary">بیشتر</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div>
                                    <img src="images/section-4-slider-img/Screenshot (310).png" alt="slider img" class="section-4-slider-img">
                                </div>
                            </div>
                        </div>
                    </div></div></div></div>
        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev">
                <span class="fa fa-angle-left"></span>
            </button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"></span></button>
        </div>

        </button><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot">

        </button>
    </div>
</div>
</div>


<!--END NEWA-->

<!-- Start footer -->
<footer class="mt-5">
    <div class="go-top">
        <p class="text-center text-white m-0">Back to top</p>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="footer-items-container">
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <div class="text-white">
                            <h5>Lorem, ipsum dolor</h5>
                            <ul class="p-0">
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="text-white">
                            <h5>Lorem, ipsum dolor</h5>
                            <ul class="p-0">
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="text-white">
                            <h5>Lorem, ipsum dolor</h5>
                            <ul class="p-0">
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="text-white">
                            <h5>Lorem, ipsum dolor</h5>
                            <ul class="p-0">
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                                <li><a href="#">Lorem, ipsum dolor.</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <hr style="color: white;"> -->
    </div>

</footer>
<!-- End footer -->
    <!--Footer End-->
</div>
<script>
    setInterval(function() {
        jQuery(function() {
            jQuery('#nexttt').click();
        });
    }, 8000)
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="/frontend/scripts/Jquery.min.js"></script>
<script src="/frontend/scripts/nav-bar.js"></script>
<script src="/frontend/scripts/owl.carousel.min.js"></script>
<script src="/frontend/scripts/section-1-slider.js"></script>
<script src="/frontend/scripts/section-4-slider.js"></script>
<script src="/frontend/scripts/section-7-slider.js"></script>

<script src="/frontend/scripts/download-box.js"></script>
<script src="/frontend/scripts/head-video.js"></script>
<script src="/frontend/scripts/modal-video.js"></script>
@yield('script')

<!-- JS Part End-->
</body>
</html>
