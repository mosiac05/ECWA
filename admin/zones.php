<?php 
  include '../classes/zone.php';

  $zone->insert();

  if(isset($_GET['zone_edit']))
  {
    $zone->update();

    $zone_query = $zone->getOne($_GET['zone_edit']);

    $zone_data = mysqli_fetch_assoc($zone_query);
    $dbConfig->checkRecordExist($zone_data);

    $id = $zone_data['id'];
    $zone_name = $zone_data['zone'];
    $meeting_point = $zone_data['meeting_point'];
    $leader = $zone_data['leader'];
    $phone_num = $zone_data['phone_num'];
  }

  $zone->deleteOne();
 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['zone_edit']))
              {
                echo "Update Zone";
              }
              else
              {
                echo "Zones";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">Zones</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['zone_edit'])): ?>
                              Update Zone
                            <?php else: ?>
                              Add New Zone
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Zone:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="zone" class="form-control" value="<?php echo $zone_name ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What is the name of the zone?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Meeting Point:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="meeting_point" class="form-control" value="<?php echo $meeting_point ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Where is the meeting point?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Leader:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="leader" class="form-control" value="<?php echo $leader ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What is the name of the leader?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone Number:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="tel" name="phone_num" class="form-control" value="<?php echo $phone_num ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Enter the phone number for this zone...</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['zone_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="zone_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="zone_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="zone_update" value="Update">  
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
                          <h4>All Zones</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Zones</th>
                                  <th>Meeting Point</th>
                                  <th>Leader</th>
                                  <th>Phone Number</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <?php 
                                $zone_query = $zone->getAll();

                                $i = 0;

                                while($zone_data = mysqli_fetch_assoc($zone_query)) {
                                  $i++;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$zone_data['zone']; ?></td>
                                  <td><?=$zone_data['meeting_point']; ?></td>
                                  <td><?=$zone_data['leader']; ?></td>
                                  <td><a href="tel:/<?=$zone_data['phone_num']; ?>"><?=$zone_data['phone_num']; ?></a></td>
                                  <td><a href="index.php?zone_edit=<?=$zone_data['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                  <td>
                                    <form method="post">
                                      <input type="hidden" name="zone_id" value="<?=$zone_data['id']; ?>">
                                      <button type="submit" name="zone_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
