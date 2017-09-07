<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title"><?php echo $room->title ?></h4>
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
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="table-responsive">
                                <table class="table table-fixed">
                                    <tbody>
                                    <?php foreach ($query->result() as $key): ?>                                
                                    <tr>
                                    <td class="col-xs-12">
                                     <div class="message-center">
                                     <?php if ($key->role == 1): ?>
                                        <div class="mail-contnet" align="right">
                                            <h5><?php echo $key->name; ?></h5>
                                            <span class="time"><?php echo $key->created_at; ?></span>
                                            <span class="mail-desc"><?php echo $key->message; ?></span>
                                        </div>
                                     <?php else: ?>
                                        <div class="user-img">
                                            <img src="<?php echo base_url('uploads/'.$key->avatar) ?>" class="img-circle" height="50px">
                                        </div>
                                        <div class="mail-contnet">
                                            <h5><?php echo $key->name; ?></h5>
                                            <span class="time"><?php echo $key->created_at; ?></span>
                                            <span class="mail-desc"><?php echo $key->message; ?></span>
                                        </div>
                                     <?php endif ?>
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
    </div>
    <!-- /.row -->

        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="white-box">
                <form class="form-horizontal form-material" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-10 col-xs-8">
                            <input type="text" placeholder="Masukan pesan.." name="message" class="form-control" required>
                        </div>
                        <div class="col-sm-2 col-xs-4 btn btn-info">
                            <button class="btn btn-info" class="form-control form-control-line"  type="submit" name='submit'>Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->