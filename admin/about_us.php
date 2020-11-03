<?php 
  include '../classes/about_us.php';

  $about_us->update();

  $about_us_query = $about_us->getAboutUs();

  $about_us_data = mysqli_fetch_assoc($about_us_query);
  $logo = $about_us_data['logo'];
  $pastor_name = $about_us_data['pastor_name'];
  $pastor_note = $about_us_data['pastor_note'];
  $text = $about_us_data['text'];
  $image = $about_us_data['image'];
  $video_link = $about_us_data['video_link'];
  $address = $about_us_data['address'];
  $phone_num = $about_us_data['phone_num'];
  $email = $about_us_data['email'];
  $facebook = $about_us_data['facebook'];
  $twitter = $about_us_data['twitter'];
  $instagram = $about_us_data['instagram'];

 ?>
  <section class="section">
      <div class="section-header">
          <h1>About Us</h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">About Us</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      <div class="card-header">
                          <h4>About Us</h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Church Logo:</label>
                              <div class="col-sm-12 col-md-7">
                                  <img src="../images/about_us/<?php echo $logo ?? ''; ?>" width='100' alt="<?php echo $logo ?? ''; ?>">
                                  <br>
                                  <input type="file" name="logo" class="form-control" accept=".jpg, .jpeg, .png">
                                  <span class="invalid-feedback">Select the church logo to upload</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pastor Name:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="pastor_name" class="form-control" value="<?php echo $pastor_name ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What is the name of the pastor?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pastor's Note:</label>
                              <div class="col-sm-12 col-md-7">
                                  <textarea class="summernote-simple" name="pastor_note" required=""><?php echo $pastor_note ?? ''; ?></textarea>                                 
                                  <span class="invalid-feedback">Enter the Pastor's note here...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Text-to-display:</label>
                              <div class="col-sm-12 col-md-7">
                                  <textarea class="summernote" name="text" required=""><?php echo $text ?? ''; ?></textarea>                                  
                                  <span class="invalid-feedback">Enter about us text here...</span>
                              </div>
                          </div>                          
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image:</label>
                              <div class="col-sm-12 col-md-7">
                                  <img src="../images/about_us/<?php echo $image ?? ''; ?>" width='100' alt="<?php echo $image ?? ''; ?>">
                                  <br>
                                  <input type="file" name="image" class="form-control" accept=".jpg, .jpeg, .png">
                                  <span class="invalid-feedback">Select an image</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Church Phone Number:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="tel" name="phone_num" class="form-control" value="<?php echo $phone_num ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Type the church's phone number here...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Church Email Address:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="email" name="email" class="form-control" value="<?php echo $email ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Type the church's email address here...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Video Link:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="url" name="video_link" class="form-control" value="<?php echo $video_link ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Type or paste the video link to introductory video...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Church Address:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="address" class="form-control" value="<?php echo $address ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Type the church's address here...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Facebook Link:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="url" name="facebook" class="form-control" value="<?php echo $facebook ?? ''; ?>">
                                  <span class="invalid-feedback">Type or paste the facebook link to the church's Facebook page...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Twitter Link:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="url" name="twitter" class="form-control" value="<?php echo $twitter ?? ''; ?>">
                                  <span class="invalid-feedback">Type or paste the twitter link to the church's Twitter handle...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Instagram Link:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="url" name="instagram" class="form-control" value="<?php echo $instagram ?? ''; ?>">
                                  <span class="invalid-feedback">Type or paste the instagram link to the church's Instagram account...</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                <input class="btn btn-primary" type="submit" name="about_us_update" value="Update">
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>
          </div>
      </div>
  </section>
