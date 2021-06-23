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
              <h4>Offer Coin Packages List (<span class="total_coin_pkg_offer"><?=$total_coin_pkg_offer?></span>)</h4>
            </div>
            <div class="card-body">
              <div class="pull-right">
                <div class="buttons"> 
                  <button class="btn btn-primary text-light" data-toggle="modal" data-target="#OfferCoinPkgModal" data-whatever="@mdo" <?=$disabled?>>Add Offer</button>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped" id="offer-coinpkg-listing">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Coin Amount</th>
                      <th>Price</th>
                      <th>Playstore Id</th>
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


<div class="modal fade" id="OfferCoinPkgModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel"> Add Offer Coin Packages </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addUpdateOfferCoinPkg" method="post" enctype="multipart">
        <div class="modal-body">

          <div class="form-row">
              <div class="col-md-8">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="offer_coin_pkg_image">Add Image</label>
                    <input type="file" name="offer_coin_pkg_image" id="offer_coin_pkg_image" class="form-control offer_coin_pkg_image custom_image" />
                  </div>
                  <div id="photo_gallery" class="col-md-6 mt-4">
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
            <label for="coin_amount">Coin Amount</label>
            <input id="coin_amount" name="coin_amount" type="number" min="0"  placeholder="Coin Amount" class="form-control form-control-danger">
          </div>

          <div class="form-group">
            <label for="price">Price</label>
            <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">₹</div>
            </div>
            <input type="text" name="price" class="form-control" id="price" placeholder="Price" value="">
          </div>
          </div>

          <div class="form-group">
            <label for="playstore_product_id">Playstore Product ID</label>
            <input id="playstore_product_id" name="playstore_product_id" type="text" placeholder="Playstore Product ID" class="form-control form-control-danger">
          </div>

          </div>

          <div class="modal-footer">
              <input type="hidden" name="offer_id" id="offer_id" value="">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>