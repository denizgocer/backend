<style type="text/css">
  .ul-font>li {
    font-weight: 400;
    font-size: 15px;
  }

  .hide{
    display:none;
  }

  .form-group {
    margin-bottom: 15px !important;
  }
  textarea.form-control {
    min-height: 100px !important;
  }
  #photo_gallery,#video_gallery{
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

  .video_file:before, .media_videos:before {
    content: 'Add Video';
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

.remove_img ,.remove_gallery_vid, .remove_gallery_img{
  cursor:pointer;
}

</style>
<section class="section">
  <div class="section-body">

<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="card-header">
          <h4><?=$sub_title?></h4>
        </div>
        <div class="card-body">
          <form class="forms-sample" id="addUpdateMedia"> 
            
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="video_file">Video File</label>
                    <div id="video_preview" class="col-md-6 mt-4">
                    <?php if($MediaData['video']){ 
                        $video = '<video width="150" height="150" controls> <source src="'.base_url().DEFAULT_IMAGE_URL.$MediaData['video'].'" type="video/mp4"> </video>'; ?>
                      <div class="borderwrap" data-href="<?php echo base_url().DEFAULT_IMAGE_URL.$MediaData['video'] ?>"><div class="filenameupload"><?= $video ?> </div></div>

                      <?php  } ?>
                  </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="thumb_image">Video Thumbnail</label>
                    <div id="thumb_preview" class="col-md-6 mt-4">
                    <?php if($MediaData['thumb_img']){ 
                        $thumb_img = '<img height="150px;" width="150px;" class="displayimg" src="'.base_url().DEFAULT_IMAGE_URL.$MediaData['thumb_img'].'">';  ?>
                      <div class="borderwrap" data-href="<?php echo base_url().DEFAULT_IMAGE_URL.$MediaData['thumb_img'] ?>"><div class="filenameupload"><?= $thumb_img ?> </div></div>

                      <?php  } ?>
                  </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="media_name">Name</label>
                  <input type="text"  name="media_name" class="form-control" id="media_name" placeholder="Name" value="<?php echo $MediaData['name']?>" readonly>
                </div>

                <div class="form-group col-md-6">
                  <label for="country_id">Select Country</label>
                  <select class="form-control form-control-lg" id="country_id" name="country_id" readonly>
                    <option value="">Select</option>
                    <?php foreach($CountryData as $value){ 
                        if($value['country_id'] == $MediaData['country_id']){
                          $slected = 'selected';
                        }else{
                          $slected = '';
                        } ?>
                        <option value="<?= $value['country_id']?>" <?php echo $slected ?> ><?= $value['country']?></option>
                    <?php } ?>
                  </select>
                </div>
                
            </div>

            <div class="form-row">

              <div class="form-group col-md-6">
                <label for="bio">Bio</label>
                <textarea name="bio" class="form-control" id="bio" readonly><?php echo $MediaData['bio']?></textarea>
              </div>

              <div class="form-group col-md-6">
                <label for="rate">Rate</label>
                <input type="number" min="0"  name="rate" class="form-control" id="rate" placeholder="Rate" value="<?php echo $MediaData['rate']?>" readonly>
              </div>
            </div>

            </div>
            
            <div class="row">
             
              <div class="col-md-6" style="border-right: 1px solid;">
                <div class="form-group col-md-4">
                    <label for="media_images">Image Gallery</label>
                </div>
                <div id="photo_gallery" class="row">
                  <?php if($MediaData['image_gallery']){
                      $media_images = explode(',',$MediaData['image_gallery']);
                  foreach($media_images as $val){
                    if(!empty($val)){
                        $thumb_img = '<img height="150px;" width="150px;" class="displayimg" src="'.base_url().DEFAULT_IMAGE_URL.$val.'">';  ?>
                        <div class="col-12 col-md-4 col-lg-4 mt-4">
                          <div class="borderwrap" data-href="<?php echo $val ?>"><div class="filenameupload"><?= $thumb_img ?> <div class="middle"><i class="material-icons remove_gallery_img">cancel</i></div> </div></div>
                        </div>
                    <?php } } } ?>
                </div>

              </div>

              <div class="col-md-6">
                <div class="form-group col-md-4">
                  <label for="media_videos">Video Gallery</label>
                </div>
                <div id="video_gallery" class="row">
                  <?php if($MediaData['video_gallery']){
                      $media_images = explode(',',$MediaData['video_gallery']);
                  foreach($media_images as $val){
                    if(!empty($val)){
                      $video = '<video width="150" height="150" controls> <source src="'.base_url().DEFAULT_IMAGE_URL.$val.'" type="video/mp4"> </video>'; ?>
                      <div class="col-12 col-md-4 col-lg-4 mt-4">
                        <div class="borderwrap" data-href="<?php echo $val ?>"><div class="filenameupload"><?= $video ?> <div class="middle"><i class="material-icons remove_gallery_vid">cancel</i></div> </div></div>
                      </div>
                    <?php } } } ?>
                </div>
              </div>
            </div>


            <a class="btn btn-light mt-4" href="<?php echo base_url().'admin/media/list';?>">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  </div>
</section>