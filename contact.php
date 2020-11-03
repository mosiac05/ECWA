<?php
	include './classes/contact.php';

	$contact->insert();

	$banner_query = $banner->getFirst();
	$banner_data = mysqli_fetch_assoc($banner_query);
?>
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/banner_images/<?=$banner_data['image']; ?>);">
  <div class="container">
    <div class="row align-items-center justify-content-center site-hero-inner">
      <div class="col-md-8 text-center">

        <div class="mb-5 element-animate">
          <div class="block-17">
            <h1 class="heading mb-4">Contact Us.</h1>
            <div class="lead"><?=$banner_data['caption']; ?></div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>
<!-- END section -->


<section class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-8 pr-md-5">
        <form action="#" method="post">
              <div class="row">
                <div class="col-md-4 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control py-2" required="">
                </div>
                <div class="col-md-4 form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone_num" id="phone" class="form-control py-2" required="">
                </div>
                <div class="col-md-4 form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control py-2" required="">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="message">Write Message</label>
                  <textarea name="message" id="message" class="form-control py-2" required="" cols="30" rows="8"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" name="contact_insert" value="Send Message" class="btn btn-primary py-3 px-5">
                </div>
              </div>
            </form>
      </div>
      <div class="col-md-4">
        
        <div class="block-23">
          <h3 class="heading mb-5">Contact Information</h3>
          <ul>
            <li><span class="icon ion-android-pin"></span><span class="text"><?=$about_us->getData('address'); ?></span></li>
            <li><a href="tel:/<?=$about_us->getData('phone_num'); ?>"><span class="icon ion-ios-telephone"></span><span class="text"><?=$about_us->getData('phone_num'); ?></span></a></li>
            <li><a href="mailto:/<?=$about_us->getData('email'); ?>"><span class="icon ion-android-mail"></span><span class="text"><?=$about_us->getData('email'); ?></span></a></li>
          </ul>
        </div>
      </div>
      
    </div>

  </div>
</section>
<!-- END section -->

<div id="map"></div>