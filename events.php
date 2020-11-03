<?php
	$banner_query = $banner->getFirst();
	$banner_data = mysqli_fetch_assoc($banner_query);
?>
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/banner_images/<?=$banner_data['image']; ?>);">
  <div class="container">
    <div class="row align-items-center justify-content-center site-hero-inner">
      <div class="col-md-8 text-center">

        <div class="mb-5 element-animate">
          <div class="block-17">
            <h1 class="heading mb-4">Events</h1>
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
    	<?php
    		if(isset($_GET['page_no']))
				{
					$event->setPageNumber($_GET['page_no']);
				}
				else
				{
					$event->setPageNumber(1);
				}

    		$event_query = $event->getAll();

    		while($event_data = mysqli_fetch_assoc($event_query)) {

    	 ?>
      <div class="col-md-6 col-lg-4 mb-5">
        <div class="block-20">
          <figure>
            <a href="blog-single.html"><img src="images/event_images/<?=$event_data['image']; ?>" alt="<?=$event_data['image']; ?>" class="img-fluid"></a>
          </figure>
          <div class="text text-center">
            <h3 class="heading"><a href="index.php?event_details=<?=$event_data['id']; ?>"><?=$event_data['title']; ?></a></h3>
            <div class="meta mb-3">
              <div><a href="#"><span class="fa fa-calendar"></span> <?=date('jS F\, Y g:iA', strtotime($event_data['date'])); ?></a></div>
            </div>
            <p><?=substr($event_data['text'], 0, 120); ?>...</p>
            <p><a href="index.php?event_details=<?=$event_data['id']; ?>"><strong>Read More</strong></a></p>
          </div>
        </div>
      </div>
    <?php } ?>

    </div>

    <div class="row mt-5">
            <div class="col-md-12 pt-5">
							<?php 
								$page_no = $event->getPageNumber();
								$count = $event->getNumberOfEvents();
							 ?>
              <nav class="">
                <a href="index.php?event&<?php if($page_no <= 1){ echo '#'; }else{ echo 'page_no='.($page_no - 1); } ?>" class="btn btn-lg btn-outline-dark pull-left <?php if($page_no <= 1){ echo 'disabled'; } ?>">&larr; Previous</a>
	      				<a href="index.php?event&<?php if($page_no >= $count){ echo '#'; }else{ echo 'page_no='.($page_no + 1); } ?>" class="btn btn-lg btn-outline-dark pull-right <?php if($page_no >= $count) { echo 'disabled'; } ?>">Next &rarr;</a>
              </nav>


            </div>
          </div>
  </div>
</section>