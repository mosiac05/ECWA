<?php 
  include '../classes/board_member.php';

  $board_member->insert();

  if(isset($_GET['board_member_edit']))
  {
    $board_member->update();

    $board_member_query = $board_member->getOne($_GET['board_member_edit']);

    $board_member_data = mysqli_fetch_assoc($board_member_query);
    $dbConfig->checkRecordExist($board_member_data);

    $id = $board_member_data['id'];
    $name = $board_member_data['name'];
    $position = $board_member_data['position'];
    $phone_num = $board_member_data['phone_num'];
    $text = $board_member_data['text'];
    $image = $board_member_data['image'];
  }

  if(isset($_GET['board_member_delete']))
  {
    $board_member->deleteOne($_GET['board_member_delete']);
  }
 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['board_member_edit']))
              {
                echo "Update Board Member: " . $name;
              }
              else
              {
                echo "Board Members";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">Board Members</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['board_member_edit'])): ?>
                              Update Board Member
                            <?php else: ?>
                              Add New Board Member
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="name" class="form-control" value="<?php echo $name ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What is the name of the board member?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Position:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="position" class="form-control" value="<?php echo $position ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What's the position of this board member?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Mobile Number:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="tel" name="phone_num" class="form-control" value="<?php echo $phone_num ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What's the mobile number of this board member?</span>
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
                                  <?php if (isset($_GET['board_member_edit'])): ?>
                                    <img src="../images/board_member_images/<?php echo $image ?? ''; ?>" width='100' alt="<?php echo $image ?? ''; ?>">
                                  <?php endif ?>
                                  <br>
                                  <input type="file" name="image" class="form-control" required="">
                                  <span class="invalid-feedback">Select the image for the board member</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['board_member_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="board_member_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="board_member_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="board_member_update" value="Update">  
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
                          <h4>All Board Members</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Position</th>
                                  <th>Mobile Number</th>
                                  <th>Text-to-display</th>
                                  <th>Image</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <?php 
                                $board_member_query = $board_member->getAll();

                                $i = 0;

                                while($board_member_data = mysqli_fetch_assoc($board_member_query)) {
                                  $i++;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$board_member_data['name']; ?></td>
                                  <td><?=$board_member_data['position']; ?></td>
                                  <td><?=$board_member_data['phone_num']; ?></td>
                                  <td><?=$board_member_data['text']; ?></td>
                                  <td><img src="../images/board_member_images/<?=$board_member_data['image']; ?>" alt="<?=$board_member_data['image']; ?>" width="150"></td>
                                  <td><a href="index.php?board_member_edit=<?=$board_member_data['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                  <td>
                                    <form method="post">
                                      <input type="hidden" name="board_member_id" value="<?=$board_member_data['id']; ?>">
                                      <button type="submit" name="board_member_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
