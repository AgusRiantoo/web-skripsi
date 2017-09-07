<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pengguna</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <script type="text/javascript">
        function scheduleA(event) {
            // alert(this.options[this.selectedIndex].text);
            window.location = this.options[this.selectedIndex].value
        }
    </script>
    <!-- row -->
    <!-- Postingan -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="white-box">
                <div class="row">
                <div class="hidden-xs-12 col-sm-8">
                    <select onchange="scheduleA.call(this, event)">
                        <option value="">Tampilkan :</option>
                        <option value="?display=10">10</option>
                        <option value="?display=20">20</option>
                        <option value="?display=50">50</option>
                        <option value="?display=100">100</option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <form method="get" action="">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Pencarian..">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
                      </span>
                    </div>
                      </form>
                </div>
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table table-fixed" height="300px">
                                    <thead>
                                        <tr>
                                            <th class="col-xs-1">ID</th>
                                            <th class="col-xs-2">Nama</th>
                                            <th class="col-xs-3">Email</th>
                                            <th class="col-xs-2">Role</th>
                                            <th class="col-xs-2">Status</th>
                                            <th width="col-xs-2">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($user->result() as $key): ?>

                                        <tr>
                                            <td class="col-xs-1">
                                                <a href="<?php echo base_url('admin/user?userid='.$key->id) ?>">
                                                    <?php echo $key->id; ?>   
                                                </a>
                                            </td>
                                            <td class="col-xs-2"><?php echo $key->name; ?></td>
                                            <td class="col-xs-3"><?php echo $key->email; ?></td>
                                            <td class="col-xs-2">
                                                <?php if ($key->role == 1): ?>
                                                    Admin
                                                <?php elseif ($key->role == 3): ?>
                                                    Petugas
                                                <?php else: ?>
                                                    User
                                                <?php endif ?>
                                            </td>
                                            <td class="col-xs-2">
                                                <?php
                                                 if ($key->status == 1) {
                                                    echo "<span class='label label-default'>Aktif</span>"; 
                                                 }else if($key->status == 2){
                                                    echo "<span class='label label-danger'>Diblokir</span>";
                                                 }else{
                                                    echo "<span class='label label-primary'>Belum diverifikasi</span>";
                                                 }
                                                ?>
                                            </td>

                                            <td class="col-xs-2">
                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('admin/user?userid='.$key->id); ?>" class="btn btn-success">Lihat</a>
                                                </div>

                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('admin/user?delete='.$key->id); ?>" class="btn btn-danger">Hapus</a>
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
            </div>
        </div>
    <!-- Komentar -->

    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->