<style type="text/css">
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

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="box-title">Notify Users</h4>
                </div>
                <div class="card-body">
                    <form class="forms-sample" id="sendNotification">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="notification_topic">Select Topic</label>
                                <select name="notification_topic" class="form-control" id="notification_topic" >
                                <option value="livestream">livestream</option>
                                </select>
                            </div>

                            
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="notification_title">Title</label>
                                <input type="text" name="notification_title" class="form-control" id="notification_title" placeholder="Enter Title">
                            </div>

                            
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="notification_message">Message</label>
                                <textarea type="text" name="notification_message" class="form-control" id="notification_message" placeholder="Enter Message"></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label> Image</label>
                                <input type="file" name="notify_image" class="form-control" id="notify_image">
                                <div id="photo_gallery" class="col-md-10 mt-4" style="display:none;">
                                    
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                            
                            </div>
                        </div>
                        <?php  
                            if($this->session->userdata('admin_id') == 1){ 
                                $disabled = '';
                            }else{
                                $disabled = 'disabled';
                            }
                        ?>
                        <button type="submit" class="btn btn-primary mr-2" <?=$disabled?>>Send</button>
                    </form>
                </div>
            </div>
        </div>
        
  </div>
</section>