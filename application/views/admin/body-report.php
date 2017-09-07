<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Report</h4>
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
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                      </span>
                    </div>
                      </form>
                </div>
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="scroll">
                                        <tr>
                                            <th width="75px">ID</th>
                                            <th>Pelapor</th>
                                            <th>ID Laporan</th>
                                            <th>Pesan</th>
                                            <th>Tanggal</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($user->result() as $key): ?>

                                        <tr>
                                            <td width="75px"><?php echo $key->id; ?></td>
                                            <td><a href="<?php echo base_url('admin/user?userid='.$key->user_id) ?>"><?php echo $key->name; ?></a></td>
                                            <td><a href="<?php echo base_url('admin/laporan?id='.$key->post_id) ?>"><?php echo $key->id; ?></a></td>
                                            <td><?php echo $key->message; ?></td>
                                            <td><?php echo $key->created_at; ?></td>
                                            <td>
                                            <div class="btn-group">
                                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a href="<?php echo base_url('admin/laporan?id='.$key->post_id); ?>">Lihat Laporan</a></li>
                                                  <li><a href="<?php echo base_url('admin/report?delete='.$key->id); ?>">Delete</a></li>
                                                </ul>
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