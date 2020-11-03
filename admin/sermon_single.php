<?php
  $dbConfig->unauthorizedRedirect();
  include '../classes/sermon.php';
  include '../classes/user.php';
  include '../classes/comment.php';
  include '../classes/category.php';

  $sermon_data = mysqli_fetch_assoc($sermon->getOne($_GET['sermon_single']));
  $dbConfig->checkRecordExist($sermon_data);

  $sermon->makePopular($_GET['sermon_single']);
  $sermon->removePopular($_GET['sermon_single']);
  $sermon->deleteOne($_GET['sermon_single']);
  
  $comment->approve_comment($_GET['sermon_single']);
  $comment->disapprove_comment($_GET['sermon_single']);
  $comment->deleteOne($_GET['sermon_single']);
 ?>
    <section class="section">
        <div class="section-header">
            <h1>Sermon: <?php echo $sermon_data['title']; ?></h1>
        </div>
        <div class="section-body">        	
	        <div class="row">
	            <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4>Sermon</h4>
                      </div>
                      <div class="card-body">
                          <table class="table table-striped table-bordered m-auto col-md-8 col-lg-8">
                            <tbody>
                              <tr>
                                  <th>Title:</th>
                                  <td ><?=$sermon_data['title']; ?></td>
                              </tr>
                              <tr>
                                  <th>Sermon Text:</th>
                                  <td ><?=$sermon_data['text']; ?></td>
                              </tr>
                              <tr>
                                  <th>Image:</th>
                                  <td  class="p-3"><img src="../images/sermon_images/<?=$sermon_data['image']; ?>" width="150" alt="<?=$sermon_data['image']; ?>"></td>
                              </tr>
                              <tr>
                                  <th>Link:</th>
                                  <td ><a href="<?=$sermon_data['link']; ?>" target="_blank"><?=$sermon_data['link']; ?></a></td>
                              </tr>
                              <tr>
                                  <th>Category:</th>
                                  <td ><?=$sermon_category->getCategoryName($sermon_data['cat_id']); ?></td>
                              </tr>
                              <tr>
                                  <th>Tags:</th>
                                  <td ><?=$sermon_data['tags']; ?></td>
                              </tr>
                              <tr>
                                  <th>Popular Sermon?:</th>
                                  <td >
                                    <form method="post">
                                      <?php if ($sermon_data['popular']): ?>
                                        <button type="submit" name="remove_popular" class="btn btn-icon icon-left btn-success mt-2" data-toggle="tooltip" data-placement="top" title="Click to Remove from Popular"> Popular
                                        </button>
                                      <?php else: ?>
                                        <button type="submit" name="make_popular" class="btn btn-icon icon-left btn-danger mt-2" data-toggle="tooltip" data-placement="top" title="Click to Make Popular"> Not Popular
                                        </button>
                                      <?php endif ?>                                       
                                    </form>                                  
                                  </td>
                              </tr>
                              <tr>
                              	<th>Created By:</th>
                              	<td ><?=$user->getUserName($sermon_data['user_id']); ?></td>
                              </tr>
                              <tr>
                                  <th>Created At:</th>
                                  <td ><?=date('l jS F\, Y', strtotime($sermon_data['created_at'])); ?></td>
                              </tr>
                              <tr>
                                  <th>Modified At:</th>
                                  <td ><?=date('l jS F\, Y', strtotime($sermon_data['modified_at'])); ?></td>
                              </tr>
                              <?php if ($user->checkUserIsAdmin() || $user->getUserId() == $sermon_data['id']): ?>    
                              <tr>
                                <td width="70" colspan="2" class="text-center buttons">                             
                                  <a href="index.php?sermon_edit=<?=$sermon_data['id']; ?>" class="btn btn-icon btn-warning mt-2"><i class="fas fa-edit"></i> Edit</a>
                                  <button class="btn btn-icon btn-danger mt-2" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash" ></i> Delete</button>
                                </td>                              
                              </tr>
                              <?php endif ?>
                            </tbody>
                          </table>
                      </div>
                  </div>
	            </div>
	        </div>
        </div>

        <div class="section-body">
          <div class="row">              
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4>Comments</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center" id="table-2">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Delete</th>
                                </tr>                                
                              </thead>
                              <tbody>
                                <?php 
                                $comment_query = $comment->getAll($sermon_data['id']);

                                $i = 0;

                                while($comment_data = mysqli_fetch_assoc($comment_query)) {
                                  $i++;
                               ?>
                                <tr>
                                    <td><?=$i; ?></td>
                                    <td><?=$comment_data['name']; ?></td>
                                    <td><?=$comment_data['message']; ?></td>
                                    <td>
                                      <form method="post">
                                        <input type="hidden" name="comment_id" value="<?=$comment_data['id']; ?>">
                                        <?php if ($comment_data['status'] !== 'APPROVED'): ?>
                                          <button type="submit" name="approve_comment" class="btn btn-icon icon-left btn-danger mt-2" data-toggle="tooltip" data-placement="top" title="Click to Approve"> Not Approved
                                          </button>
                                        <?php else: ?>
                                          <button type="submit" name="disapprove_comment" class="btn btn-icon icon-left btn-success mt-2" data-toggle="tooltip" data-placement="top" title="Click to Disapprve"> Approved
                                          </button>
                                        <?php endif ?>                                       
                                      </form>                                  
                                    </td>
                                    <td><?=date('l jS F\, Y', strtotime($comment_data['created_at'])); ?></td>
                                    <td>
                                      <form method="post">
                                        <input type="hidden" name="comment_id" value="<?=$comment_data['id']; ?>">
                                        <button type="submit" name="comment_delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete <?=$sermon_data['title']; ?>'s record?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <?= $sermon_data['title']; ?>'s record?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <form method="post">
                    <button type="submit" name="sermon_delete" class="btn btn-danger">Delete</button>                    
                  </form>
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>