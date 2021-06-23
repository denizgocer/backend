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
              <h4>Video List (<span class="total_media"><?=$total_media?></span>)</h4>
            </div>
            <div class="card-body">
              <div class="pull-right">
                <div class="buttons"> 
                  <a class="btn btn-primary text-light" href="<?=base_url().'admin/media/ViewAddMedia'?>" <?=$disabled?> >Add Video</a>
                </div>
              </div>
              <div class="card-body">	
                <div class="table-responsive">
                  <table class="table table-striped" id="video-listing">
                    <thead>
                      <tr>
                        <th>Video File</th>
                        <th>Thumbnail</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Bio</th>
                        <th>Rate</th>
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
