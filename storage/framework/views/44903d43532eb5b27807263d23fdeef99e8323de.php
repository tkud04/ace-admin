<?php $__env->startSection('title',"Contact Us"); ?>

<?php $__env->startSection('content'); ?>
   <!--start of middle sec-->
<div class="middle-sec wow fadeIn animated animated" data-wow-offset="10" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s;">
    <div class="page-header">
          <div class="container text-center">
        <h2 class="text-primary text-uppercase">contact us</h2>
        <p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
      </div>
        </div>
    <section class="container equal-height-container">
          <div class="row">
        <div class="col-sm-12">
              <div id="map-canvas" class="inner-ad">Google map</div>
            </div>
        <div class="col-sm-12">
              <div class="row">
            <div class="col-sm-8 col-md-9 main-sec">
                  <div class="row">
                <div class="col-sm-12">
                      <ol class="breadcrumb  dashed-border">
                    <li><a href="#">Home</a></li>
                    <li class="active">Contact us</li>
                  </ol>
                    </div>
                <div class="col-sm-12">
                      <form method="post" id="contact-form" action="#" accept-charset="UTF-8">
                    <fieldset>
                          <legend>conact us</legend>
                        </fieldset>
                    <ul class="row list-unstyled">
                          <li class="col-md-12">
                        <label class="control-label" for="comment-author">Your name <span class="req">*</span></label>
                        <input type="text" class="form-control" value="" name="comment[author]" id="comment-author" required="">
                      </li>
                          <li class="col-md-12">
                        <label class="control-label" for="comment-email">Your email <span class="req">*</span></label>
                        <input type="email" class="form-control" value="" name="comment[email]" id="comment-email" required="">
                      </li>
                          <li class="col-md-12">
                        <label class="control-label" for="comment-body">Your message <span class="req">*</span></label>
                        <textarea class="form-control" rows="5" cols="40" name="comment[body]" id="comment-body" required=""></textarea><span class="help-block">350/350</span>
                      </li>
                          <li class="col-sm-12">
                        <p id="allowed-tags" class="allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: <code>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt; </code></p>
                      </li>
                          <li class="col-md-12">
                        <button class="btn btn-primary  hvr-underline-from-center-primary" id="comment-submit" type="submit">Send Message</button>
                      </li>
                        </ul>
                  </form>
                    </div>
              </div>
                </div>
            <div class="col-sm-4 col-md-3 sub-data-right sub-equal">
                  <div class="row">
                <section class="col-sm-12">
                      <h5 class="sub-title text-info text-uppercase">Customer care</h5>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit<br>
                    <span class="small"> <span class="text-info text-capitalize"> <strong>Phone number</strong> :</span><br>
                        +00 123 456 78<br>
                        <span class="text-info text-capitalize"> <strong>Email us</strong> :</span><br>
                        care@royalmarket.com</span></p>
                    </section>
                <section class="col-sm-12">
                      <h5 class="sub-title text-info text-uppercase">Feedback</h5>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>
                    <span class="small"> <span class="text-info text-capitalize"> <strong>Email us</strong> :</span><br>
                        feedback@royalmarket.com</span></p>
                    </section>
                <section class="col-sm-12">
                      <h5 class="sub-title text-info text-uppercase">Complaint</h5>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit<br>
                    <span class="small"> <span class="text-info text-capitalize"> <strong>Phone number</strong> :</span><br>
                        +00 321 456 89<br>
                        <span class="text-info text-capitalize"> <strong>Email us</strong> :</span><br>
                        complain@royalmarket.com</span></p>
                    </section>
                <section class="col-sm-12">
                      <h5 class="sub-title text-info text-uppercase">Other Enquiries</h5>
                      <p> <span class="small"> <span class="text-info text-capitalize"> <strong>Corporate Sales </strong>: </span><br>
                        sales@royalmarket.com<br>
                        <span class="text-info text-capitalize"> <strong>Careers </strong> :</span><br>
                        careers@royalmarket.com<br>
                        <span class="text-info text-capitalize"><strong>Press Relations </strong> :</span><br>
                        press@royalmarket.com<br>
                        </span> </p>
                    </section>
              </div>
                </div>
          </div>
            </div>
      </div>
        </section>
  </div>
  <!--end of middle sec--> 
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\ace\resources\views/contact.blade.php ENDPATH**/ ?>