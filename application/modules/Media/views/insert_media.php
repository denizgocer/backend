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
          <form class="forms-sample" id="addUpdateMedia"> 
            
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="video_file">Add Video</label>
                    <input type="file" name="video_file" id="video_file" class="form-control video_file custom_image" />
                  </div>
                  <div id="video_preview" class="col-md-6 mt-4">
                    
                  </div>
                  <input type="hidden" name="hidden_video_file" id="hidden_video_file" value="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="thumb_image">Add Thumbnail</label>
                    <input type="file" name="thumb_image" id="thumb_image" class="form-control thumb_image custom_image" />
                  </div>
                  <div id="thumb_preview" class="col-md-6 mt-4">
                    
                  </div>
                  <input type="hidden" name="hidden_thumb_image" id="hidden_thumb_image" value="">
                </div>
              </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="media_name">Name</label>
                  <input type="text"  name="media_name" class="form-control" id="media_name" placeholder="Name" value="">
                </div>

                <div class="form-group col-md-6">
                  <label for="country_id">Select Country</label>
                  <select class="form-control form-control-lg" id="country_id" name="country_id">
                    <option value="">Select</option>
                    <?php foreach($CountryData as $value){  ?>
                        <option value="<?= $value['country_id']?>"><?= $value['country']?></option>
                    <?php } ?>
                  </select>
                </div>
                
            </div>

            <div class="form-row">

              <div class="form-group col-md-6">
                <label for="bio">Bio</label>
                <textarea name="bio" class="form-control" id="bio" ></textarea>
              </div>

              <div class="form-group col-md-6">
                <label for="rate">Rate</label>
                <input type="number" min="0"  name="rate" class="form-control" id="rate" placeholder="Rate" value="">
              </div>
            </div>

            </div>

            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group col-md-4">
                  <label for="media_images">Add Image Gallery</label>
                  <input type="file" name="media_images[]" id="media_images" class="form-control media_images custom_image" multiple/>
                </div>
                <div id="photo_gallery" class="row">
                  
                </div>
                <input type="hidden" name="hidden_media_images" id="hidden_media_images" value="">

              </div>

              <div class="col-md-6">
                <div class="form-group col-md-4">
                  <label for="media_videos">Add Video Gallery</label>
                  <input type="file" name="media_videos[]" id="media_videos" class="form-control media_videos custom_image" multiple/>
                </div>
                <div id="video_gallery" class="row">
                  
                </div>
                <input type="hidden" name="hidden_media_videos" id="hidden_media_videos" value="">             
              </div>
            </div>


            <input type="hidden" name="action" id="action" value="add">
            <input type="hidden" name="media_id" id="media_id" value="0">
            <button type="submit" class="btn btn-primary mr-2 mt-4">Submit</button>
            <a class="btn btn-light mt-4" href="<?php echo base_url().'admin/media/list';?>">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  </div>
</section>