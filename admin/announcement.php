<?php 
  include '../classes/about_us.php';

  $about_us->updateAnnouncement();
  $about_us_query = $about_us->getAboutUs();
  $about_us_data = mysqli_fetch_assoc($about_us_query);
  $announcement = $about_us_data['announcement'];

 ?>
  <section class="section">
      <div class="section-header">
          <h1>Announcement</h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">Announcement</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post">
                      <div class="card-header">
                          <h4>Announcement</h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Type The Announcement Here:</label>
                              <div class="col-sm-12 col-md-12">
                                  <textarea class="summernote" name="announcement" required=""><?php echo $announcement ?? ''; ?></textarea>                                  
                                  <span class="invalid-feedback">Type the announcement here...</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                <input class="btn btn-primary" type="submit" name="announcement_update" value="Update">
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>
          </div>
      </div>
  </section>
