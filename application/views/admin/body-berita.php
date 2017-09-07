<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Berita</h4>
        </div>
    </div>
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
    <?php if ($this->input->get('action') == 'add' || $this->input->get('update') != ''): ?>

    <div class="col-xs-12">
            <div class="white-box">
                <div class="">
                    <div class="overlay-box">
                        <div class="user-content">
                            <form class="form-horizontal form-material" action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-12">Judul</label>
                                    <div class="col-md-12">
                                        <?php if (isset($row->title)): ?>
                                            <input type="text" value="<?php echo $row->title ?>" name="title" class="form-control form-control-line" required>
                                        <?php else: ?>
                                            <input type="text" name="title" class="form-control form-control-line" required>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-text" class="col-md-12">Isi berita</label>
                                    <div class="col-md-12">
                                        <?php if (isset($row->description)): ?>
                                           <textarea rows="10" name="deskripsi" class="form-control form-control-line" required><?php echo $row->description ?></textarea>
                                        <?php else: ?>
                                            <textarea rows="10" name="deskripsi" class="form-control form-control-line" required></textarea>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Gambar</label>
                                    <div class="col-md-12">

                                        <?php if (isset($row->file_name)): ?>
                                            <img src="<?php echo base_url('uploads/'.$row->file_name); ?>" width="75px">
                                            <br><br>

                                        <input type="hidden" name="input_file_old" value="<?php echo $row->file_name ?>"> 
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

    <?php else: ?>        

        <div class="col-xs-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="75px">ID</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th width="170px">#</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($query->result() as $key): ?>

                            <tr>
                                <td width="75px"><?php echo $key->id; ?></td>

                                <?php if ($key->file_name != 'null'): ?>
                                    <td><img src="<?php echo base_url('uploads/'.$key->file_name); ?>" width="75px"></td>                            
                                <?php else: ?>
                                    <td><?php echo $key->file_name; ?></td>
                                <?php endif ?>

                                <td><?php echo $key->title; ?></td>
                                <td><?php echo substr($key->description,0,100); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo base_url('admin/berita?update='.$key->id); ?>" class="btn btn-success">Perbarui</a>
                                    </div>

                                    <div class="btn-group">
                                        <a href="<?php echo base_url('admin/berita?delete='.$key->id); ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            
                        <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
                    <div class="row">
                        <a href="<?php echo base_url('admin/berita?action=add'); ?>" class='btn btn-primary'>Tambah Berita</a>
                    </div>
            </div>
            </div>
    <?php endif ?>
        </div>


    <!-- /.row -->
</div>