<style type="text/css">

  #photo_gallery{
    display:flex;
  }
  #uploadimg, .custom_image {
    overflow: hidden;
    cursor: pointer;
    width: 130px;
    height: 130px !important;
    margin-right: 10px;
    border: none !important;
    border-radius: unset !important;
    padding: unset !important;
  }

  .custom_image:before {
    width: 130px;
    height: 130px !important;
    background-color: #F9F9F9;
    cursor: pointer;
    border: 1px dashed #000;
    border-radius: 8px;
    text-align: center;
    padding: 55px 20px 40px 20px;
    font-size: 16px;
    content: 'Add Photo';
    display: inline-block;
    text-align: center;
  }
  .borderwrap {
    float: left;
    /* border: 1px dashed #000; */
    margin-right: 10px;
    border-radius: 6px;
    position: relative;
  }
  .middle {
	transition: .5s ease;
	opacity: 1;
	position: absolute;
	top: 4px;
  right: -22px;
	transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%)
}

.remove_gallery_img {
  cursor:pointer;
}
/* .vertical {
  border-left: 1px solid #a3a3a3;
  position: absolute;
  top: 25px;
  left: -21px;
  height: 80%;
} */
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
              <h4>Branding Image List (<span class="total_branding_img"><?=$total_branding_img?></span>)</h4>
            </div>
            <div class="card-body">
              <div class="pull-right">
                <div class="buttons"> 
                  <button class="btn btn-primary text-light" data-toggle="modal" data-target="#BrandingImgModal" data-whatever="@mdo" <?=$disabled?>>Add Branding Image</button>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped" id="branding-image-listing">
                  <thead>
                    <tr>
                      <th>Image</th>
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
</section>


<div class="modal fade" id="BrandingImgModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel"> Add Branding Image </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addUpdateBrandingImg" method="post" enctype="multipart">
        <div class="modal-body">

            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="branding_image">Add Images</label>
                <input type="file" name="branding_image[]" id="branding_image" class="form-control branding_image custom_image" multiple/>
                </div>
                
            </div>
            <div class="">
                <div id="photo_gallery" class="row">
                
                </div>
                <input type="hidden" name="hidden_branding_image" id="hidden_branding_image" value="">
            </div>
          </div>

          <div class="modal-footer">
            <input type="hidden" name="branding_id" id="branding_id" value="">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>