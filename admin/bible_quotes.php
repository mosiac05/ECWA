<?php 
  include '../classes/bible_quote.php';

  $bible_quote->insert();

  if(isset($_GET['bible_quote_edit']))
  {
    $bible_quote->update();

    $bible_quote_query = $bible_quote->getOne($_GET['bible_quote_edit']);

    $bible_quote_data = mysqli_fetch_assoc($bible_quote_query);

    $dbConfig->checkRecordExist($bible_quote_data);

    $id = $bible_quote_data['id'];
    $text = $bible_quote_data['text'];
    $verse = $bible_quote_data['verse'];
    $version = $bible_quote_data['version'];
  }

  $bible_quote->deleteOne();
 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['bible_quote_edit']))
              {
                echo "Update Bible Quote";
              }
              else
              {
                echo "Bible Quotes";
              }
             ?>
          </h1>
          <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
              <div class="breadcrumb-item">Bible Quotes</div>
          </div>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                    <form class="needs-validation" novalidate="" method="post">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['bible_quote_edit'])): ?>
                              Update Bible Quote
                            <?php else: ?>
                              Add New Bible Quote
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bible Quote:</label>
                              <div class="col-sm-12 col-md-7">
                                  <textarea name="text" class="summernote-simple form-control" required=""><?php echo $text ?? 'Type the Bible quote here...'; ?></textarea>
                                  <span class="invalid-feedback"></span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Verse:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="verse" class="form-control" value="<?php echo $verse ?? ''; ?>" required="">
                                  <span class="invalid-feedback">From what verse of the Bible?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Version:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="version" class="form-control" value="<?php echo $version ?? ''; ?>" required="">
                                  <span class="invalid-feedback">Which Bible version?</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['bible_quote_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="bible_quote_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="bible_quote_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="bible_quote_update" value="Update">  
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
                          <h4>All Bible Quotes</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Quote</th>
                                  <th>Verse</th>
                                  <th>Version</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <?php 
                                $bible_quote_query = $bible_quote->getAll();

                                $i = 0;

                                while($bible_quote_data = mysqli_fetch_assoc($bible_quote_query)) {
                                  $i++;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$bible_quote_data['text']; ?></td>
                                  <td><?=$bible_quote_data['verse']; ?></td>
                                  <td><?=$bible_quote_data['version']; ?></td>
                                  <td><a href="index.php?bible_quote_edit=<?=$bible_quote_data['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                  <td>
                                    <form method="post">
                                      <input type="hidden" name="bible_quote_id" value="<?=$bible_quote_data['id']; ?>">
                                      <button type="submit" name="bible_quote_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
