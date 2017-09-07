<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">

</head>
<body>
  <div class="wrapper">
    <form class="form-signin" method="POST">
      <h2 class="form-signin-heading">Please login</h2>
      <hr>
      <input type="text" class="form-control" name="username" placeholder="Username" required />
      <br>
      <input type="password" class="form-control" name="password" placeholder="Password" required/>
      <br>
      <?php echo $msg; ?>
      <br>
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Login</button>
    </form>
  </div>
</body>
</html>