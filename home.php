<?php
  include './classes/service.php';
	include './classes/bible_quote.php';

	$banner_query = $banner->getFirst();

	$banner_data = mysqli_fetch_assoc($banner_query);
 ?>
    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/banner_images/<?php echo $banner_data['image']; ?>);">
      <div class="container">
        <div class="row align-items-center justify-content-center site-hero-inner">
          <div class="col-md-8 text-center">
  
            <div class="mb-5 element-animate">
              <div class="block-17">
                <h1 class="heading mb-4"><?php echo $banner_data['caption']; ?></h1>
                <p><a href="index.php?about_us" class="btn btn-primary-white py-3 px-5">About Us</a> <a href="#" class="text-white ml-4"> <span class="ion-ios-location mr-2"></span> Visit Our Church</a></p>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="block-42 overlap">

      <div class="container">
        <div class="row">
          <div class="col-md-12 d-lg-flex">
              <?php 
              	$latest_query = $sermon->getLatest(1);

              	$latest_data = mysqli_fetch_assoc($latest_query);
               ?>
              <div class="block-42-text">
                <div class="block-42-label">Latest Sermon:</div>
                <div class="block-42-title mx-2"><a href="index.php?sermon_details=<?=$latest_data['id']; ?>"><strong><?=$latest_data['title']; ?></strong></a></div>
                <div class="block-42-meta">Posted on <?=date('l jS F\, Y', strtotime($latest_data['created_at'])); ?>, <strong><?=$user->getUserName($latest_data['user_id']); ?></strong> </div>
              </div>
              <div class="block-42-icons ml-auto">
                <a href="#" class="fa fa-video-camera pl-0"></a>
                <a href="#" class="fa fa-headphones"></a>
                <?php if (!empty($latest_data['link'])): ?>
	                <a href="<?=$latest_data['link']; ?>" target="_blank" class="fa fa-cloud-download"></a>
                <?php endif ?>
                <a href="index.php?sermon_details=<?=$latest_data['id']; ?>" class="fa fa-book"></a>
              </div>
             
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 order-md-2">
            <div class="block-16">
              <figure>
                <img src="images/about_us/<?=$about_us->getData('image'); ?>" alt="Image placeholder" class="img-fluid img-shadow">
                <a href="<?=$about_us->getData('video_link'); ?>" class="play-button popup-vimeo"><span class="ion-ios-play"></span></a>
              </figure>
            </div>
          </div>
          <div class="col-md-6 order-md-1">
            <div class="block-15">
              <div class="heading">
                <h2>Welcome To ECWA GoodNews Church</h2>
              </div>
              <div class="text mb-5">
              <p class="mb-4"><?=$about_us->getData('pastor_note'); ?></p>
              <p class="text-black">Church Pastor: <strong><?=$about_us->getData('pastor_name'); ?></strong></p>
              </div>              
            </div>
          </div>          
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="site-section pt-0">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-5">
            <div class="block-43">
              <div class="block-43-icon">
                <span class="icon-wrapper">
                  <span class="icon fa fa-book text-primary"></span>  
                </span>                
              </div>
              <div class="block-43-text">
                <h3 class="block-43-heading">Connect With God</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quibusdam nisi eos accusantium eligendi velit deleniti nihil ad deserunt rerum.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-5">
            <div class="block-43">
              <div class="block-43-icon">
                <span class="icon-wrapper">
                  <span class="icon fa fa-user text-primary"></span>  
                </span>
                
              </div>
              <div class="block-43-text">
                <h3 class="block-43-heading">Come As You Are</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quibusdam nisi eos accusantium eligendi velit deleniti nihil ad deserunt rerum.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-5">
            <div class="block-43">
              <div class="block-43-icon">
                <span class="icon-wrapper">
                  <span class="icon fa fa-heart text-primary"></span>  
                </span>
                
              </div>
              <div class="block-43-text">
                <h3 class="block-43-heading">Brotherly Love</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A quibusdam nisi eos accusantium eligendi velit deleniti nihil ad deserunt rerum.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2 class="heading">Church Services</h2>
            </div>
          </div>
        </div>
      </div>
      
      <div class="block-13">
        <div class="nonloop-block-13 owl-carousel">
        	<?php 
        		$service_query = $service->getAll();

        		while($service_data = mysqli_fetch_assoc($service_query)) {

        	 ?>
          <div class="item">
            <div class="block-20">
              <figure>
                <a href="#"><img src="images/service_images/<?=$service_data['image']; ?>" alt="<?=$service_data['image']; ?>" class="img-fluid"></a>
              </figure>
              <div class="text text-center">
                <h3 class="heading"><a href="#"><?=$service_data['heading']; ?></a></h3>
                <p><?=$service_data['text'] ?></p>
                <!-- <p><a href="#">Read More</a></p> -->
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-5">
            <div class="section-heading mb-5">
              <h2 class="heading">Latest Sermons</h2>
            </div>
            <?php 
            	$sermon_query = $sermon->getLatest(3);

            	while($sermon_data = mysqli_fetch_assoc($sermon_query)) {

             ?>
            <div class="block-44 d-flex mb-3">
              <div class="block-44-image"><img src="images/sermon_images/<?=$sermon_data['image']; ?>" alt="<?=$sermon_data['image']; ?>"></div>
              <div class="block-44-text">
                <h3 class="block-44-heading"><a href="index.php?sermon_details=<?=$sermon_data['id']; ?>"><?=$sermon_data['title']; ?></a></h3>
                <div class="block-44-meta">Posted on <?=date('l jS F\, Y', strtotime($sermon_data['created_at'])); ?>, by <?=$user->getUserName($sermon_data['user_id']); ?></div>
                <div class="block-44-icons">
                  <a href="#" class=""><span class="fa fa-video-camera"></span></a>
                  <a href="#" class=""><span class="fa fa-headphones"></span></a>
                  <a href="<?=$sermon_data['link']; ?>" class=""><span class="fa fa-cloud-download"></span></a>
                  <a href="index.php?sermon_details=<?=$sermon_data['id']; ?>" class=""><span class="fa fa-book"></span></a>
                </div>
              </div>
            </div>
          <?php } ?>
          </div>
          <div class="col-md-6 mb-5">
            
            <div class="section-heading mb-5">
              <h2 class="heading">Latest Events</h2>
            </div>
            <?php 
            	$event_query = $event->getLatest(2);

            	while($event_data = mysqli_fetch_assoc($event_query)) {

             ?>
            <div class="block-44 d-flex mb-3">
              <div class="block-44-image"><img src="images/event_images/<?=$event_data['image']; ?>" alt="<?=$event_data['image']; ?>"></div>
              <div class="block-44-text">
                <h3 class="block-44-heading"><a href="#"><?=$event_data['title']; ?></a></h3>
                <div class="block-44-meta mb-2"><i class="ion-android-calendar"></i> <?=date('l jS F\, Y g:iA', strtotime($event_data['date'])); ?></div>
                <p><?=substr($event_data['text'], 0, 120); ?></p>
                <p><a href="index.php?event_details=<?=$event_data['id']; ?>">Read More</a></p>
              </div>
            </div>
          <?php } ?>
         </div>
        </div>
      </div>
    </section>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading mb-5">
              <h2 class="heading">Today's Bible Quotes</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <?php 
            $quote_query = $bible_quote->getAll();

            while($bible_quote_data = mysqli_fetch_assoc($quote_query)) {

           ?>
          <div class="col-md-6 col-lg-4 mb-5">
            <div class="block-33">
              <div class="text mb-5">
                <blockquote>
                  <p>&rdquo; 
                    <?=$bible_quote_data['text']; ?>
                   &ldquo;</p>
                </blockquote>
              </div>
              <div class="vcard d-flex">
                <div class="name-text align-self-center ml-auto order-1 text-right">
                  <h2 class="heading"><?=$bible_quote_data['verse']; ?></h2>
                  <span class="meta"><?=$bible_quote_data['version']; ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
