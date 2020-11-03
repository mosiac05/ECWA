<?php 
  include '../classes/sermon.php';
  include '../classes/category.php';

  $sermon->insert();

  if(isset($_GET['sermon_edit']))
  {
    $sermon->update();

    $sermon_query = $sermon->getOne($_GET['sermon_edit']);

    $sermon_data = mysqli_fetch_assoc($sermon_query);
    $id = $sermon_data['id'];
    $title = $sermon_data['title'];
    $link = $sermon_data['link'];
    $tags = $sermon_data['tags'];
    $cat_id = $sermon_data['cat_id'];
    $text = $sermon_data['text'];
    $image = $sermon_data['image'];
  }

 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['sermon_edit']))
              {
                echo "Update Sermon: " . $title;
              }
              else
              {
                echo "Add New Sermon";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">sermons</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['sermon_edit'])): ?>
                              Update Sermon
                            <?php else: ?>
                              Add New Sermon
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="title" class="form-control" value="<?php echo $title ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What is the title of the sermon?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category:</label>
                            <div class="col-sm-12 col-md-7">
                              <select class="custom-select form-control" name="cat_id" required="">
                                  <option disabled="">Select the day:</option>
                                  <?php 
                                    $cat_query = $sermon_category->getAll();

                                    while($cat_data = mysqli_fetch_assoc($cat_query)) {
                                   ?>
                                  <option value="<?=$cat_data['id']; ?>" <?php if(isset($_GET['sermon_edit']) && $cat_id==$cat_data['id']) { echo "selected=''"; } ?>><?=$cat_data['category']; ?></option>
                                <?php } ?>
                              </select>
                              <span class="invalid-feedback">Please select day of activity!</span>
                            </div>                          
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sermon Text:</label>
                              <div class="col-sm-12 col-md-7">
                                  <textarea class="summernote" name="text" required=""><?php echo $text ?? ''; ?></textarea>                                  
                                  <span class="invalid-feedback">Enter sermon text here...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="url" name="link" class="form-control" value="<?php echo $link ?? ''; ?>">
                                  <span class="invalid-feedback">Type or paste the link to this sermon material</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image:</label>
                              <div class="col-sm-12 col-md-7">
                                  <?php if (isset($_GET['sermon_edit'])): ?>
                                    <img src="../images/sermon_images/<?php echo $image ?? ''; ?>" width='100' alt="<?php echo $image ?? ''; ?>">
                                  <?php endif ?>
                                  <br>
                                  <input type="file" name="image" class="form-control" accept=".jpg, .jpeg, .png" <?php if(!isset($_GET['sermon_edit'])) { echo "required=''"; }  ?>>
                                  <span class="invalid-feedback">Select the image for the sermon</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tags:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="tags" class="form-control" value="<?php echo $tags ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What are the tags that can be used to search for this sermon?</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['sermon_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="sermon_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="sermon_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="sermon_update" value="Update">  
                                  <?php endif ?>
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>
          </div>
      </div>
  </section>
