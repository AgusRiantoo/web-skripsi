<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Kategori</h4>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <form class="form-horizontal form-material" action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-md-12">Nama</label>
                                                <div class="col-md-12">
                                                    <?php if (isset($kategori->name)): ?>
                                                        <input type="text" value="<?php echo $kategori->name ?>" name="nama" class="form-control form-control-line" required>
                                                    <?php else: ?>
                                                        <input type="text" name="nama" class="form-control form-control-line" required>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-text" class="col-md-12">Deskripsi</label>
                                                <div class="col-md-12">
                                                    <?php if (isset($kategori->name)): ?>
                                                        <input type="text" value="<?php echo $kategori->description ?>" name="deskripsi" class="form-control form-control-line" required>
                                                    <?php else: ?>
                                                        <input type="text" name="deskripsi" class="form-control form-control-line" required>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Icon</label>
                                                <div class="col-md-12">
                                        <?php if (isset($kategori->icon)): ?>
                                            <img src="<?php echo base_url('uploads/'.$kategori->icon); ?>" width="75px">
                                            <input type="hidden" name="input_file_old" value="<?php echo $kategori->icon ?>"> 
                                            <br><br>
                                        <?php endif ?>
                                        

                                                    <input type="file" name="input_file" class="form-control form-control-line"> </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-info" type="submit" name='submit'>Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="75px">ID</th>
                                            <th>Icon</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th width="170px">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($query->result() as $key): ?>

                                        <tr>
                                            <td width="75px"><?php echo $key->id; ?></td>
                                            <td><img src="<?php echo base_url('uploads/'.$key->icon); ?>" width="50px"></td>
                                            <td><a href="<?php echo base_url('admin/laporan?category='.$key->id) ?>"><?php echo $key->name; ?></a></td>
                                            <td><?php echo $key->description; ?></td>

                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('admin/kategori?update='.$key->id); ?>" class="btn btn-success">Perbarui</a>
                                                </div>

                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('admin/kategori?delete='.$key->id); ?>" class="btn btn-danger">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>


                <!-- /.row -->
            </div>