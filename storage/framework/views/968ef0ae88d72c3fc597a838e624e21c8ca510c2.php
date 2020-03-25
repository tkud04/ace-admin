<?php $__env->startSection('title',"Cart"); ?>

<?php $__env->startSection('content'); ?>
   <!--start of middle sec-->
<div class="middle-sec wow fadeIn animated animated" data-wow-offset="10" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s;">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase">checkout</h2>
        <p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
      </div>
    </div>
    <section class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="inner-ad">
            <figure><img class="img-responsive" src="images/inner-ad.jpg" width="1170" height="100" alt=""></figure>
          </div>
        </div>
        <div class="col-sm-12 equal-height-container">
          <div class="row">
            <div class="col-sm-4 col-md-3 sub-data-left sub-equal">
              <div id="sticky">
                <section class="col-sm-12">
                  <h5 class="sub-title text-info text-uppercase">order summary</h5>
                  <ul class="list-group summary">
                    <li class="list-group-item text-uppercase"><strong>items:<span class="pull-right"> 4</span></strong></li>
                    <li class="list-group-item text-uppercase"><strong>subtotal:<span class="pull-right"> $8.99</span></strong></li>
                    <li class="list-group-item text-uppercase"><strong>taxes (5%): <span class="pull-right">$0.45</span></strong></li>
                    <li class="list-group-item text-uppercase"><strong>shipping: <span class="pull-right">$5</span></strong></li>
                  </ul>
                </section>
                <section class="col-sm-12">
                  <h5 class="sub-title text-info text-uppercase">total price</h5>
                  <div class=" summary sum js-total text-center"> <strong> $114.44</strong> </div>
                  <button class="btn btn-block btn-default hvr-underline-from-center-default"><i class="rm-icon ion-arrow-return-left"></i> return to cart</button>
                </section>
              </div>
            </div>
            <div class="col-sm-8 col-md-9 sub-data-left main-sec">
              <div class="row"> 
                
                <!--start of breadcrumb-->
                <div class="col-sm-12">
                  <ol class="breadcrumb dashed-border row">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">shopping cart</a></li>
                    <li class="active">checkout</li>
                  </ol>
                </div>
                <!--end of breadcrumb--> 
                
                <!--start of checkout-->
                <div class="col-sm-12">
                  <form role="form">
                    <div class="row"> 
                      
                      <!-- START Presonal information -->
                      <fieldset class="col-md-6">
                        <legend>Personal information</legend>
                        
                        <!-- Name -->
                        <div class="form-group">
                          <label class="control-label" for="name">Name</label>
                          <input type="text" id="name" class="form-control">
                        </div>
                        
                        <!-- Address -->
                        <div class="form-group">
                          <label class="control-label" for="address">Billing address</label>
                          <input type="text" id="address" class="form-control">
                        </div>
                        
                        <!-- Country and state -->
                        <div class="row">
                          <div class="col-sm-6 form-group">
                            <label class="control-label" for="country">Country</label>
                            <select class="selectpicker" id="country" style="display: none;">
                              <option>My Country-1</option>
                              <option>My Country-2</option>
                              <option>My Country-3</option>
                              <option>My Country-4</option>
                              <option>My Country-5</option>
                            </select><div class="btn-group bootstrap-select"><button type="button" class="btn dropdown-toggle selectpicker btn-select" data-toggle="dropdown" data-id="country" title="My Country-1"><span class="filter-option pull-left">My Country-1</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><ul class="dropdown-menu inner selectpicker" role="menu"><li rel="0" class="selected"><a tabindex="0" class="" style=""><span class="text">My Country-1</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="1"><a tabindex="0" class="" style=""><span class="text">My Country-2</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="2"><a tabindex="0" class="" style=""><span class="text">My Country-3</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="3"><a tabindex="0" class="" style=""><span class="text">My Country-4</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="4"><a tabindex="0" class="" style=""><span class="text">My Country-5</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li></ul></div></div>
                          </div>
                          <div class="col-sm-6 form-group">
                            <label class="control-label" for="state">State</label>
                            <select class="selectpicker" id="state" style="display: none;">
                              <option>My State-1</option>
                              <option>My State-2</option>
                              <option>My State-3</option>
                              <option>My State-4</option>
                              <option>My State-5</option>
                            </select><div class="btn-group bootstrap-select"><button type="button" class="btn dropdown-toggle selectpicker btn-select" data-toggle="dropdown" data-id="state" title="My State-1"><span class="filter-option pull-left">My State-1</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><ul class="dropdown-menu inner selectpicker" role="menu"><li rel="0" class="selected"><a tabindex="0" class="" style=""><span class="text">My State-1</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="1"><a tabindex="0" class="" style=""><span class="text">My State-2</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="2"><a tabindex="0" class="" style=""><span class="text">My State-3</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="3"><a tabindex="0" class="" style=""><span class="text">My State-4</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="4"><a tabindex="0" class="" style=""><span class="text">My State-5</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li></ul></div></div>
                          </div>
                        </div>
                        
                        <!-- City and Zip code -->
                        <div class="row">
                          <div class="col-sm-6 form-group">
                            <label class="control-label" for="city">City</label>
                            <select class="selectpicker" id="city" style="display: none;">
                              <option>My City-1</option>
                              <option>My City-2</option>
                              <option>My City-3</option>
                              <option>My City-4</option>
                              <option>My City-5</option>
                            </select><div class="btn-group bootstrap-select"><button type="button" class="btn dropdown-toggle selectpicker btn-select" data-toggle="dropdown" data-id="city" title="My City-1"><span class="filter-option pull-left">My City-1</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><ul class="dropdown-menu inner selectpicker" role="menu"><li rel="0" class="selected"><a tabindex="0" class="" style=""><span class="text">My City-1</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="1"><a tabindex="0" class="" style=""><span class="text">My City-2</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="2"><a tabindex="0" class="" style=""><span class="text">My City-3</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="3"><a tabindex="0" class="" style=""><span class="text">My City-4</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="4"><a tabindex="0" class="" style=""><span class="text">My City-5</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li></ul></div></div>
                          </div>
                          <div class="col-sm-6 form-group">
                            <label class="control-label" for="zipcode">Zip Code</label>
                            <input type="text" id="zipcode" class="form-control">
                          </div>
                        </div>
                      </fieldset>
                      <!-- END Personal information--> 
                      
                      <!-- START Payment infromation -->
                      <fieldset class="col-md-6">
                        <legend>Payment information</legend>
                        
                        <!-- Name -->
                        <div class="form-group">
                          <label class="control-label" for="name-card">Name on card</label>
                          <input type="text" id="name-card" class="form-control">
                        </div>
                        
                        <!-- Card type -->
                        <div class="form-group">
                          <label class="control-label" for="card">Card Type</label>
                          <select class="selectpicker" id="card" style="display: none;">
                            <option>MasterCard</option>
                            <option>Visa</option>
                            <option>Other</option>
                          </select><div class="btn-group bootstrap-select"><button type="button" class="btn dropdown-toggle selectpicker btn-select" data-toggle="dropdown" data-id="card" title="MasterCard"><span class="filter-option pull-left">MasterCard</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><ul class="dropdown-menu inner selectpicker" role="menu"><li rel="0" class="selected"><a tabindex="0" class="" style=""><span class="text">MasterCard</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="1"><a tabindex="0" class="" style=""><span class="text">Visa</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="2"><a tabindex="0" class="" style=""><span class="text">Other</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li></ul></div></div>
                        </div>
                        
                        <!-- Card number -->
                        <div class="form-group">
                          <label class="control-label" for="card-number">Card number</label>
                          <input type="text" id="card-number" class="form-control">
                        </div>
                        
                        <!-- Expriation and CCV -->
                        <div class="row">
                          <div class="col-sm-5 form-group">
                            <label class="control-label" for="month">Month</label>
                            <select class="selectpicker" id="month" style="display: none;">
                              <option>January</option>
                              <option>February</option>
                              <option>March</option>
                              <option>April</option>
                              <option>May</option>
                            </select><div class="btn-group bootstrap-select"><button type="button" class="btn dropdown-toggle selectpicker btn-select" data-toggle="dropdown" data-id="month" title="January"><span class="filter-option pull-left">January</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><ul class="dropdown-menu inner selectpicker" role="menu"><li rel="0" class="selected"><a tabindex="0" class="" style=""><span class="text">January</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="1"><a tabindex="0" class="" style=""><span class="text">February</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="2"><a tabindex="0" class="" style=""><span class="text">March</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="3"><a tabindex="0" class="" style=""><span class="text">April</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="4"><a tabindex="0" class="" style=""><span class="text">May</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li></ul></div></div>
                          </div>
                          <div class="col-sm-4 form-group">
                            <label class="control-label" for="year">Year</label>
                            <select class="selectpicker" id="year" style="display: none;">
                              <option>2015</option>
                              <option>2016</option>
                              <option>2017</option>
                              <option>2018</option>
                              <option>2019</option>
                              <option>2020</option>
                            </select><div class="btn-group bootstrap-select"><button type="button" class="btn dropdown-toggle selectpicker btn-select" data-toggle="dropdown" data-id="year" title="2015"><span class="filter-option pull-left">2015</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><ul class="dropdown-menu inner selectpicker" role="menu"><li rel="0" class="selected"><a tabindex="0" class="" style=""><span class="text">2015</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="1"><a tabindex="0" class="" style=""><span class="text">2016</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="2"><a tabindex="0" class="" style=""><span class="text">2017</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="3"><a tabindex="0" class="" style=""><span class="text">2018</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="4"><a tabindex="0" class="" style=""><span class="text">2019</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li><li rel="5"><a tabindex="0" class="" style=""><span class="text">2020</span><i class="glyphicon glyphicon-ok icon-ok check-mark"></i></a></li></ul></div></div>
                          </div>
                          <div class="col-sm-3 form-group">
                            <label class="control-label" for="ccv">CCV <i title="" data-placement="top" data-toggle="tooltip" class="fa fa-question-circle help-icon" data-original-title="This number is printed on your cards in the signature area of the back of the card."></i></label>
                            <input type="text" maxlength="3" id="ccv" class="form-control">
                          </div>
                        </div>
                      </fieldset>
                      <!-- END Payment information--> 
                    </div>
                    
                    <!-- Agree checkbox and Continue button -->
                    <div class="row">
                      <div class="col-sm-12">
                        <fieldset>
                          <legend>order notes</legend>
                          <textarea class="form-control" rows="5" cols="40" name="comment[body]" id="comment-body" required=""></textarea><span class="help-block">350/350</span>
                          <hr>
                        </fieldset>
                      </div>
                      <div class="col-sm-6">
                        <div class="checkbox small">
                          <input type="checkbox" id="terms" value="option1" name="logincheckbox">
                          <label for="terms">Do you agree to the <a href="#">terms and conditions?</a></label>
                        </div>
                      </div>
                      <div class="col-sm-6 text-right">
                        <button class="btn btn-primary hvr-underline-from-center-primary " type="button">complete checkout</button>
                      </div>
                    </div>
                  </form>
                </div>
                
                <!--end of checkout--> 
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--end of middle sec--> 
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/checkout.blade.php ENDPATH**/ ?>