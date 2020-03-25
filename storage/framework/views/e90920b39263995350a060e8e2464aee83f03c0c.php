<?php $__env->startSection('title',"Categories"); ?>

<?php $__env->startSection('content'); ?>
   <!--start of middle sec-->
  <div class="middle-sec wow fadeIn" data-wow-offset="10" data-wow-duration="2s">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase">products catalogue</h2>
        <p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
      </div>
    </div>
    <section class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="inner-ad">
            <figure><img class="img-responsive" src="images/inner-ad.jpg" width="1170" height="100" alt=""/></figure>
          </div>
        </div>
        <div class="col-sm-12 equal-height-container">
          <div class="row">
            <div class="col-sm-4 col-md-3 col-lg-3 sub-data-left sub-equal">
              <section>
                <h5 class="sub-title text-info text-uppercase ">categories</h5>
                <ul class="list-group nudge">
                  <li class="list-group-item"><a href="#">Cras justo odio</a></li>
                  <li class="list-group-item"><a href="#">Dapibus ac facilisis in</a><span class="label label-info pull-right">20% off</span></li>
                  <li class="list-group-item"><a href="#">Morbi leo risus</a></li>
                  <li class="list-group-item"><a href="#">Porta ac consectetur ac</a></li>
                  <li class="list-group-item"><a href="#">Vestibulum at eros</a></li>
                </ul>
              </section>
              <section>
                <h5 class="sub-title text-info text-uppercase">price range</h5>
                <span>$10</span>
                <input id="price-slider" type="text" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[10,500]"/>
                <span>$1000</span> </section>
              <section>
                <h5 class="sub-title text-info text-uppercase">preffered color</h5>
                <ul class="list-inline color">
                  <li><a class="color-1" href="#"></a></li>
                  <li><a class="color-2" href="#"></a></li>
                  <li><a class="color-3" href="#"></a></li>
                  <li><a class="color-4" href="#"></a></li>
                  <li><a class="color-5" href="#"></a></li>
                  <li><a class="color-6" href="#"></a></li>
                  <li><a class="color-7" href="#"></a></li>
                  <li><a class="color-8" href="#"></a></li>
                  <li><a class="color-9" href="#"></a></li>
                  <li><a class="color-10" href="#"></a></li>
                  <li><a class="color-11" href="#"></a></li>
                  <li><a class="color-12" href="#"></a></li>
                  <li><a class="color-13" href="#"></a></li>
                </ul>
              </section>
              <section>
                <h5 class="sub-title text-info text-uppercase">choose size</h5>
                <ul class="list-inline size text-uppercase">
                  <li><a href="#">s</a></li>
                  <li><a href="#">m</a></li>
                  <li><a href="#">l</a></li>
                  <li><a href="#">xl</a></li>
                  <li><a href="#">xxl</a></li>
                  <li><a href="#">slimfit</a></li>
                  <li><a href="#">onesize</a></li>
                </ul>
              </section>
              <section>
                <h5 class="sub-title text-info text-uppercase">Manufacturer</h5>
                <ul class="list-group nudge">
                  <li class="list-group-item"><a href="#">Zara</a> <span class="pull-right">(22)</span></li>
                  <li class="list-group-item"><a href="#">H&amp;M</a> <span class="pull-right">(10)</span></li>
                  <li class="list-group-item"><a href="#">Christopher Kane</a> <span class="pull-right">(19)</span></li>
                  <li class="list-group-item"><a href="#">Christian Dior</a> <span class="pull-right">(31)</span></li>
                </ul>
              </section>
              <section> <img class="img-responsive" src="images/banner4.jpg" width="820" height="703" alt=""/> </section>
              <section class="col-sm-12 tags">
                <h5 class="sub-title text-info text-uppercase">popular tags</h5>
                <a href="#">travel</a> <a href="#">blog</a> <a href="#">lifestyle</a> <a href="#">feature</a> <a href="#">mountain</a> <a href="#">design</a> <a href="#">restaurant</a> <a href="#">journey</a> <a href="#">classic</a> <a href="#">sunset</a> </section>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-9 main-sec">
              <div class="row"> 
                
                <!--start of breadcrumb-->
                <div class="col-sm-12">
                  <ol class="breadcrumb dashed-border">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Men</a></li>
                    <li class="active">Products Catalogue</li>
                  </ol>
                </div>
                <!--end of breadcrumb--> 
                
                <!--start of display settings-->
                
                <div class="col-sm-12">
                  <div class="dashed-border ">
                    <ul class="list-inline view-style top-menu row">
                      <li class="col-sm-3 col-md-2">
                        <select class="selectpicker">
                          <option>Sort By</option>
                          <option>Position</option>
                          <option>Name</option>
                          <option>Price</option>
                        </select>
                      </li>
                      <li  class="col-sm-3 col-md-2">
                        <select class="selectpicker">
                          <option>Show</option>
                          <option>9</option>
                          <option>12</option>
                          <option>15</option>
                        </select>
                      </li>
                      <li class="text-right col-sm-6 col-md-8">
                        <div class="btn-group">
                          <button id="grid" class="btn btn-primary hvr-underline-from-center-primary" > <span class="ion-android-apps"></span> </button>
                          <button id="list" class="btn btn-primary hvr-underline-from-center-primary" > <span class="ion-android-menu"></span> </button>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <!--end of display settings-->
                
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="products" class="row"> 
                        <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240"  alt=""/> <img class="top-img" src="images/product-1.jpg" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                            <p class="group inner list-group-item-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container--> 
                        
                        <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240"  alt=""/> <img class="top-img" src="images/product-2.jpg" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                            <p class="group inner list-group-item-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container--> 
                        
                        <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240"  alt=""/> <img class="top-img" src="images/product-3.jpg" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                            <p class="group inner list-group-item-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container--> 
                        
                        <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240"  alt=""/> <img class="top-img" src="images/product-4.jpg" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                            <p class="group inner list-group-item-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container--> 
                        
                        <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240"  alt=""/> <img class="top-img" src="images/product-5.jpg" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                            <p class="group inner list-group-item-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container--> 
                        
                        <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240"  alt=""/> <img class="top-img" src="images/product-6.jpg" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                            <p class="group inner list-group-item-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container--> 
                        
                        <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240"  alt=""/> <img class="top-img" src="images/product-7.jpg" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                            <p class="group inner list-group-item-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container--> 
                        
                        <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240"  alt=""/> <img class="top-img" src="images/product-8.jpg" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                            <p class="group inner list-group-item-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container--> 
                        
                        <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="#"><img class="btm-img" src="images/product-1-h.jpg" width="215" height="240"  alt=""/> <img class="top-img" src="images/product-3.jpg" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="#" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                              <p class="effect-icon"> <a data-toggle="modal" data-target="#quick-view-box" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a></p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="product-details.html">Draped-front wool cardigan</a></h3>
                            <p class="group inner list-group-item-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                              Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <div class="product-price"><span class="real-price text-info"><strong>$75.00</strong></span> <span class="old-price">$75.00</span> </div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container--> 
                        
                      </div>
                    </div>
                    <!--start of pagination-->
                    <div class="col-sm-12">
                      <nav role="navigation">
                        <ul class="cd-pagination">
                          <li class="button"><a href="#0">Prev</a> </li>
                          <li><a href="#0">1</a> </li>
                          <li><a href="#0">2</a> </li>
                          <li><a href="#0" class="current">3</a> </li>
                          <li><a href="#0">4</a> </li>
                          <li><span>...</span> </li>
                          <li><a href="#0">20</a> </li>
                          <li class="button"><a href="#0">Next</a></li>
                        </ul>
                      </nav>
                    </div>
                    <!--end of pagination--> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--end of middle sec--> 
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/shop.blade.php ENDPATH**/ ?>