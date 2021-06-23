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
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>Admob</h4>
        </div>
        <form class="forms-sample" id="addUpdateAdmob"> 
          <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="publisher_id">Publisher Id</label>
                  <input type="text"  name="publisher_id" class="form-control" id="publisher_id" placeholder="Publisher Id" value="<?= ($SettingData['admob_publisher_id']) ? $SettingData['admob_publisher_id'] : "" ?>">
                </div>

                <div class="form-group col-md-6">
                  <label for="banner_id">Banner Id</label>
                  <input type="text"  name="banner_id" class="form-control" id="banner_id" placeholder="Banner Id" value="<?= ($SettingData['admob_banner_id']) ? $SettingData['admob_banner_id'] : "" ?>">
                </div>            
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="interestial_id">Interestial Id</label>
                  <input type="text"  name="interestial_id" class="form-control" id="interestial_id" placeholder="Interestial Id" value="<?= ($SettingData['admob_interestial_id']) ? $SettingData['admob_interestial_id'] : "" ?>">
                </div>

                <div class="form-group col-md-6">
                  <label for="rewarded_id">Rewarded Id</label>
                  <input type="text"  name="rewarded_id" class="form-control" id="rewarded_id" placeholder="Rewarded Id" value="<?= ($SettingData['admob_rewarded_id']) ? $SettingData['admob_rewarded_id'] : "" ?>">
                </div>            
            </div>
          </div>
          <div class="card-footer text-right">
            <input type="hidden" name="hidden_id" class="hidden_id" value="<?= ($SettingData['id']) ? $SettingData['id'] : "" ?>">
            <button class="btn btn-primary" <?=$disabled?>>Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>Facebook</h4>
        </div>
        <form class="forms-sample" id="addUpdateFacebook"> 
          <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="banner_id">Banner Id</label>
                  <input type="text"  name="banner_id" class="form-control" id="banner_id" placeholder="Banner Id" value="<?= ($SettingData['fb_banner_id']) ? $SettingData['fb_banner_id'] : "" ?>">
                </div> 
                <div class="form-group col-md-6">
                  <label for="interestial_id">Interestial Id</label>
                  <input type="text"  name="interestial_id" class="form-control" id="interestial_id" placeholder="Interestial Id" value="<?= ($SettingData['fb_interestial_id']) ? $SettingData['fb_interestial_id'] : "" ?>">
                </div>           
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="rewarded_id">Rewarded Id</label>
                <input type="text"  name="rewarded_id" class="form-control" id="rewarded_id" placeholder="Rewarded Id" value="<?= ($SettingData['fb_rewarded_id']) ? $SettingData['fb_rewarded_id'] : "" ?>">
              </div>            
            </div>
          </div>
          <div class="card-footer text-right">
            <input type="hidden" name="hidden_id" class="hidden_id" value="<?= ($SettingData['id']) ? $SettingData['id'] : "" ?>">
            <button class="btn btn-primary" <?=$disabled?>>Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>Other Settings</h4>
        </div>
        <form class="forms-sample" id="addUpdateOther"> 
          <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="video_ad_bonus">Video Ad Bonus</label>
                  <input type="text"  name="video_ad_bonus" class="form-control" id="video_ad_bonus" placeholder="Video Ad Bonus" value="<?= ($SettingData['video_ad_bonus']) ? $SettingData['video_ad_bonus'] : "" ?>">
                </div> 
                <div class="form-group col-md-4">
                  <label for="log_in_bonus">Log In Bonus</label>
                  <input type="text"  name="log_in_bonus" class="form-control" id="log_in_bonus" placeholder="Log In Bonus" value="<?= ($SettingData['log_in_bonus']) ? $SettingData['log_in_bonus'] : "" ?>">
                </div>  
                <div class="form-group col-md-4">
                <label for="refer_friend_bonus">Refer Friend Bonus</label>
                <input type="text"  name="refer_friend_bonus" class="form-control" id="refer_friend_bonus" placeholder="Refer Friend Bonus" value="<?= ($SettingData['refer_friend_bonus']) ? $SettingData['refer_friend_bonus'] : "" ?>">
              </div>             
            </div>

            <div class="form-row">
              
              <div class="form-group col-md-6">
                <label for="seconds_for_ad">Seconds for ad</label>
                <input type="text"  name="seconds_for_ad" class="form-control" id="seconds_for_ad" placeholder="Seconds for ad" value="<?= ($SettingData['seconds_for_ad']) ? $SettingData['seconds_for_ad'] : "" ?>">
              </div> 
              <div class="form-group col-md-6">
                <label for="seconds_for_call">Seconds for call</label>
                <input type="text"  name="seconds_for_call" class="form-control" id="seconds_for_call" placeholder="Seconds for call" value="<?= ($SettingData['seconds_for_call']) ? $SettingData['seconds_for_call'] : "" ?>">
              </div>              
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="razorpay_key_id">Razorpay Key ID</label>
                <input type="text"  name="razorpay_key_id" class="form-control" id="razorpay_key_id" placeholder="Razorpay Key ID" value="<?= ($SettingData['razorpay_key_id']) ? $SettingData['razorpay_key_id'] : "" ?>">
              </div>    
              <div class="form-group col-md-6">
                <label for="razorpay_key_secret">Razorpay Key Secret</label>
                <input type="text"  name="razorpay_key_secret" class="form-control" id="razorpay_key_secret" placeholder="Razorpay Key Secret" value="<?= ($SettingData['razorpay_key_secret']) ? $SettingData['razorpay_key_secret'] : "" ?>">
              </div>            
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="more_apps_url">More apps url</label>
                <input type="text"  name="more_apps_url" class="form-control" id="more_apps_url" placeholder="More apps url" value="<?= ($SettingData['more_apps_url']) ? $SettingData['more_apps_url'] : "" ?>">
              </div>    
              <div class="form-group col-md-6">
                <label for="privacy_policy">Privacy Policy</label>
                <input type="text"  name="privacy_policy" class="form-control" id="privacy_policy" placeholder="Privacy Policy" value="<?= ($SettingData['privacy_policy']) ? $SettingData['privacy_policy'] : "" ?>">
              </div>            
            </div>

          </div>
          <div class="card-footer text-right">
            <input type="hidden" name="hidden_id" class="hidden_id" value="<?= ($SettingData['id']) ? $SettingData['id'] : "" ?>">
            <button class="btn btn-primary" <?=$disabled?>>Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>