<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <!--col -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="white-box">
                <div class="col-in row">
                    <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E" class="linea-icon linea-basic"></i>
                        <h5 class="text-muted vb">Total Laporan</h5> </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <h3 class="counter text-right m-t-15 text-danger"><?php echo $total; ?></h3> </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <!--col -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="white-box">
                <div class="col-in row">
                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                        <h5 class="text-muted vb">Laporan Baru</h5> </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <h3 class="counter text-right m-t-15 text-megna"><?php echo $new; ?></h3> </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="<?php echo $new; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total; ?>" style="width: 100%"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <!--col -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="white-box">
                <div class="col-in row">
                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                        <h5 class="text-muted vb">Laporan Selesai</h5> </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <h3 class="counter text-right m-t-15 text-primary"><?php echo $done; ?></h3> </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?php echo $done; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total; ?>" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    
    <!-- row -->
    <!-- Postingan -->
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Laporan Terbaru</h3>
                <div class="message-center">

                <?php foreach ($laporan->result() as $key): ?>                                
                    <a href="<?php echo base_url('admin/laporan?id='.$key->id) ?>">
                        <div class="user-img">
                            <img src="<?php echo base_url('uploads/'.$key->file_name) ?>" height="50px">
                        </div>
                        <div class="mail-contnet">
                            <h5><?php echo $key->category_name; ?></h5>
                            <span class="mail-desc"><?php echo $key->description; ?></span>
                            <span class="time"><?php echo $key->created_at; ?></span>
                        </div>
                    </a>
                <?php endforeach ?>

                </div>
            </div>
        </div>

<!-- Komentar -->
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
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
    <!-- /.row -->
</div>
<!-- /.container-fluid -->