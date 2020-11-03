    <footer class="site-footer">
      <div class="container">
        <div class="row mb-5">
        <!--   <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <p>Perferendis eum illum voluptatibus dolore tempora consequatur minus asperiores temporibus.</p>
          </div> -->
          <div class="col-md-6 col-lg-6 mb-5 mb-lg-0">
            <h3 class="heading">Quick Links</h3>
            <div class="row">
              <div class="col-md-4">
                <ul class="list-unstyled">
                  <?php 
                    $ministry_query = $ministry->getAll();

                    while($ministry_data = mysqli_fetch_assoc($ministry_query)) {
                   ?>
                  <li><a href="index.php?ministry_details=<?=$ministry_data['id']; ?>"><?=$ministry_data['name']; ?></a></li>
                <?php } ?>
                </ul>
              </div>
              <div class="col-md-4">
                <ul class="list-unstyled">
                  <li><a href="index.php?home">Home</a></li>
                  <li><a href="sermons.php">Sermons</a></li>
                  <li><a href="index.php?contact">Contact</a></li>
                  <li><a href="index.php?about_us">About Us</a></li>
                </ul>
              </div>
              <div class="col-md-4">
                <ul class="list-unstyled">
                  <li><a href="index.php?events">Events</a></li>
                  <li><a href="index.php?announcements">Announcements</a></li>
                  <li><a href="index.php?announcements">Weekly Activities</a></li>
                  <li><a href="index.php?about_us">Zonal Fellowships</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <h3 class="heading">Events</h3>
            <?php 
              $event_query = $event->getLatest(3);

              while($event_data = mysqli_fetch_assoc($event_query)) {
             ?>
            <div class="block-21 d-flex mb-4">
              <div class="text">
                <h3 class="heading mb-0"><a href="index.php?event_details=<?=$event_data['id']; ?>"><?=$event_data['title']; ?></a></h3>
                <div class="meta">
                  <div><a href="#"><span class="ion-android-calendar"></span> <?=date('jS F\, Y g:iA', strtotime($event_data['date'])); ?></a></div>
                </div>
              </div>
            </div> 
          <?php } ?>
          </div>
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
            <h3 class="heading">Contact Information</h3>
            <div class="block-23">
              <ul>
                <li><span class="icon ion-android-pin"></span><span class="text"><?=$about_us->getData('address'); ?></span></li>
                <li><a href="#"><span class="icon ion-ios-telephone"></span><span class="text"><?=$about_us->getData('phone_num'); ?></span></a></li>
                <li><a href="#"><span class="icon ion-android-mail"></span><span class="text"><?=$about_us->getData('email'); ?></span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row pt-5">
          <div class="col-md-12 text-center copyright">
            
            <p class="float-md-left"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a> | Developed by <a href="https://github.com/mosiac05" target="_blank">Mosiac</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            <p class="float-md-right">
              <a href="<?=$about_us->getData('facebook'); ?>" class="fa fa-facebook p-2"></a>
              <a href="<?=$about_us->getData('twitter'); ?>" class="fa fa-twitter p-2"></a>
              <a href="#" class="fa fa-linkedin p-2"></a>
              <a href="<?=$about_us->getData('instagram'); ?>" class="fa fa-instagram p-2"></a>

            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- END footer -->
  </div>