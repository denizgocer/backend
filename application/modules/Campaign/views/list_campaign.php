<style>
.i-cl-6 {
    color: #1cc100;
    font-size: 22px;
}
.i-cl-1 {
    color: #ee1c25;
    font-size: 22px;
}
</style>
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
              <h4>Campaign List (<span class="total_campaign"><?=$total_campaign?></span>)</h4>
            </div>
            <div class="card-body">
              <div class="pull-right">
                <div class="buttons"> 
                  <a class="btn btn-primary text-light" href="<?=base_url().'admin/campaign/ViewAddCampaign'?>" <?=$disabled?> >Add Campaign</a>
                </div>
              </div>
              <div class="card-body">	
                <div class="table-responsive">
                  <table class="table table-striped" id="campaign-listing">
                    <thead>
                      <tr>
                        <th>Campaign Title</th>
                        <th>Icon</th>
                        <th>Andriod Total Clicks</th>
                        <th>iOS Total Clicks</th>
                        <th>Andriod</th>
                        <th>iOS</th>
                        <th>Status</th>
                        <th>Action</th>
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
