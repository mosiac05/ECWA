<?php 
	$sermon_query = $sermon->getOne($_GET['sermon_details']);
	$sermon_data = mysqli_fetch_assoc($sermon_query);

	$dbConfig->checkRecordExist($sermon_data);

  include './classes/comment.php';
  $comment->insert($sermon_data['id']);

	$banner_query = $banner->getFirst();
	$banner_data = mysqli_fetch_assoc($banner_query);
?>
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/banner_images/<?=$banner_data['image']; ?>);">
  <div class="container">
    <div class="row align-items-center justify-content-center site-hero-inner">
      <div class="col-md-8 text-center">

        <div class="mb-5 element-animate">
          <div class="block-17">
            <h1 class="heading mb-4"><?=$sermon_data['title']; ?></h1>
            <span class="lead">Posted on <?=date('jS F\, Y', strtotime($sermon_data['created_at'])); ?>, by <?=$user->getUserName($sermon_data['user_id']); ?></span>
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
        <div class="block-36 mb-5">
          <form class="mb-3" action="sermons.php" method="get">
            <label class="block-36-heading">Search for sermon:</label>
            <div class="form-group row">            
            <input type="text" name="search" class="form-control col-md-10 col-xs-10" placeholder="Enter sermon name or tag...">
            <button type="submit" class="btn-primary col-md-2 col-xs-2"><i class="fa fa-search"></i></button>
            </div>
          </form>
          <hr>
          <h3 class="block-36-heading">Categories</h3>
          <ul>
          	<li><a href="sermons.php">All</a></li>
          	<?php 
            		$category_query = $sermon_category->getAll();

            		while($category_data = mysqli_fetch_assoc($category_query)) {
            	 ?>
              <li <?php if($category_data['id'] == $sermon_data['cat_id']) { echo "class='active'"; } ?>><a href="sermons.php?category=<?=$category_data['id'] ?>"><?=$category_data['category']; ?> <span class="pull-right"><?=$sermon->getNumberByCategory($category_data['id']); ?></span></a>
            <?php } ?>
          </ul>
        </div>


        <div class="block-25 mb-5">
          <div class="heading">More Sermons</div>
          <ul>
              <?php 
              $random_query = $sermon->getRandom();

              while($random_data = mysqli_fetch_assoc($random_query)) {

             ?>
            <li>
            <div class="block-44 d-flex mb-3">
              <div class="block-44-image"><img src="images/sermon_images/<?=$random_data['image']; ?>" alt="<?=$random_data['image']; ?>"></div>
              <div class="block-44-text">
                <h3 class="block-44-heading"><a href="index.php?sermon_details=<?=$random_data['id']; ?>"><?=$random_data['title']; ?></a></h3>
                <div class="block-44-meta">Posted on <?=date('jS F\, Y', strtotime($random_data['created_at'])); ?>, <?=$user->getUserName($random_data['user_id']); ?></div>
                <div class="block-44-icons">
                  <a href="#"><span class="fa fa-comment"></span> <?=$comment->numberOfCommentBySermon($random_data['id']); ?></a>
                  <a href="#" class=""><span class="fa fa-video-camera"></span></a>
                  <a href="<?=$random_data['link']; ?>" class=""><span class="fa fa-cloud-download"></span></a>
                  <a href="index.php?sermon_details=<?=$random_data['id']; ?>" class=""><span class="fa fa-book"></span></a>
                </div>
              </div>
            </div>
            </li>
          <?php } ?>
          </ul>
        </div>

        <div class="block-26">
          <h3 class="heading">Tags</h3>
          <ul>
            <?php 
              $tags = $sermon_data['tags'];
              $words = explode(',', $tags);
              for($i=0; $i < count($words); $i++){
             ?>
            <li><a href="#"><?=$words[$i]; ?></a></li>
          <?php } ?>
            <!-- <li><a href="#"><?=$tags; ?></a></li> -->
          </ul>
        </div>
      </div>
      <div class="col-md-8 pl-md-5">

        <div class="block-44 d-flex mb-3">
          <!-- <div class="block-44-image"><img src="images/image_tall_1.jpg" alt="Image placeholder"></div> -->
          <div class="block-44-text">
            <h3 class="block-44-heading"><a href="sermon-single.html"><?=$sermon_data['title']; ?></a></h3>
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

        <p><img src="images/sermon_images/<?=$sermon_data['image']; ?>" alt="<?=$sermon_data['image']; ?>" class="img-fluid"></p>
        <p><?=$sermon_data['text']; ?></p>
            <div class="pt-5">
                <h3 class="mb-5"><?=$comment->numberOfCommentBySermon($sermon_data['id']); ?> Comments</h3>
                <ul class="comment-list">
                  <?php 
                    $comment_query = $comment->getAllApproved($sermon_data
                      ['id']);

                    while($comment_data = mysqli_fetch_assoc($comment_query)) {

                   ?>
                  <li class="comment">
                    <div class="vcard bio">
                      <img src="images/avatar.png" alt="Image placeholder">
                    </div>
                    <div class="comment-body">
                      <h3><?=$comment_data['name']; ?></h3>
                      <div class="meta"><?=date('l jS F\, Y', strtotime($comment_data['created_at'])) . ' AT ' . date('g:iA', strtotime($comment_data['created_at'])); ?></div>
                      <p><?=$comment_data['message']; ?></p>
                    </div>
                  </li>
                <?php } ?>
                </ul>
                <!-- END comment-list -->
                
                <div class="comment-form-wrap pt-5">
                  <h3 class="mb-5">Leave a comment</h3>
                  <form action="#" class="bg-light" method="post">
                    <div class="form-group">
                      <label for="name">Name *</label>
                      <input type="text" name="name" class="form-control" id="name" required="">
                    </div>
                    <div class="form-group">
                      <label for="message">Message *</label>
                      <textarea name="message" id="message" cols="30" rows="10" class="form-control" required=""></textarea>
                    </div>
                    <div class="form-group">
                      <label for="bot-check"><b>5 + 2 = ?</b> (enter answer as a number) *</label>
                      <input type="text" name="bot_check" class="form-control" id="bot-check" required="">
                    </div>
                    <div class="form-group">
                      <input type="submit" name="comment_insert" value="Post Comment" class="btn btn-primary py-2 px-4">
                    </div>

                  </form>
                </div>
              </div>
        <div class="site-section">
          <div class="section-heading">
            <h2 class="heading">Popular Sermons</h2>
          </div>
          <?php 
              $popular_query = $sermon->getPopular();

              while($popular_data = mysqli_fetch_assoc($popular_query)) {

             ?>
            <div class="block-44 d-flex mb-3">
              <div class="block-44-image"><img src="images/sermon_images/<?=$popular_data['image']; ?>" alt="<?=$popular_data['image']; ?>"></div>
              <div class="block-44-text">
                <h3 class="block-44-heading"><a href="index.php?event_details=<?=$popular_data['id']; ?>"><?=$popular_data['title']; ?></a></h3>
                <div class="block-44-meta">Posted on <?=date('l jS F\, Y', strtotime($popular_data['created_at'])); ?>, <?=$user->getUserName($popular_data['user_id']); ?></div>
                <div class="block-44-icons">
                  <a href="#"><span class="fa fa-comment"></span> <?=$comment->numberOfCommentBySermon($popular_data['id']); ?></a>
                  <a href="#" class=""><span class="fa fa-video-camera"></span></a>
                  <a href="#" class=""><span class="fa fa-headphones"></span></a>
                  <a href="<?=$popular_data['link']; ?>" class=""><span class="fa fa-cloud-download"></span></a>
                  <a href="index.php?sermon_details=<?=$popular_data['id']; ?>" class=""><span class="fa fa-book"></span></a>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
</section>
