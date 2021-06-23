<?php  
  if($this->session->userdata('admin_id') == 1){ 
      $disabled = '';
  }else{
      $disabled = 'disabled';
  }
?>
<section class="section">
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-4">
            <div class="card author-box">
                <div class="card-body">
                <div class="author-box-center">
                    <img alt="image" src="<?=base_url().DEFAULT_IMAGE_URL.$profile['profile_image']?>" class="author-box-picture author-box-profile">
                    <div class="clearfix"></div>
                    <div class="author-box-name"><?=$profile['username']?>
                    </div>
                    <div class="author-box-email"><?=$profile['email']?>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                    <div class="padding-20">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active" id="profile-tab2" data-toggle="tab" href="#edit_profile" role="tab"
                                aria-selected="false">Edit Profile</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="edit_profile" role="tabpanel" aria-labelledby="profile-tab2">
                                <form method="post" id="updateAdminProfile" class="needs-validation">
                                    <div class="card-header">
                                    <h4>Edit Profile</h4>
                                    </div>
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                        <label>User Name</label>
                                        <input type="text" class="form-control" name="admin_name" value="<?=$profile['username']?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="<?=$profile['email']?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                        <label>Pssword</label>
                                        <input type="password" class="form-control" name="password" value="<?=$profile['password']?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                        <label>Profile Image</label>
                                        <input type="file" name="profile_image" class="form-control">
                                        <input type="hidden" class="form-control hdn_profile_image" name="hdn_profile_image" value="<?=$profile['profile_image']?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card-footer text-right">
                                    <input type="hidden" class="form-control" name="admin_id" value="<?=$profile['id']?>">
                                    <button class="btn btn-primary" type="submit" <?=$disabled?>>Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
