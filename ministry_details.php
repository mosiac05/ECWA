<?php 
	$ministry_query = $ministry->getOne($_GET['ministry_details']);
	$ministry_data = mysqli_fetch_assoc($ministry_query);
 
  $dbConfig->checkRecordExist($ministry_data);

	$banner_query = $banner->getFirst();
	$banner_data = mysqli_fetch_assoc($banner_query);
?>
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/banner_images/<?=$banner_data['image']; ?>);">
  <div class="container">
    <div class="row align-items-center justify-content-center site-hero-inner">
      <div class="col-md-8 text-center">

        <div class="mb-5 element-animate">
          <div class="block-17">
            <h1 class="heading mb-4"><?=$ministry_data['name']; ?></h1>
            <div class="lead"><?=$ministry_data['caption']; ?></div>
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
      <div class="col-md-4">
        <div class="block-36">
          <h3 class="block-36-heading">Ministries Links</h3>
          <ul>
          	<?php 
          		$ministry_all = $ministry->getAll();

          		while($ministry_single = mysqli_fetch_assoc($ministry_all)) {
          	 ?>
            <li <?php if($ministry_single['id'] == $_GET['ministry_details']) { echo "class='active'";} ?>><a href="index.php?ministry_details=<?=$ministry_single['id']; ?>"><?=$ministry_single['name']; ?></a></li>
          <?php } ?>
          </ul>
        </div>
      </div>
      <div class="col-md-8 pl-md-5">
        <p><img src="images/ministry_images/<?=$ministry_data['image']; ?>" alt="<?=$ministry_data['image']; ?>" class="img-fluid"></p>
        <p><?=$ministry_data['text']; ?></p>
      </div>
    </div>
  </div>
</section>
