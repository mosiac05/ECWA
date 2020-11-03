<?php 
  include '../classes/program.php';

  $program->insert();

  if(isset($_GET['program_edit']))
  {
    $program->update();

    $program_query = $program->getOne($_GET['program_edit']);

    $program_data = mysqli_fetch_assoc($program_query);
    $dbConfig->checkRecordExist($program_data);

    $id = $program_data['id'];
    $day = $program_data['day'];
    $activity = $program_data['activity'];
    $time = $program_data['time'];
    $venue = $program_data['venue'];
  }

  $program->deleteOne();
 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['program_edit']))
              {
                echo "Update Program";
              }
              else
              {
                echo "Programs";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">programs</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['program_edit'])): ?>
                              Update Program
                            <?php else: ?>
                              Add New Program
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Day of activity:</label>
                            <div class="col-sm-12 col-md-7">
                              <select class="custom-select form-control" name="day" required="">
                                  <option disabled="">Select the day:</option>
                                  <option value="MONDAY" <?php if(isset($_GET['program_edit']) && $day=='MONDAY') { echo "selected=''"; } ?>>Monday</option>
                                  <option value="TUESDAY" <?php if(isset($_GET['program_edit']) && $day=='TUESDAY') { echo "selected=''"; } ?>>Tuesday</option>
                                  <option value="WEDNESDAY" <?php if(isset($_GET['program_edit']) && $day=='WEDNESDAY') { echo "selected=''"; } ?>>Wednesday</option>
                                  <option value="THURSDAY" <?php if(isset($_GET['program_edit']) && $day=='THURSDAY') { echo "selected=''"; } ?>>Thursday</option>
                                  <option value="FRIDAY" <?php if(isset($_GET['program_edit']) && $day=='FRIDAY') { echo "selected=''"; } ?>>Friday</option>
                                  <option value="SATURDAY" <?php if(isset($_GET['program_edit']) && $day=='SATURDAY') { echo "selected=''"; } ?>>Saturday</option>
                                  <option value="SUNDAY" <?php if(isset($_GET['program_edit']) && $day=='SUNDAY') { echo "selected=''"; } ?>>Sunday</option>
                              </select>
                              <span class="invalid-feedback">Please select day of activity!</span>
                            </div>                          
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Activity:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="activity" class="form-control" value="<?php echo $activity ?? ''; ?>" required="">                                 
                                  <span class="invalid-feedback">Which activity?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Time:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="time" class="form-control" value="<?php echo $time ?? ''; ?>" required="">                                 
                                  <span class="invalid-feedback">At what time?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Venue:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="venue" class="form-control" value="<?php echo $venue ?? ''; ?>" required="">                                 
                                  <span class="invalid-feedback">What's the venue?</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['program_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="program_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="program_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="program_update" value="Update">  
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
                          <h4>All programs</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-bordered table-md v_center">
                              <tr>
                                  <th>Days</th>
                                  <th>Activities</th>
                                  <th>Time</th>
                                  <th>Venue</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <!-- One Day -->
                              
                              <?php 
                                $days = ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'];

                                for ($i=0; $i < 7; $i++) { 
                                  $program_query = $program->getByDay($days[$i]);
                                    if(is_null($program_query) || empty($program_query))
                                    {
                                      continue;
                                    }
                                ?>
                              <tr>
                                  <td rowspan="<?php echo $program->getNumberOfProgramsByDay($days[$i]); ?>"><?php echo $days[$i]; ?></td>
                              </tr>
                                <?php
                                  while($program_data = mysqli_fetch_assoc($program_query)) {
                                
                               ?>
                              <tr>
                                <td><?=$program_data['activity']; ?></td>
                                <td><?=$program_data['time']; ?></td>
                                <td><?=$program_data['venue']; ?></td> 
                                <td><a href="index.php?program_edit=<?=$program_data['id']; ?>" class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                <td>
                                    <form method="post">
                                      <input type="hidden" name="program_id" value="<?=$program_data['id']; ?>">
                                      <button type="submit" name="program_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>                       
                              </tr>
                            <?php } } ?>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
