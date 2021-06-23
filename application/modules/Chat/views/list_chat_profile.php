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

.remove_img {
	color: #ffa117 !important;
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
              <h4>Chat Profile List (<span class="total_chat_profile"><?=$total_chat_profile?></span>)</h4>
            </div>
            <div class="card-body">
              <div class="pull-right">
                <div class="buttons"> 
                  <button class="btn btn-primary text-light" data-toggle="modal" data-target="#ChatProfileModal" data-whatever="@mdo" <?=$disabled?> >Add Chat Profile</button>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped" id="chat-profile-listing">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Bio</th>
                      <th>Profile Image</th>
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

<div class="modal fade" id="ChatProfileModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel"> Add Chat Profile </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addUpdateChatProfile" method="post" enctype="multipart">
        <div class="modal-body">


        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" placeholder="Name" class="form-control form-control-danger">
          </div>

          <div class="form-row">
              <div class="col-md-8">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="profile_image">Add Image</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control profile_image custom_image" />
                  </div>
                  <div id="photo_gallery" class="col-md-6 mt-4">
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="bio">Bio</label>
              <textarea id="bio" name="bio" class="form-control form-control-danger"></textarea>
            </div>

          </div>

          <div class="modal-footer">
              <input type="hidden" name="profile_id" id="profile_id" value="">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>