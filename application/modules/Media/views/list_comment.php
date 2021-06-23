<?php  
  if($this->session->userdata('admin_id') == 1){ 
    $disabled = '';
  }else{
    $disabled = 'disabled';
  }
?>
<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Comment List (<span class="total_comment"><?=$total_comment?></span>)</h4>
          </div>
          <div class="card-body">
            <div class="pull-right">
              <div class="buttons"> 
                <button class="btn btn-primary text-light" data-toggle="modal" data-target="#CommentModal" data-whatever="@mdo" <?=$disabled?>>Add Comment</button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped" id="comment-listing">
                <thead>
                  <tr>
                    <th>Comment</th>
                    <th>Country Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="CommentModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel"> Add Comment </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addUpdateComment" method="post" enctype="multipart">
        <div class="modal-body">

          <div class="form-group">
            <label for="comment">Comment</label>
            <input id="comment" name="comment" type="text" class="form-control form-control-danger">
          </div>

          <div class="form-group">
              <label for="country_id">Select Country</label>
              <select class="form-control form-control-lg" id="country_id" name="country_id">
                <option value="">Select</option>
                <?php foreach($CountryData as $value){  ?>
                    <option value="<?= $value['country_id']?>"><?= $value['country']?></option>
                <?php } ?>
              </select>
          </div>

          <div class="modal-footer">
              <input type="hidden" name="comment_id" id="comment_id" value="">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>