<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile Pengguna</h4>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="<?php echo base_url('uploads/'.$user->avatar) ?>"><img src="<?php echo base_url('uploads/'.$user->avatar) ?>" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo $user->name; ?></h4>
                                        <h5 class="text-white"><?php echo $user->email; ?></h5> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form class="form-horizontal form-material" action="" method="post">
                                <div class="form-group">
                                    <label class="col-md-12">Nama Lengkap</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php echo $user->name; ?>" name="name" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" value="<?php echo $user->email; ?>" name="email" class="form-control form-control-line" name="example-email" id="example-email"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Telepon</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php echo $user->phone; ?>" name="phone" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Role</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="role">
                                        <?php if ($user->role == 1): ?>
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
                                            <option value="3">Petugas</option>
                                        <?php elseif ($user->role == 2): ?>
                                            <option value="2">User</option>
                                            <option value="1">Admin</option>
                                            <option value="3">Petugas</option>
                                        <?php else: ?>
                                            <option value="3">Petugas</option>
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
                                        <?php endif ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Status</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="status">
                                        <?php if ($user->status == 0){ ?>
                                            <option value="0">Belum di verifikasi</option>
                                            <option value="1">Aktif</option>
                                            <option value="2">Banned</option>
                                        <?php }else if($user->status == 1){ ?>
                                            <option value="1">Aktif</option>
                                            <option value="2">Banned</option>
                                        <?php }else{ ?>
                                            <option value="2">Banned</option>
                                            <option value="1">Aktif</option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" type="submit" name='submit'>Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>