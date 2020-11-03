<?php 
  include '../classes/ministry.php';

  $ministry->insert();

  if(isset($_GET['ministry_edit']))
  {
    $ministry->update();

    $ministry_query = $ministry->getOne($_GET['ministry_edit']);

    $ministry_data = mysqli_fetch_assoc($ministry_query);
    $dbConfig->checkRecordExist($ministry_data);

    $id = $ministry_data['id'];
    $name = $ministry_data['name'];
    $caption = $ministry_data['caption'];
    $text = $ministry_data['text'];
    $image = $ministry_data['image'];
  }

  $ministry->deleteOne();
 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['ministry_edit']))
              {
                echo "Update Group Details: " . $name;
              }
              else
              {
                echo "Church Groups";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">Groups</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['ministry_edit'])): ?>
                              Update Group
                            <?php else: ?>
                              Add New Group
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="name" class="form-control" value="<?php echo $name ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What's the name of the group?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Text-to-display:</label>
                              <div class="col-sm-12 col-md-7">
                                  <textarea class="summernote" name="text" required=""><?php echo $text ?? ''; ?></textarea>                                  
                                  <span class="invalid-feedback">Enter some text to display...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image:</label>
                              <div class="col-sm-12 col-md-7">
                                  <?php if (isset($_GET['ministry_edit'])): ?>
                                    <img src="../images/ministry_images/<?php echo $image ?? ''; ?>" width='100' alt="<?php echo $image ?? ''; ?>">
                                  <?php endif ?>
                                  <br>
                                  <input type="file" name="image" class="form-control" <?php if(!isset($_GET['ministry_edit'])) { echo "required=''"; } ?>>
                                  <span class="invalid-feedback">Select the image for the ministry</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Caption:</label>
                              <div class="col-sm-12 col-md-7">
                                  <textarea class="summernote-simple" name="caption" required=""><?php echo $caption ?? ''; ?></textarea>                                  
                                  <span class="invalid-feedback">Enter some caption for the group...</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['ministry_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="ministry_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="ministry_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="ministry_update" value="Update">  
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
                          <h4>All Groups</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Text-to-display</th>
                                  <th>Image</th>
                                  <th>Caption</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <?php 
                                $ministry_query = $ministry->getAll();

                                $i = 0;

                                while($ministry_data = mysqli_fetch_assoc($ministry_query)) {
                                  $i++;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$ministry_data['name']; ?></td>
                                  <td><?=$ministry_data['text']; ?></td>
                                  <td><img src="../images/ministry_images/<?=$ministry_data['image']; ?>" alt="<?=$ministry_data['image']; ?>" width="150"></td>
                                  <td><?=$ministry_data['caption']; ?></td>
                                  <td><a href="index.php?ministry_edit=<?=$ministry_data['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                  <td>
                                    <form method="post">
                                      <input type="hidden" name="ministry_id" value="<?=$ministry_data['id']; ?>">
                                      <button type="submit" name="ministry_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
