<?php 
    include '../classes/sermon.php';
    include '../classes/user.php';
    include '../classes/event.php';
    include '../classes/contact.php';
    include '../classes/category.php';

    $num_of_sermons = mysqli_num_rows($sermon->getAll());
    $num_of_staff = mysqli_num_rows($user->getAllStaff());
    $num_of_contacts = mysqli_num_rows($contact->getAll());
    $num_of_events = mysqli_num_rows($event->getAll());

 ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-book"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Sermons</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $num_of_sermons; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Events</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $num_of_events; ?>
                    </div>
                </div>
            </div>
        </div>       
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Contact Messages</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $num_of_contacts; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Staff</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $num_of_staff; ?>
                        </div>
                    </div>
                </div>
            </div>        
    </div>
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
</section>