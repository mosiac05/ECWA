<?php 
  include '../classes/sermon.php';
  include '../classes/category.php';
 ?>
  <section class="section">
      <div class="section-header">
          <h1>All Sermons</h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">All Sermons</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">            
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4>All Sermons</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center" id="table-2">
                                <thead>                                     
                                  <tr>
                                      <th>#</th>
                                      <th>Title</th>
                                      <th>Sermon Text</th>
                                      <th>Image</th>
                                      <th>Category</th>
                                      <th>Edit</th>
                                      <th>View</th>
                                  </tr>
                                </thead>
                                <tbody>
                                      <?php 
                                    $sermon_query = $sermon->getAll();

                                    $i = 0;

                                    while($sermon_data = mysqli_fetch_assoc($sermon_query)) {
                                      $i++;
                                   ?>
                                  <tr>
                                      <td><?=$i; ?></td>
                                      <td><?=$sermon_data['title']; ?></td>
                                      <td><?=substr($sermon_data['text'], 0, 100); ?>...</td>
                                      <td><img src="../images/sermon_images/<?=$sermon_data['image']; ?>" alt="<?=$sermon_data['image']; ?>" width="150"></td>
                                      <td><?=$sermon_category->getCategoryName($sermon_data['cat_id']); ?></td>
                                      <td><a href="index.php?sermon_edit=<?=$sermon_data['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                      <td><a href="index.php?sermon_single=<?=$sermon_data['id']; ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="View Sermon"><i class="fas fa-eye"></i></a></td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
