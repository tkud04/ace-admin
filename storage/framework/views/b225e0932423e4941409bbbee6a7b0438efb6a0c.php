
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $__env->yieldContent('title'); ?> | Ace Luxury Store - Online Luxury Fashion Accessories Store in Lagos, Nigeria</title>
<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<!-- Ionicons font -->
<link href="css/ionicons.min.css" rel="stylesheet">
<!-- Bootstrap styles-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--custom styles-->
<link href="css/custom.css" rel="stylesheet" />
<link href="css/custom-pink.css" rel="stylesheet" />
<link href="css/custom-turquoise.css" rel="stylesheet" />
<link href="css/custom-purple.css" rel="stylesheet" />
<link href="css/custom-orange.css" rel="stylesheet" />
<link href="css/custom-blue.css" rel="stylesheet" />
<link href="css/custom-green.css" rel="stylesheet" />
<link href="css/custom-red.css" rel="stylesheet" />
<link href="css/custom-gold.css" rel="stylesheet" id="style">
<!--tooltiop-->
<link href="css/hint.css" rel="stylesheet">
<!-- animation -->
<link href="css/animate.css" rel="stylesheet" />
<!--select-->
<link href="css/bootstrap-select.min.css" rel="stylesheet">
<!--color picker-->
<link href="css/jquery.simplecolorpicker.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<!-- favicon -->
<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-touch-icon-60x60.png">
<link rel="icon" type="image/png" href="favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="favicon/favicon-16x16.png" sizes="16x16">

<style type="text/css">
.overlay-effect {
 width: 100%;
 height: 100%;
  position: absolute;
  top: 0;
  bottom: 0;
  z-index: 1000;
  left: 0;
  right: 0;
  opacity: 1;
  transition: .5s ease;
  background-color: rgba(0, 0, 0, 0.7);
  overflow:hidden;
}

#banner {
	
}

</style>
<?php echo $__env->yieldContent('styles'); ?>
<!--jQuery--> 
<script src="js/jquery.min.js"></script> 
<!--SweetAlert--> 
<script src="lib/sweet-alert/all.js"></script>
</head>
<body>
<!--start of loader-->
<div id="preloader">
  <div id="status"></div>
</div>
<!--end of loader-->

<!--start of top sec-->
<div class="top-sec">
  <nav class="navbar navbar-static-top line-navbar-one">
    <div class="container">
      <div class="navbar-header"> 
        <!-- Top navbar button -->
        <button type="button" class="navbar-toggle collapsed ion-android-menu" data-toggle="collapse" data-target="#line-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="fa fa-ellipsis-v"></span> </button>
        <!-- Cart button --> 
        <a class="lno-cart" href="#"> <span class="glyphicon glyphicon-shopping-cart"></span> <span class="cart-item-quantity"></span> </a> 
        <!-- left navbar button -->
        <button class="lno-btn-toggle"> <span class="fa fa-bars"></span> </button>
      </div>
      <div class="row">
	  <?php
       $welcomeText = (is_null($user)) ? "Welcome to our online store!" : "Welcome back, ".$user->fname."!";	  
	  ?>
        <div class="col-sm-4 welcome-msg hidden-xs"><?php echo e($welcomeText); ?></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="col-sm-8 collapse navbar-collapse navbar-right" id="line-navbar-collapse-1">
          <ul class="nav navbar-nav top-menu">
		   <?php
			$cc = (isset($cart)) ? count($cart) : 0;
		   ?>
            <li class="dropdown lnt-shopping-cart visible-lg visible-md"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="ion-bag bag-icn"></span> <span class="cart-item-quantity badge cart-badge"><?php echo e($cc); ?></span> </a>
              <ul role="menu" class="dropdown-menu">
                <li>
                  <div class="lnt-cart-products text-success"><i class="ion-android-checkmark-circle icon"></i> 0 products added. <span class="lnt-cart-total">&#8356;0.00</span> </div>
                </li>
               
                <li class="lnt-cart-actions text-center"> <a class="btn btn-default btn-lg hvr-underline-from-center-default" href="<?php echo e(url('cart')); ?>">View cart</a> <a class="btn btn-primary hvr-underline-from-center-primary" href="<?php echo e(url('checkout')); ?>">Checkout</a> </li>
              </ul>
            </li>
           <?php if(is_null($user)): ?>
            <li><a class="login" href="javascript:void(0)" data-toggle="modal" data-target="#login-box"> login</a></li>
            <li><a href="<?php echo e(url('register')); ?>">Register</a></li>
		   <?php else: ?>
            <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
            <li><a href="<?php echo e(url('signout')); ?>">Sign out</a></li>
		   <?php endif; ?>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">NGN <span class="ion-android-arrow-dropdown"></span></a>
              <ul class="dropdown-menu" role="menu">
      
              </ul>
            </li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img width="16" height="12" alt="" src="images/uk.png"> <span class="ion-android-arrow-dropdown"></span></a>
              <ul class="dropdown-menu">

              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-left lno-search-form visible-xs" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-xs btn-search"><span class="fa fa-search"></span></button>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <div class="line-navbar-left">
    <p class="lnl-nav-title">Categories</p>
    <ul class="lnl-nav">
      <!-- The list will be automatically cloned from mega menu via jQuery -->
    </ul>
  </div>
