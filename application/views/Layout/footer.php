<!-- Footer -->
</div>
<footer class="main-footer">
    <div class="footer-left">
    <small class="font-15">Made With <i class="fa fa-heart cl-danger"></i> In India</small>
    </div>
    <div class="footer-right">
    </div>
</footer>
</div>
</div>
<!-- /Footer -->

<div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
          aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body videodiv">
        <video width="450" height="450" controls>
                        <source src="" type="video/mp4">
                </video>
        </div>
        <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="CountryModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel"> Add Country </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addUpdateCountry" method="post" enctype="multipart">
        <div class="modal-body">

          <div class="form-group">
            <label for="country">Country</label>
            <input id="country" name="country" type="text" class="form-control form-control-danger">
          </div>

          <div class="form-row">
              <div class="col-md-8">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="country_media">Add Image</label>
                    <input type="file" name="country_media" id="country_media" class="form-control country_media custom_image" />
                  </div>
                  <div id="photo_gallery" class="col-md-6 mt-4">
                    
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="modal-footer">
              <input type="hidden" name="country_id" id="country_id" value="">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- /Switcher -->
<script type="text/javascript">
    var base_url = '<?= base_url(); ?>';

</script>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded cl-white theme-bg" href="#page-top">
    <i class="ti-angle-double-up"></i>
</a>

<script src="<?= base_url(); ?>assets/js/app.min.js"></script>
<!-- Bootstrap core JavaScript-->

<script src="<?= base_url(); ?>assets/bundles/datatables/datatables.min.js"></script>

<script src="<?= base_url(); ?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>assets/js/page/datatables.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.validate.js"></script>
<script src="<?= base_url(); ?>assets/bundles/izitoast/js/iziToast.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/sweetalert/js/sweetalert.js"></script>
<script src="<?= base_url(); ?>assets/js/fnStandingRedraw.js"></script>
<script src="<?= base_url(); ?>assets/js/scripts.js"></script>
<script src="<?= base_url(); ?>assets/js/custom.js"></script>

<?php if (!empty($JS)) {
        foreach ($JS as $value) {
    ?>
<script src="<?php echo base_url().$value ?>"></script>
<?php
    }} 
?>

</body>
</html>