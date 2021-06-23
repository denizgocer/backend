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
    content: 'Photo';
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

.remove_img {
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
          <form class="forms-sample" id="addUpdateCampaign"> 
            
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="title">Campaign Title</label>
                  <input type="text"  name="title" class="form-control" id="title" placeholder="Campaign Title" value="<?= $CampaignData['title'] ?>" readonly>
                </div>

                <div class="form-group col-md-6">
                  <label for="button_text">Button Text</label>
                  <input type="text"  name="button_text" class="form-control" id="button_text" placeholder="Button Text" value="<?= $CampaignData['button_text'] ?>" readonly>
                </div>
                
            </div>
            <?php 

              if($CampaignData['device_type'] == 3){
                $app_url = explode(',',$CampaignData['link']);
                $andriod_url = $app_url[0];
                $ios_url = $app_url[1];
                $hide = '';
                $hide1 = '';
              }else if($CampaignData['device_type'] == 1){
                $andriod_url = $CampaignData['link'];
                $hide = '';
                $hide1 = 'hide';
              }else if($CampaignData['device_type'] == 2){
                $ios_url = $CampaignData['link'];
                $hide = 'hide';
                $hide1 = '';
              }
            ?>
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group" style="display: flex;">
                  <label class="checkbox-inline chkcontainer">For Andriod
                    <input type="checkbox" value="1" class="device_type" name="device_type[]" <?=($CampaignData['device_type'] == 3 || $CampaignData['device_type'] == 1) ? "checked" : "" ?> disabled>
                    <span class="checkmark"></span>
                  </label>
                  <label class="checkbox-inline chkcontainer ml-3">For Ios
                    <input type="checkbox" value="2" class="device_type" name="device_type[]" <?=($CampaignData['device_type'] == 3 || $CampaignData['device_type'] == 2) ? "checked" : "" ?> disabled>
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="form-group andriod_url <?=$hide?>">
                  <label for="andriod_url">Andriod Url</label>
                  <input type="text" class="form-control" id="andriod_url" name="andriod_url" value="<?=$andriod_url?>" placeholder="Andriod Url" readonly>
                </div>
                <div class="form-group ios_url <?=$hide1?>">
                  <label for="ios_url">Ios Url</label>
                  <input type="text" class="form-control" id="ios_url" name="ios_url" value="<?=$ios_url?>" placeholder="Ios Url" readonly>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="description">Description</label>
                <textarea class="form-control description" id="description" name="description" placeholder="Description" readonly><?=$CampaignData['description']?></textarea>
              </div>
                
            </div>

            <div class="form-row">
              <div class="col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="icon">Icon</label>
					          <div id="icon_preview" class="col-md-6 mt-4">
                    <?php if($CampaignData['icon']){ 
                        $icon = '<img height="150px;" width="150px;" class="displayimg" src="'.base_url().DEFAULT_IMAGE_URL.$CampaignData['icon'].'">';  ?>
                      <div class="borderwrap" data-href="<?php echo base_url().DEFAULT_IMAGE_URL.$CampaignData['icon'] ?>"><div class="filenameupload"><?= $icon ?> </div></div>

                      <?php  } ?>
                  </div>
				        </div>
                  
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="banner_image">Banner Image</label>
					          <div id="banner_preview" class="col-md-6 mt-4">
                    <?php if($CampaignData['banner_image']){ 
                        $banner_image = '<img height="150px;" width="150px;" class="displayimg" src="'.base_url().DEFAULT_IMAGE_URL.$CampaignData['banner_image'].'">';  ?>
                      <div class="borderwrap" data-href="<?php echo base_url().DEFAULT_IMAGE_URL.$CampaignData['banner_image'] ?>"><div class="filenameupload"><?= $banner_image ?> </div></div>

                      <?php  } ?>
                  </div>
				        </div>
                </div>
              </div>
            </div>
            
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="interestial_image">Interestial Image</label>
					          <div id="interestial_preview" class="col-md-6 mt-4">
                    <?php if($CampaignData['interestial_image']){ 
                        $interestial_image = '<img height="150px;" width="150px;" class="displayimg" src="'.base_url().DEFAULT_IMAGE_URL.$CampaignData['interestial_image'].'">';  ?>
                      <div class="borderwrap" data-href="<?php echo base_url().DEFAULT_IMAGE_URL.$CampaignData['interestial_image'] ?>"><div class="filenameupload"><?= $interestial_image ?> </div></div>

                      <?php  } ?>
                  </div>                  
                  </div>
                
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="rewarded_video">Rewarded Video</label>
                  <div id="video_preview" class="col-md-6 mt-4">
                  <?php if($CampaignData['rewarded_video']){ 
                    $video = '<video width="150" height="150" controls> <source src="'.base_url().DEFAULT_IMAGE_URL.$CampaignData['rewarded_video'].'" type="video/mp4"> </video>'; ?>
                  <div class="borderwrap" data-href="<?php echo base_url().DEFAULT_IMAGE_URL.$CampaignData['rewarded_video'] ?>"><div class="filenameupload"><?= $video ?> </div></div>

                  <?php  } ?>
                </div>
                  </div>
                </div>
              </div>
            </div>

            <a class="btn btn-light mt-4" href="<?php echo base_url().'admin/campaign/list';?>">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  </div>
</section>