</div>
<!--end of top sec--> 

<!--start of content wrap (This is necessary for the menu effect)-->
<div class="content-wrap" data-effect="lnl-push"> 
  
  <!--start of header-->
  <header>
    <div class="container">
      <div class="row"> <!--start of logo-->
        <div class="col-sm-12 col-md-4 col-lg-3 "> <a href="<?php echo e(url('/')); ?>" class="navbar-brand"></a></div>
        <!--end of logo--> <!--start of features-->
        <div class="col-sm-12 col-md-8 col-lg-9 feature hidden-xs">
          <div class="row">
            <div class="col-sm-4 feature-box ion-chatbubble-working">
              <dl  class="text-primary text-capitalize">
                <dt>Online Support</dt>
                <dd class="text-muted">24/7 if you need any help</dd>
              </dl>
            </div>
            <div class="col-sm-4 feature-box ion-android-sync">
              <dl  class="text-primary text-capitalize">
                <dt>2 Days Free Return</dt>
                <dd class="text-muted">For defective products </dd>
              </dl>
            </div>
            <div class="col-sm-4 feature-box ion-lock-combination">
              <dl  class="text-primary text-capitalize">
                <dt>Secure Payment</dt>
                <dd class="text-muted">We don't store your details</dd>
              </dl>
            </div>
          </div>
        </div>
        <!--end of features--> 
      </div>
    </div>
  </header>
  <!--end of header--> 
  <?php
 
  $special = ['hot' => "rings", 'popular' => "earrings", 'trending' => "bracelets"];
  ?>
  <!-- strat of navigation -->
  <nav class="navbar navbar-default navbar-static-top line-navbar-two">
    <div class="container"> 
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="line-navbar-collapse-2">
        <ul class="nav navbar-nav lnt-nav-mega">
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="fa fa-dot-circle-o"></span> Categories <span class="ion-android-arrow-dropdown"></span> </a>
            <div class="dropdown-menu" role="menu">
              <div class="lnt-dropdown-mega-menu"> 
                <!-- List of categories -->
                <ul class="lnt-category list-unstyled">
				<?php
				 $i = 0;
				 foreach($c as $key => $value)
				 {
					 $cl = ($i == 0) ? ' class="active"' : '';
					 ++$i;
					 $spp = "";
					 if($special['hot'] == $key || $special['popular'] == $key || $special['trending'] == $key)
					 {
						 if($special['hot'] == $key) $spp = '<span class="label label-danger">Hot</span></a>';
						 if($special['popular'] == $key) $spp = '<span class="label label-info">Popular</span></a>';
						 if($special['trending'] == $key) $spp = '<span class="label label-primary">Trending</span></a>';
					 }
				?>
                  <li<?php echo e($cl); ?>><a href="#<?php echo e($key); ?>"><?php echo e(ucwords($key)); ?> <?php echo $spp; ?></a></li>
				<?php
				 }
				?>
                </ul>
                <!-- Subcategory and carousel wrap -->
                <div class="lnt-subcategroy-carousel-wrap container-fluid">
				<?php
				 $i = 0;
				 foreach($c as $key => $value)
				 {
					 $dl = ($i == 0) ? ' class="active"' : '';
					 ++$i;
			    ?>
                  <div id="<?php echo e($key); ?>"<?php echo e($dl); ?>> 
                    <!-- Sub categories list-->
                    <div class="lnt-subcategory col-sm-8 col-md-8">
                      <h3 class="lnt-category-name text-info text-uppercase"><?php echo e($key); ?></h3>
					 
                      <ul class="list-unstyled col-sm-6">
					  	<?php
				         for($x = 0; $x < 3; $x++)
				         {
							 $nn = $value[$x];
	                       $npp = "";
					       if($nn['special'] == 'hot' || $nn['special'] == 'popular' || $nn['special'] == 'trending')
					       {
						     if($nn['special'] == 'hot') $npp = "<span class='label label-danger'>Hot</span>";
						     if($nn['special'] == 'popular') $npp = "<span class='label label-info'>Popular</span>";
						     if($nn['special'] == 'trending') $npp = "<span class='label label-primary'>Trending</span>";
					       }
				         ?>
                        <li<?php echo e($cl); ?>><a href="#<?php echo e($nn['url']); ?>"><?php echo e($nn['name']); ?> <?php echo $npp; ?></a></li>
						<?php
						 }
						 ?>
                      </ul>
                      <ul class="list-unstyled col-sm-6">
                      <?php
				         for($x = 3; $x < 6; $x++)
				         {
							 $nn = $value[$x];
	                       $npp = "";
					       if($nn['special'] == 'hot' || $nn['special'] == 'popular' || $nn['special'] == 'trending')
					       {
						     if($nn['special'] == 'hot') $npp = '<span class="label label-danger">Hot</span>';
						     if($nn['special'] == 'popular') $npp = '<span class="label label-info">Popular</span>';
						     if($nn['special'] == 'trending') $npp = '<span class="label label-primary">Trending</span>';
					       }
				         ?>
                        <li<?php echo e($cl); ?>><a href="#<?php echo e($nn['url']); ?>"><?php echo e($nn['name']); ?> <?php echo $npp; ?></a></li>
						<?php
						 }
						 ?>
                      </ul>
                    </div>
                    <!-- Carousel -->
                    <div class="col-sm-4 col-md-4">
                      <div id="carousel-category-home" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carousel-category-home" data-slide-to="0" class=""></li>
                          <li data-target="#carousel-category-home" data-slide-to="1" class="active"></li>
                          <li data-target="#carousel-category-home" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                          <div class="item active"><img src="images/nav-img-1.jpg" width="296" height="400" alt="Slide image"/></div>
                          <div class="item"> <img src="images/nav-img-1.jpg" width="296" height="400" alt="Slide image"/> </div>
                          <div class="item"> <img src="images/nav-img-1.jpg" width="296" height="400" alt="Slide image"/> </div>
                        </div>
                      </div>
                    </div>
                  </div>
				  <?php
				   }
				  ?>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <ul class="nav navbar-nav main-nav">
          <li class="active"><a href="<?php echo e(url('/')); ?>" class="ion-ios-home"></a></li>
          <li><a href="#">NEW ARRIVALS</a></li>
          <li><a href="#">BEST SELLER</a></li>
          <li><span class="nav-span hot-sale">20% OFF</span><a href="#">hot sale</a></li>
          <li><a href="#">BLOG</a></li>
          <li><a href="<?php echo e(url('contact')); ?>">CONTACT</a></li>
        </ul>
        <ul class="nav navbar-nav visible-xs">
          <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
        </ul>
        <form class="navbar-form navbar-right lnt-search-form" action="<?php echo e(url('search')); ?>" role="search">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-btn lnt-search-category">
                <button type="button" class="btn btn-default dropdown-toggle selected-category-btn" data-toggle="dropdown" aria-expanded="false"> <span class="selected-category-text">All </span> <span class="ion-android-arrow-dropdown"></span> </button>
                <ul class="dropdown-menu " role="menu">
				<?php $__currentLoopData = $c; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><a href="#"><?php echo e(ucwords($key)); ?></a></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
                </ul>
              </div>
              <input type="text" class="form-control lnt-search-input" name="q" aria-label="Search" placeholder="Find Your Product">
            </div>
          </div>
          <div class="lnt-search-suggestion">
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Leader mask in <span class="text-info">entertainment</span></a></li>
              <li><a href="#">Plain leader bags in <span class="text-info">fashion</span></a></li>
              <li><a href="#">Black leader shoes in <span class="text-info">fashion</span></a></li>
              <li><a href="#">Covers in <span class="text-info">electronics</span></a></li>
              <li><a href="#">Leader overcoat in <span class="text-info">fashion</span></a></li>
              <li><a href="#">Hi motor in <span class="text-info">motors</span></a></li>
              <li><a href="#">Fake leader bag in <span class="text-info">Electronics</span></a></li>
              <li class="lnt-search-bottom-links">
                <ul class="list-inline">
                  <li><a href="#">All suggestions</a></li>
                  <li><a href="#">New products</a></li>
                  <li><a href="#">Popular products</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <button type="submit" class="btn btn-xs btn-search"><span class="ion-android-search"></span></button>
        </form>
      </div>
    </div>
  </nav>
  <!-- end of navigation --> 
  
   <!--------- Cookie consent-------------->
        	<?php echo $__env->make('cookie-consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <!--------- Session notifications-------------->
        	<?php
               $pop = ""; $val = "";
               
               if(isset($signals))
               {
                  foreach($signals['okays'] as $key => $value)
                  {
                    if(session()->has($key))
                    {
                  	$pop = $key; $val = session()->get($key);
                    }
                 }
              }
              
             ?> 

                 <?php if($pop != "" && $val != ""): ?>
                   <?php echo $__env->make('session-status',['pop' => $pop, 'val' => $val], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <?php endif; ?>
        	<!--------- Input errors -------------->
                    <?php if(count($errors) > 0): ?>
                          <?php echo $__env->make('input-errors', ['errors'=>$errors], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <?php endif; ?> 
  
  
 <?php echo $__env->yieldContent('content'); ?>
 

    
  </div>
  <!--end of middle sec--> 
  
  <!--start of btm sec-->
  <div class="btm-sec">
    <footer>
      <div class="footer-top wow fadeIn" data-wow-offset="10" data-wow-duration="2s">
        <div class="container">
          <div class="row">
            <div class="col-xs-8 col-sm-9">
              <h4><i class="ion-android-phone-portrait icon text-info"></i><span class="text-uppercase text-primary">Ace Luxury Store - Let's Glam You Up</span></h4>
            </div>
            <div class="col-xs-4 col-sm-3"> <a href="#" class="btn btn-default btn-block hvr-underline-from-center-default pull-right">Shop now</a> </div>
          </div>
        </div>
      </div>
      <div class="footer-middle wow fadeIn" data-wow-offset="40" data-wow-duration="2s">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <h5 class="text-info text-uppercase">useful pages</h5>
              <ul class="list-unstyled nudge">
                <li><a href="<?php echo e(url('about')); ?>">About us</a> </li>
                <li><a href="<?php echo e(url('terms')); ?>">Terms and conditions</a> </li>
                <li><a href="#">FAQ</a> </li>
                <li><a href="<?php echo e(url('contact')); ?>">Contact us</a> </li>
              </ul>
              <hr>
              <h5 class="text-info text-uppercase">User section</h5>
              <ul class="list-unstyled nudge">
                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#login-box">Sign in</a> </li>
                <li><a href="<?php echo e(url('register')); ?>">Create account</a> </li>
              </ul>
              <hr class="hidden-md hidden-lg hidden-sm">
            </div>
            <div class="col-md-3 col-sm-6">
              <h5 class="text-info text-uppercase">Categories</h5>
              <ul class="list-unstyled nudge">
			  <?php $__currentLoopData = $c; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="#"><?php echo e(ucwords($key)); ?></a> </li>
			  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="row">
                <div class="col-sm-12">
                  <h5 class="text-info text-uppercase">Get the news</h5>
                  <p class="text-muted">Subscribe for updates on our latest arrivals</p>
                  <form action="#" method="post" id="newsletter">
                    <div>
                      <input type="text" name="email" id="newsletter-mail" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Enter your email address" autocomplete="off">
                      <button type="submit" title="Subscribe" class="btn btn-primary pull-right"><span>Subscribe</span></button>
                    </div>
                  </form>
                  <hr>
                </div>
                <div class="col-sm-12">
                  <h5 class="text-info text-uppercase">Stay in touch</h5>
                  <ul class="list-inline social clearfix">
                    <li class="col-sm-4 facebook"><a href="#"> <span><i class="ion-social-facebook"></i></span>
                      <p>2598</p>
                      </a></li>
                    <li class="col-sm-4 twitter"><a href="#"> <span><i class=" ion-social-twitter"></i></span>
                      <p>4576</p>
                      </a></li>
                    <li class="col-sm-4 googleplus"><a href="#"> <span><i class=" ion-social-instagram"></i></span>
                      <p>1269</p>
                      </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-btm wow fadeIn" data-wow-offset="50" data-wow-duration="2s">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <p class="pull-left">&copy; <?php echo e(date("Y")); ?> Allrights reserved <a class="external" href="<?php echo e(url('/')); ?>">Ace Luxury</a>.</p>
              <p class="pull-right"><img class="img-responsive" src="images/payments.png" width="362" height="30" alt=""/></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
	<div class="whatsapp-btn">
	  <a href="javascript:void(0)" data-toggle="modal" data-target="#whatsapp-box" class="btn btn-sm btn-primary">Need help? <b>Chat with us</b></a>
	  <a href="javascript:void(0)" data-toggle="modal" data-target="#whatsapp-box">
	    <span><i class="ion-social-whatsapp"></i></span>
	  </a>
	</div>
  </div>
  <!--end of btm sec--> 
  
  <!--start of login box-->
  <div class="modal fade" id="login-box" tabindex="-1" role="dialog" aria-labelledby="loginboxLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-primary text-uppercase" id="loginboxLabel" >login your account</h4>
        </div>
        <div class="modal-body">
          <ul class="list-inline row">
            <li class="col-sm-4"> <a href="#" class="btn btn-block btn-facebook  " ><i class="ion-social-facebook"></i></a> </li>
            <li class="col-sm-4"> <a href="#" class="btn btn-block btn-twitter" ><i class="ion-social-twitter"></i></a></li>
            <li class="col-sm-4"> <a href="#" class="btn btn-block btn-google" ><i class="ion-social-google"></i></a></li>
          </ul>
          <hr>
          <form method="post" id="login-form" action="<?php echo e(url('login')); ?>" accept-charset="UTF-8">
		   <?php echo csrf_field(); ?>

            <div class=" form-group">
              <label class="control-label" for="login-name">Email address or phone number</label>
              <input type="text" class="form-control" value="" name="id" id="login-name" required>
            </div>
            <div class="form-group">
              <label class="control-label text-uppercase" for="login-password">Your password</label>
              <input type="password" class="form-control" value="" name="pass" id="login-password" required>
            </div>
            <div class="checkbox">
              <input type="checkbox" id="logincheckbox" value="option1" name="remember">
              <label for="logincheckbox"> Remember me </label>
            </div>
            <button class="btn btn-block btn-primary hvr-underline-from-center-primary" id="login-submit" type="submit">login</button>
          </form>
        </div>
        <div class="modal-footer">
          <p class="text-center"><small>Forget your password? <a href="#">We can help!</a></small></p>
        </div>
      </div>
    </div>
  </div>
  <!--end of login box--> 

  <!--start of whatsapp box-->
  <div class="whatsapp-box modal fade" id="whatsapp-box" tabindex="-1" role="dialog" aria-labelledby="loginboxLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="tw">&times;</span></button>
          <h4 class="modal-title tw text-uppercase" id="loginboxLabel" >start a conversation</h4>
		  <h6 class="tw">Click one any of numbers listed beow to chat on Whatsapp:</h6>
        </div>
        <div class="modal-body">
          <ul class="list-inline row">
            <li class="col-sm-12"> <a href="https://web.whatsapp.com/send?phone=2347054291601" target="_blank" class="btn btn-block " ><i class="ion-social-whatsapp"></i> Customer Support</a> </li>
          </ul>
        </div>
        <div class="modal-footer">
          <p class="text-center"><small>The team usually reply in a few minutes</small></p>
        </div>
      </div>
    </div>
  </div>
  <!--end of login box--> 
  
  <!--start of quick view box-->
  <div class="modal fade" id="quick-view-box" tabindex="-1" role="dialog" aria-labelledby="quickviewboxLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-primary text-uppercase" id="quickviewboxLabel">Draped-front wool cardigan</h4>
        </div>
        <div class="modal-body product-details">
          <div class="row">
            <div class="col-sm-7"> <img class="img-responsive" src="images/p-details-z-1.jpg" width="700" height="700"  alt=""/> </div>
            <div class="col-sm-5 sub-info">
              <div class="product-review">
                <p><span class="text-info"><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i><i class="ion-android-star-outline"></i></span> <span class="pull-right"><small>8 Reviews</small></span> </p>
              </div>
              <div class="product-description">
                <h5 class="text-primary text-uppercase">Quick Overview</h5>
                <p> At vero eos et accusamus et iusto odio quos dolores sint occaecati cupiditate non provident, similique sunt in culpa dignis simos</p>
              </div>
              <div class="product-availability in-stock">
                <p>Availability: <span class="text-info">In Stock</span></p>
              </div>
              <div class="product-price clearfix"> <span class="pull-left btn btn-primary"><strong>$365</strong></span> <span class="pull-left btn btn-link"><del>$400</del></span> </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <ul class="soc pull-left">
            <li><a class="soc-twitter" href="#"></a></li>
            <li><a class="soc-facebook" href="#"></a></li>
            <li><a class="soc-google" href="#"></a></li>
            <li><a class="soc-pinterest" href="#"></a></li>
            <li><a class="soc-linkedin" href="#"></a></li>
            <li><a class="soc-rss" href="#"></a></li>
            <li><a class="soc-whatsapp soc-icon-last" href="#"></a></li>
          </ul>
          <button class="btn btn-default hvr-underline-from-center-default">full details</button>
          <button type="button" class="btn btn-primary hvr-underline-from-center-primary" >add to cart</button>
        </div>
      </div>
    </div>
  </div>
  <!--end of quick view box--> 
  
</div>
<!--end of content wrap--> 

<!--Start of go to top--> 
<a href="#0" class="cd-top"></a> 
<!--end of go to top--> 

<!--start of js--> 


<!--custom js--> 
<script src="js/custom.js"></script> 
<!--style switcher--> 
<script src="js/style-switcher.js"></script> 
<!--switches--> 
<script src="js/switches.js"></script> 
<!--slick carousel--> 
<script src="js/slick.js"></script> 
<!--wow animation--> 
<script src="js/wow.min.js"></script> 
<!--Bootstrap js--> 
<script src="js/bootstrap.min.js"></script> 
<!--navigation js--> 
<script src="js/jquery.highlight.js"></script> 
<script src="js/jquery.touchSwipe.min.js"></script> 
<script src="js/line.js"></script> 
<!--scrollbar js--> 
<script src="js/nicescroll.js"></script> 
<script src="js/jquery.nicescroll.plus.js"></script> 
<!--countdown counter--> 
<script src="js/countdown.js"></script> 
<!--color picker--> 
<script src="js/jquery.simplecolorpicker.js"></script> 
<!--image zoom--> 
<script src="js/jquery.zoom.js"></script> 
<!--go to top--> 
<script src='js/to-top.js'></script> 
<!--product items counter--> 
<script src="js/jquery.charactercounter.js"></script> 
<!--select--> 
<script src="js/bootstrap-select.min.js"></script> 
<!--price range slider--> 
<script src="js/bootstrap-slider.js"></script> 
<!--animated particles--> 
<script src='js/jquery.particleground.js'></script> 
<!--masonry--> 
<script src="js/salvattore.js"></script> 
<!--tab collapse--> 
<script src="js/bootstrap-tabcollapse.js"></script> 

<?php echo $__env->yieldContent('scripts'); ?>
<!--end of js-->
</body>
</html><?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/layout.blade.php ENDPATH**/ ?>