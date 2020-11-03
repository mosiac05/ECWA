<?php 
  include '../classes/service.php';

  $service->insert();

  if(isset($_GET['service_edit']))
  {
    $service->update();

    $service_query = $service->getOne($_GET['service_edit']);

    $service_data = mysqli_fetch_assoc($service_query);
    $dbConfig->checkRecordExist($service_data);

    $id = $service_data['id'];
    $heading = $service_data['heading'];
    $text = $service_data['text'];
    $image = $service_data['image'];
  }

  $service->deleteOne();
 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['service_edit']))
              {
                echo "Update service";
              }
              else
              {
                echo "services";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">services</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['service_edit'])): ?>
                              Update service
                            <?php else: ?>
                              Add New service
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Heading:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="heading" class="form-control" value="<?php echo $heading ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Which service?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Text-to-display:</label>
                              <div class="col-sm-12 col-md-7">
                                  <textarea class="summernote-simple" name="text" required=""><?php echo $text ?? ''; ?></textarea>                                  
                                  <span class="invalid-feedback">Enter some text to display...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image:</label>
                              <div class="col-sm-12 col-md-7">
                                  <?php if (isset($_GET['service_edit'])): ?>
                                    <img src="../images/service_images/<?php echo $image ?? ''; ?>" width='100' alt="<?php echo $image ?? ''; ?>">
                                  <?php endif ?>
                                  <br>
                                  <input type="file" name="image" class="form-control" <?php if(!isset($_GET['service_edit'])) { echo "required=''"; } ?>>
                                  <span class="invalid-feedback">Select the image for the service</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['service_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="service_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="service_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="service_update" value="Update">  
                                  <?php endif ?>
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>              
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4>All Services</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Heading</th>
                                  <th>Text-to-display</th>
                                  <th>Image</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <?php 
                                $service_query = $service->getAll();

                                $i = 0;

                                while($service_data = mysqli_fetch_assoc($service_query)) {
                                  $i++;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$service_data['heading']; ?></td>
                                  <td><?=$service_data['text']; ?></td>
                                  <td><img src="../images/service_images/<?=$service_data['image']; ?>" alt="<?=$service_data['image']; ?>" width="150"></td>
                                  <td><a href="index.php?service_edit=<?=$service_data['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                  <td>
                                    <form method="post">
                                      <input type="hidden" name="service_id" value="<?=$service_data['id']; ?>">
                                      <button type="submit" name="service_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
