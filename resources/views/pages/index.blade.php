@extends('layouts.app')

@section('content')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.min.css">
@stop

<section class="slider-area home-4">

    @if ((Session::has('defaultGirlPackageExpired') && $defaultPackageExpired) 
    || (Session::has('gotmPackageExpired') && $gotmPackageExpired))
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Expiry Notifications</h4>
                </div>
                <div class="modal-body">
                    @if($defaultPackageExpired)
                    <p>{{ $defaultPackageExpired->note }}</p>
                    @endif
                    @if($gotmPackageExpired)
                    <p>{{ $gotmPackageExpired->note }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bend niceties preview-1 ho_4">
                    <div id="ensign-nivoslider" class="slides">
                        <img src="/img/sliders/S-7.jpg" alt="" title="#slider-direction-1"  />
                        <img src="/img/sliders/S-8.jpg" alt="" title="#slider-direction-2"  />
                    </div>
                    <div id="slider-direction-1" class="t-cn slider-direction slider-one">
                        <div class="slider-progress"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <div class="fas7-slider-content">
                                        <div class="layer-1-1">
                                            <h5 class="title1">This banner is</h5>
                                        </div>
                                        <div class="layer-1-2">
                                            <h2 class="title2">
                                                <span class="fashion-1"><span class="fas-for">1170x</span><span class="fas-man">390</span></span>
                                            </h2>
                                        </div>
                                        <div class="layer-1-3">
                                            <p class="title3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <br>eiusmod tempor incididunt ut labore et dolore magna aliqua.<br> Ut enim ad minim veniam, quis nostrud.</p>
                                        </div>
                                        <div class="layer-1-4">
                                            <a class="shop-n" href="/">shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="slider-direction-2" class="slider-direction slider-two">
                        <div class="slider-progress"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-left">
                                    <div class="fas8-slider-content">
                                        <div class="layer-2-1">
                                            <h5 class="title1">This one is also</h5>
                                        </div>
                                        <div class="layer-2-2">
                                            <h2 class="title2">
                                                <span class="fashion-1">1170x390</span>
                                            </h2>
                                        </div>
                                        <div class="layer-2-3">
                                            <p class="title3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do<br> eiusmod tempor incididunt ut labore et dolore magna aliqua.<br> Ut enim ad minim veniam, quis nostrud.</p>
                                        </div>
                                        <div class="layer-2-4">
                                            <a class="shop-n" href="/">go now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="banner-area home-4-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="height: 100%; margin-bottom: 30px;">
                <span class="search"><h3 style="font-size: 18px; color: #363636; font-weight: 800;">Quick Search</h3></span>
                <div class="containere">
                    <form>
                        <div class="checkbox-tile-group">
                            <div class="input-container">
                                <input class="checkbox-button" type="checkbox" name="checkbox" />
                                <div class="checkbox-tile">
                                    <i class="fa fa-mars fa-2x"></i>
                                    <label for="male" class="checkbox-tile-label">Male</label>
                                </div>
                            </div>
                            <div class="input-container">
                                <input class="checkbox-button" type="checkbox" name="checkbox" />
                                <div class="checkbox-tile">
                                    <i class="fa fa-venus fa-2x"></i>
                                    <label for="female" class="checkbox-tile-label">Female</label>
                                </div>
                            </div>
                            <div class="input-container">
                                <input class="checkbox-button" type="checkbox" name="checkbox" />
                                <div class="checkbox-tile">
                                    <i class="fa fa-transgender fa-2x"></i>
                                    <label for="mix" class="checkbox-tile-label">Mix</label>
                                </div>
                            </div>
                            <div class="input-container">
                                <input class="checkbox-button" type="checkbox" name="checkbox" />
                                <div class="checkbox-tile">
                                    <i class="fa fa-home fa-2x"></i>
                                    <label for="local" class="checkbox-tile-label">Local</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="containere1">
                    <div class="region">
                        <input list="links" placeholder="Kanton" />
                        <datalist id="links">
                            <option>Waadt</option>
                            <option>Genf</option>
                            <option>Freiburg</option>
                            <option>Bern</option>
                            <option>Wallis</option>
                            <option>Neuenburg</option>
                            <option>Jura</option>
                            <option>Solothurn</option>
                            <option>Basel-Landschaft</option>
                            <option>Basel-Stadt</option>
                            <option>Aargau</option>
                            <option>Luzern</option>
                            <option>Obwalden</option>
                            <option>Nidwalden</option>
                            <option>Zug</option>
                            <option>Uri</option>
                            <option>Schwyz</option>
                            <option>Tessin</option>
                            <option>Graubünden</option>
                            <option>IT</option>
                            <option>St. Gallen</option>
                            <option>Zürich</option>
                            <option>Schaffhausen</option>
                            <option>Büsingen</option>
                            <option>Thurgau</option>
                            <option>Glarus</option>
                            <option>Appenzell Ausserrhoden</option>
                            <option>Appenzell Innerrhoden</option>
                            <option>Fürstentum Liechtenstein</option>
                        </datalist>
                    </div>
                    <div class="region">
                        <input list="cities" placeholder="Ort" />
                        <datalist id="cities">
                        </datalist>
                    </div>
                </div>
                <div style="width: 101%; text-align: center"><button class="button1 button2" onclick="getLocation()">Geolocalization</button></div>
                <div style="width: 101%; text-align: center; margin-top: 14px;"><button class="button3 button4">Submit</button></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="single-banner home-3">
                    <a class="last-banner" href="/#"><span><img src="/img/banner/banner-13.jpg" alt="" /></span></a>
                </div>
            </div>
        </div>
    </div>
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section-heading pro-title blog-margin">
                        <h3>Girls Of The Month</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="featured-product-carousel single-indicator">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img"><img class="primary-img" src="/img/girls/1.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/2.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/3.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/4.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/5.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/6.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/7.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a class="a-img" href="/#"><img class="primary-img" src="/img/girls/8.jpg" alt="" />
                                </a>
                                <div class="product-action">
                                    <div class="pro-rating">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="product-content">
                                <a class="shop-name">Girls Name</a>
                                <div class="pro-price">
                                    <p>short info</p>
                                </div>
                                <a href="/profile/girl"><div class="product-cart">
                                    <button class="button">View Profile</button>
                                </div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="banner-area-2 home-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="single-banner">
                        <a class="last-banner" href="">
                            <span>
                                <img src="/img/banner/fullwide-banner-4.jpg" alt="">
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop

    @section('perPageScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.all.min.js"></script>
    @if(Session::has('not_approved'))
    <script>
        swal(
            'Oops...',
            '{{ Session::get('not_approved') }}',
            'error'
        );
    </script>
    @endif
    @if(Session::has('success'))
    <script>
        swal(
            'Good job!',
            '{{ Session::get('success') }}',
            'success'
        );
    </script>
    @endif
    <script>
        $(function () {
            var modal = $('#myModal');
            if (modal[0]) {
                console.log('sadsa');
                $(window).on('load', function () {
                    modal.modal('show');
                });
            }
        });
    </script>
    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
        }
    </script>
    @stop