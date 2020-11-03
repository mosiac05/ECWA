<?php 
  include '../classes/event.php';

  $event->insert();

  if(isset($_GET['event_edit']))
  {
    $event->update();

    $event_query = $event->getOne($_GET['event_edit']);

    $event_data = mysqli_fetch_assoc($event_query);
    $dbConfig->checkRecordExist($event_data);

    $id = $event_data['id'];
    $title = $event_data['title'];
    $text = $event_data['text'];
    $date = $event_data['date'];
    $image = $event_data['image'];
  }


  $event->deleteOne();

 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['event_edit']))
              {
                echo "Update Event" . $title;
              }
              else
              {
                echo "Events";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">events</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['event_edit'])): ?>
                              Update Event
                            <?php else: ?>
                              Add New Event
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="title" class="form-control" value="<?php echo $title ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Which event?</span>
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
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Date & Time:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="datetime-local" name="date" class="form-control" value="<?php echo $date ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What's the date and time of the event?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image:</label>
                              <div class="col-sm-12 col-md-7">
                                  <?php if (isset($_GET['event_edit'])): ?>
                                    <img src="../images/event_images/<?php echo $image ?? ''; ?>" width='100' alt="<?php echo $image ?? ''; ?>">
                                  <?php endif ?>
                                  <br>
																	<input type="file" name="image" class="form-control" <?php if(!isset($_GET['event_edit'])) { echo "required=''"; } ?>>
                                  <span class="invalid-feedback">Select the image for the event</span>
                              </div> 
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['event_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="event_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="event_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="event_update" value="Update">  
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
                          <h4>All Events</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center" id="table-2">
                              	<thead>		                              		
		                              <tr>
		                                  <th>#</th>
		                                  <th>Title</th>
		                                  <th>Text-to-display</th>
		                                  <th>Date & Time</th>
		                                  <th>Image</th>
		                                  <th>Edit</th>
		                                  <th>Delete</th>
		                              </tr>
                              	</thead>
                              	<tbody>
		                              		<?php 
		                                $event_query = $event->getAll();

		                                $i = 0;

		                                while($event_data = mysqli_fetch_assoc($event_query)) {
		                                  $i++;
		                               ?>
		                              <tr>
		                                  <td><?=$i; ?></td>
		                                  <td><?=$event_data['title']; ?></td>
		                                  <td><?=$event_data['text']; ?></td>
		                                  <td><?=date('l jS F\, Y | g:iA', strtotime($event_data['date'])); ?></td>
		                                  <td><img src="../images/event_images/<?=$event_data['image']; ?>" alt="<?=$event_data['image']; ?>" width="150"></td>
		                                  <td><a href="index.php?event_edit=<?=$event_data['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
		                                  <td>
                                        <form method="post">
                                          <input type="hidden" name="event_id" value="<?=$event_data['id']; ?>">
                                          <button type="submit" name="event_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
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
