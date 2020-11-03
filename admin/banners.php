<?php 
  include '../classes/banner.php';

  $banner->insert();

  if(isset($_GET['banner_edit']))
  {
    $banner->update();

    $banner_query = $banner->getOne($_GET['banner_edit']);

    $banner_data = mysqli_fetch_assoc($banner_query);
    
    $dbConfig->checkRecordExist($banner_data);

    $id = $banner_data['id'];
    $caption = $banner_data['caption'];
    $image = $banner_data['image'];
  }

  $banner->deleteOne();
 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['banner_edit']))
              {
                echo "Update Banner";
              }
              else
              {
                echo "Banners";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">Banners</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['banner_edit'])): ?>
                              Update Banner
                            <?php else: ?>
                              Add New Banner
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Caption:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="caption" class="form-control" value="<?php echo $caption ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Give the banner some text as caption...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image:</label>
                              <div class="col-sm-12 col-md-7">
                                  <?php if (isset($_GET['banner_edit'])): ?>
                                    <img src="../images/banner_images/<?php echo $image ?? ''; ?>" width='100' alt="<?php echo $image ?? ''; ?>">
                                  <?php endif ?>
                                  <br>
                                  <input type="file" name="image" class="form-control" <?php if(!isset($_GET['banner_edit'])) { echo "required=''"; } ?>>
                                  <span class="invalid-feedback">Select the image for the banner</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['banner_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="banner_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="banner_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="banner_update" value="Update">  
                                  <?php endif ?>
                              </div>
                          </div>
                      </div><!-- 09073996926 -->
                     </form>
                  </div>
              </div>              
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4>All Banners</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Caption</th>
                                  <th>Image</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <?php 
                                $banner_query = $banner->getAll();

                                $i = 0;

                                while($banner_data = mysqli_fetch_assoc($banner_query)) {
                                  $i++;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$banner_data['caption']; ?></td>
                                  <td><img src="../images/banner_images/<?=$banner_data['image']; ?>" alt="<?=$banner_data['image']; ?>" width="150"></td>
                                  <td><a href="index.php?banner_edit=<?=$banner_data['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                  <td>
                                    <form method="post">
                                      <input type="hidden" name="banner_id" value="<?=$banner_data['id']; ?>">
                                      <button type="submit" name="banner_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                  </td>
                              </tr>
                            <?php } ?>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
