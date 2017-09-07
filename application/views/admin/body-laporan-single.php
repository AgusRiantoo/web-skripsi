<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Detail Laporan</h4>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                        <div class="row">
                            <div class="user-bg">
                                <div class="overlay-box">
                                <?php 
                                if ($laporan->file_name == '') {
                                    $file = 'default.jpg';
                                }else{
                                    $file = $laporan->file_name;
                                }
                                
                                ?>
                                   <img src="<?php echo base_url('uploads/'.$file) ?>" width="100%">
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="white-box">
                                <h3 class="box-title">Komentar Terbaru</h3>
                                <div class="message-center">

                                <?php foreach ($komentar->result() as $key): ?>                                
                                    <a href="<?php echo base_url('admin/laporan?id='.$key->post_id) ?>">
                                        <div class="user-img">
                                            <img src="<?php echo base_url('uploads/'.$key->avatar) ?>" class="img-circle" height="50px">
                                        </div>
                                        <div class="mail-contnet">
                                            <h5><?php echo $key->name; ?></h5>
                                            <span class="mail-desc"><?php echo $key->message; ?></span>
                                            <span class="time"><?php echo $key->created_at; ?></span>
                                        </div>
                                    </a>
                                <?php endforeach ?>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form class="form-horizontal form-material" action="" method="post">
                                <div class="form-group">
                                    
                                    <?php if ($laporan->status == 1): ?>
                                    <div class="panel panel-primary">
                                      <div class="panel-heading">
                                        <h3 class="panel-title">Dalam Penanganan</h3>
                                      </div>
                                    </div>
                                    <?php elseif($laporan->status == 2): ?>
                                    <div class="panel panel-success">
                                      <div class="panel-heading">
                                        <h3 class="panel-title">Selesai</h3>
                                      </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="panel panel-info">
                                      <div class="panel-heading">
                                        <h3 class="panel-title">Laporan Baru</h3>
                                      </div>
                                    </div>
                                    <?php endif ?>

                                    <label class="col-xs-12 col-sm-6">Pelapor : <?php echo $laporan->user_name; ?></label>
                                    <p class="col-xs-12 col-sm-6" align="right"><?php echo $laporan->created_at; ?></p>
                                    <p class="col-md-12">Kategori : <?php echo $laporan->category_name; ?></p>
                                    <div class="col-md-12">
                                        <p><?php echo $laporan->description; ?></p>
                                        <hr>
                                        <p>Lokasi : <?php echo $laporan->address; ?></p>
                                        <iframe
                                          width="100%"
                                          height="450"
                                          frameborder="0" style="border:0"
                                          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDGB7xBSpeJvn4WHepaakdhGndx2aNmGYA
                                            &q=<?php echo $laporan->latitude; ?>,<?php echo $laporan->longitude; ?>" allowfullscreen>
                                        </iframe>
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-12">Rubah Status</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="status">
                                            <option value="0">Baru</option>
                                            <option value="1">Di Proses</option>
                                            <option value="2">Selesai</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <button class="btn btn-info" type="submit" name='submit'>Update Laporan</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo base_url('admin/laporan?delete='.$laporan->id); ?>" class="btn btn-danger">Hapus Laporan</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>