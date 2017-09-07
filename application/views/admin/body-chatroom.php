<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Chatroom</h4>
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="75px">ID</th>
                                        <th>Judul</th>
                                        <th>Tanggal Dibuat</th>
                                        <th width="150px">#</th>
                                    </tr>
                                </thead>
                                <tbody class="scroll">

                                <?php foreach ($query->result() as $key): ?>

                                    <tr>
                                        <td width="75px"><?php echo $key->id; ?></td>
                                        <td><?php echo $key->title; ?></td>
                                        <td><?php echo $key->created_at; ?></td>
                                        <td>
                                        <div class="btn-group">
                                            <a href="<?php echo base_url('admin/chatroom?id='.$key->id); ?>" class="btn btn-success">Lihat</a>
                                        </div>

                                        <div class="btn-group">
                                            <a href="<?php echo base_url('admin/chatroom?delete='.$key->id); ?>" class="btn btn-danger">Hapus</a>
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
    <!-- Komentar -->

    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->