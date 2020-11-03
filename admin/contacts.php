<?php 
  include '../classes/contact.php';


  $contact->deleteOne();
 ?>
  <section class="section">
      <div class="section-header">
          <h1>Contact Messages</h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">All Contact Messages</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">              
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4>All Contact Messages</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Email Address</th>
                                  <th>Phone Number</th>
                                  <th>Message</th>
                                  <th>Created At</th>
                                  <th>Delete</th>
                              </tr>
                              <?php 
                                $contact_query = $contact->getAll();

                                $i = 0;

                                while($contact_data = mysqli_fetch_assoc($contact_query)) {
                                  $i++;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$contact_data['name']; ?></td>
                                  <td><a href="tel:/<?=$contact_data['phone_num']; ?>"><?=$contact_data['phone_num']; ?></a></td>
                                  <td><?=$contact_data['email']; ?></td>
                                  <td><?=$contact_data['message']; ?></td>
                                  <td><?=date('l jS F\, Y', strtotime($contact_data['created_at'])); ?></td>
                                  <td>
                                  	<form method="post">
                                  		<input type="hidden" name="contact_id" value="<?=$contact_data['id']; ?>">
                                  		<button type="submit" name="contact_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
