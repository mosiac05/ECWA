<?php
  $dbConfig->unauthorizedRedirect();
  include '../classes/user.php';

  $user_data = mysqli_fetch_assoc($user->getOne($_GET['user_single']));
  $dbConfig->checkRecordExist($user_data);

  $user->activateUser($_GET['user_single']);
  $user->deactivateUser($_GET['user_single']);

  $user->deleteOne($_GET['user_single']);
 ?>
    <section class="section">
        <div class="section-header">
            <h1>
              <?php if ($user_data['is_admin']): ?>
                Admin Details
              <?php else: ?>
                Staff Details
              <?php endif ?>
            </h1>
        </div>
        <div class="section-body">        	
	        <div class="row">
	            <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4>
                            <?php if ($user_data['is_admin']): ?>
                              Admin Details
                            <?php else: ?>
                              Staff Details
                            <?php endif ?> 
                          </h4>
                      </div>
                      <div class="card-body">
                          <table class="table table-striped table-bordered m-auto col-md-8 col-lg-8">
                            <tbody>
                              <tr>
                                  <th>First Name:</th>
                                  <td><?=$user_data['first_name']; ?></td>
                              </tr>
                              <tr>
                                  <th>Last Name:</th>
                                  <td><?=$user_data['last_name']; ?></td>
                              </tr>
                              <tr>
                                  <th>Username:</th>
                                  <td><?=$user_data['username']; ?></td>
                              </tr>
                              <tr>
                                  <th>Email Address:</th>
                                  <td><?=$user_data['email']; ?></td>
                              </tr>
                              <tr>
                                  <th>Status:</th>
                                  <td>
                                    <form method="post">
                                      <?php if ($user_data['is_active']): ?>
                                        <button type="submit" name="user_deactivate" class="btn btn-icon icon-left btn-success mt-2" data-toggle="tooltip" data-placement="top" title="Click to Deactivate"><i class="fas fa-key"></i> Activated
                                        </button>
                                      <?php else: ?>
                                        <button type="submit" name="user_activate" class="btn btn-icon icon-left btn-danger mt-2" data-toggle="tooltip" data-placement="top" title="Click to Activate"><i class="fas fa-lock"></i> Deactivated
                                        </button>
                                      <?php endif ?>                                       
                                    </form>                                  
                                  </td>
                              </tr>
                              <tr>
                                  <th>Last Login:</th>
                                  <td><?=date('l jS F\, Y', strtotime($user_data['last_login'])); ?></td>
                              </tr>
                              <tr>
                                  <th>Created At:</th>
                                  <td><?=date('l jS F\, Y', strtotime($user_data['created_at'])); ?></td>
                              </tr>
                              <tr>
                                  <th>Modified At:</th>
                                  <td><?=date('l jS F\, Y', strtotime($user_data['modified_at'])); ?></td>
                              </tr>
                              <tr>
                                <td colspan="2" class="text-center buttons">
                                  <?php if ($dbConfig->checkUserIsAdmin()): ?>                                  
                                    <a href="staff_register.php?staff_edit=<?=$user_data['id']; ?>" class="btn btn-icon btn-warning mt-2"><i class="fas fa-edit"></i> Edit</a>
                                    <button class="btn btn-icon btn-danger mt-2" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash" ></i> Delete</button>
                                  <?php endif ?>
                                </td>                              
                              </tr>
                            </tbody>
                          </table>
                      </div>
                  </div>
	            </div>
	        </div>
        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete <?=$user_data['first_name'] . ', ' . $user_data['last_name']; ?>'s record?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <?=$user_data['first_name'] . ', ' . $user_data['last_name']; ?>'s record?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <form method="post">
                    <button type="submit" name="user_delete" class="btn btn-danger">Delete</button>                    
                  </form>
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>