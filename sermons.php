<?php 
  require_once './config/dbconfig.php';
  include './classes/banner.php';
  include './classes/sermon.php';
  include './classes/comment.php';
  include './classes/user.php';
  include './classes/ministry.php';
  include './classes/event.php';
  include './classes/category.php';
  include './classes/about_us.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>EGCOM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

<?php 
	include './includes/nav.php';

	$banner_query = $banner->getFirst();
	$banner_data = mysqli_fetch_assoc($banner_query);
?>
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/banner_images/<?=$banner_data['image']; ?>);">
  <div class="container">
    <div class="row align-items-center justify-content-center site-hero-inner">
      <div class="col-md-8 text-center">

        <div class="mb-5 element-animate">
          <div class="block-17">
            <h1 class="heading mb-4">Sermons</h1>
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
      <div class="col-md-4 mb-3">
        <div class="block-36">
          <form class="mb-3" action="#" method="get">
            <label class="block-36-heading">Search for sermon:</label>
            <div class="form-group row">            
            <input type="text" name="search" class="form-control col-md-10 col-xs-10" placeholder="Enter sermon name or tag...">
            <button type="submit" class="btn-primary col-md-2 col-xs-2"><i class="fa fa-search"></i></button>
            </div>
          </form>
          <hr>
          <h3 class="block-36-heading">Categories</h3>
          <ul>
          	<li <?php if(!isset($_GET['category'])) { echo "class='active'"; } ?>><a href="sermons.php">All</a></li>
          	<?php 
            		$category_query = $sermon_category->getAll();

            		while($category_data = mysqli_fetch_assoc($category_query)) {
            	 ?>
              <li <?php if(isset($_GET['category']) && $category_data['id'] == $_GET['category']) { echo "class='active'"; } ?>><a href="sermons.php?category=<?=$category_data['id'] ?>"><?=$category_data['category']; ?></a>
            <?php } ?>
          </ul>
        </div>

        <div class="block-25 mt-5">
          <div class="heading">Popular Sermons</div>
          <ul>
              <?php 
              $popular_query = $sermon->getPopular();

              while($popular_data = mysqli_fetch_assoc($popular_query)) {

             ?>
            <li>
            <div class="block-44 d-flex mb-3">
              <div class="block-44-image"><img src="images/sermon_images/<?=$popular_data['image']; ?>" alt="<?=$popular_data['image']; ?>"></div>
              <div class="block-44-text">
                <h3 class="block-44-heading"><a href="index.php?sermon_details=<?=$popular_data['id']; ?>"><?=$popular_data['title']; ?></a></h3>
                <div class="block-44-meta">Posted on <?=date('jS F\, Y', strtotime($popular_data['created_at'])); ?>, <?=$user->getUserName($popular_data['user_id']); ?></div>
                <div class="block-44-icons">
                  <a href="#"><span class="fa fa-comment"></span> <?=$comment->numberOfCommentBySermon($popular_data['id']); ?></a>
                  <a href="#" class=""><span class="fa fa-video-camera"></span></a>
                  <a href="<?=$popular_data['link']; ?>" class=""><span class="fa fa-cloud-download"></span></a>
                  <a href="index.php?sermon_details=<?=$popular_data['id']; ?>" class=""><span class="fa fa-book"></span></a>
                </div>
              </div>
            </div>
            </li>
          <?php } ?>
          </ul>
        </div>
      </div>
      <div class="col-md-8 pl-md-5">
      	<?php
						if(isset($_GET['page_no']))
						{
							$sermon->setPageNumber($_GET['page_no']);
						}
						else
						{
							$sermon->setPageNumber(1);
						}
 
 						if(!isset($_GET['category']))
 						{
              if(isset($_GET['search']))
              {
                $sermon_query = $sermon->search($_GET['search']);
            ?>
              <div class="alert alert-info mb-3">
                Found <?php echo mysqli_num_rows($sermon_query); ?> sermons. Try using a single word to search for more results.
              </div>
            <?php
              }
              else
              {                
                $sermon_query = $sermon->getWithLimit();
                $count = $sermon->getNumberOfSermons();
              }
 						}
 						else
 						{
							$sermon_query = $sermon->getByCategory($_GET['category']);
							$count = $sermon->getNumberByCategory($_GET['category']);
						?>

						<div class="alert alert-info mb-3">
							Found <?php echo $count; ?> sermons for '<b><?=$sermon_category->getCategoryName($_GET['category']); ?></b>' category
						</div>

						<?php
 						}
						while($sermon_data = mysqli_fetch_assoc($sermon_query)) {

      	 ?>
        <div class="block-44 d-flex mb-3">
          <div class="block-44-image">
            <img src="images/sermon_images/<?=$sermon_data['image']; ?>" alt="<?=$sermon_data['image']; ?>">
          </div>
          <div class="block-44-text">
            <h3 class="block-44-heading"><a href="index.php?sermon_details=<?=$sermon_data['id']; ?>"><?=$sermon_data['title']; ?></a></h3>
            <div class="block-44-meta">Posted on <?=date('jS F\, Y', strtotime($sermon_data['created_at'])); ?>, by <?=$user->getUserName($sermon_data['user_id']); ?></div>
            <div class="block-44-icons">
              <a href="#"><span class="fa fa-comment"></span> <?=$comment->numberOfCommentBySermon($sermon_data['id']); ?></a>
              <a href="#" class=""><span class="fa fa-video-camera"></span></a>
              <a href="#" class=""><span class="fa fa-headphones"></span></a>
              <a href="<?=$sermon_data['link']; ?>" class=""><span class="fa fa-cloud-download"></span></a>
              <a href="index.php?sermon_details=<?=$sermon_data['id']; ?>" class=""><span class="fa fa-book"></span></a>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php if (!isset($_GET['search'])): ?>        
        <hr>
        <div class="text-center">
          <nav>
            <?php 
              $page_no = $sermon->getPageNumber();
             ?>
             <?php if (!isset($_GET['category'])): ?>
              <a href="sermons.php?<?php if($page_no <= 1){ echo '#'; }else{ echo 'page_no='.($page_no - 1); } ?>" class="btn btn-sm btn-outline-dark pull-left <?php if($page_no <= 1){ echo 'disabled'; } ?>">&larr; Previous</a>
              <a href="sermons.php?<?php if($page_no >= $count){ echo '#'; }else{ echo 'page_no='.($page_no + 1); } ?>" class="btn btn-sm btn-outline-dark pull-right <?php if($page_no >= $count) { echo 'disabled'; } ?>">Next &rarr;</a>
            <?php else: ?>
              <a href="sermons.php?category=<?=$_GET['category']; ?>&<?php if($page_no <= 1){ echo '#'; }else{ echo 'page_no='.($page_no - 1); } ?>" class="btn btn-sm btn-outline-dark pull-left <?php if($page_no <= 1){ echo 'disabled'; } ?>">&larr; Previous</a>
              <a href="sermons.php?category=<?=$_GET['category']; ?>&<?php if($page_no >= $count){ echo '#'; }else{ echo 'page_no='.($page_no + 1); } ?>" class="btn btn-sm btn-outline-dark pull-right <?php if($page_no >= $count) { echo 'disabled'; } ?>">Next &rarr;</a>
             <?php endif ?>
          </nav>
        </div>
      <?php endif ?>
      </div>
    </div>
  </div>
</section>


<?php include './includes/footer.php'; ?>

<?php include './includes/js.php'; ?>