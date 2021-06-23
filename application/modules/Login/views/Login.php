<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Livestream - Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?=base_url();?>assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='<?=base_url();?>assets/img/favicon.ico' />

  <script src="<?=base_url();?>assets/plugins/jquery/jquery.min.js"></script>

</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
              <form class="needs-validation" id="loginform" action="<?php echo base_url().'admin/login.submit' ?>" method="post" novalidate="">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1">
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2">
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="<?=base_url();?>assets/js/app.min.js"></script>
  <!-- Template JS File -->
  <script src="<?=base_url();?>assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="<?=base_url();?>assets/js/custom.js"></script>

  <script>

		var base_url = '<?=base_url();?>';

  </script>

</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>