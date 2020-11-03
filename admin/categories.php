<?php 
  include '../classes/category.php';

  $sermon_category->insert();

  if(isset($_GET['category_edit']))
  {
    $sermon_category->update();

    $category_query = $sermon_category->getOne($_GET['category_edit']);

    $category_data = mysqli_fetch_assoc($category_query);
    $dbConfig->checkRecordExist($category_data);

    $id = $category_data['id'];
    $category = $category_data['category'];
  }

  $sermon_category->deleteOne();

 ?>  
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['category_edit']))
              {
                echo "Update Sermon Category";
              }
              else
              {
                echo "Sermon Categories";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">Sermon Categories</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post">
                      <div class="card-header">
                          <h4>
                            <?php 
                              if(isset($_GET['category_edit']))
                              {
                                echo "Update Category";
                              }
                              else
                              {
                                echo "Add New Category";
                              }
                             ?>
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group mb-5">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Category:</label>
                              <div class="col-sm-12 col-md-12">
                                  <input type="text" class="form-control" name="category" value="<?php echo $category ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Which sermon category?</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group mb-5">
                              <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                              <?php 
                                  if(!isset($_GET['category_edit']))
                                  {
                                 ?>
                                <input type="submit" name="category_insert" value="Submit" class="btn btn-primary">
                              <?php
                                  }
                                  else
                                  {
                              ?>
                                <input type="hidden" name="category_id" value="<?=$id; ?>">
                                <input type="submit" name="category_update" value="Update" class="btn btn-primary">
                              <?php
                                  }
                              ?>
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>              
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                      <div class="card-header">
                          <h4>All Sermon Categories</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Category</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <?php 
                                $category_query = $sermon_category->getAll();

                                $i = 0;

                                while($category_data = mysqli_fetch_assoc($category_query)){
                                  $i++;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$category_data['category']; ?></td>
                                  <td><a href="index.php?category_edit=<?=$category_data['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                  <td>
                                    <form method="post">
                                      <input type="hidden" name="category_id" value="<?=$category_data['id']; ?>">
                                      <button type="submit" name="category_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
