<?php
  $dbConfig->unauthorizedRedirect();
	include '../classes/user.php';
 ?>
    <section class="section">
        <div class="section-header">
            <?php if (isset($_GET['admins'])): ?>
              <h1>All Admins</h1>
             <?php else: ?>
              <h1>All Staffs</h1>
            <?php endif ?>
        </div>
        <div class="section-body">        	
	        <div class="row">
	            <div class="col-12">
	                <div class="card">
	                    <div class="card-header">
					            <?php if (isset($_GET['admins'])): ?>
					              <h4>All Admins</h4>
					             <?php else: ?>
					              <h4>All Staffs</h4>
					            <?php endif ?>
	                    </div>
	                    <div class="card-body">
	                        <div class="table-responsive">
	                             <table class="table table-striped v_center" id="table-2">
	                                <thead>
	                                    <tr>
	                                    <th>#</th>
	                                    <th>First Name</th>
	                                    <th>Last Name</th>
	                                    <th>Email</th>
	                                    <th>Last Login</th>
	                                    <th>Edit</th>
	                                    <th>Details</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	<?php
	                                		if(isset($_GET['admins']))
	                                		{
		                                		$staff_query = $user->getAllAdmins();
	                                		}
	                                		else
	                                		{
		                                		$staff_query = $user->getAllStaff();
	                                		}

	                                		$i = 0;
	                                		while($staff_data = mysqli_fetch_array($staff_query)){
	                                			$i += 1;

	                                	 ?>
	                                    <tr>
	                                    <td><?=$i; ?></td>
	                                    <td><?=$staff_data['first_name'];  ?></td>
	                                    <td><?=$staff_data['last_name'];  ?></td>
	                                    <td><?=$staff_data['email'];  ?></td>
	                                    <td><?php echo date('l jS F\, Y', strtotime($staff_data['last_login'])) . ' | ' . date('g:iA', strtotime($staff_data['last_login'])); ?></td>
	                                    <td><a href="staff_register.php?staff_edit=<?=$staff_data['id'] ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
	                                    <td><a href="index.php?user_single=<?=$staff_data['id'] ?>" class="btn btn-sm btn-primary"data-toggle="tooltip" data-placement="top" title="Details"><i class="fas fa-eye"></i></a></td>
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