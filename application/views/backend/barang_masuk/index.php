<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('backend/assets/link.php'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"; ?>">
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"; ?>">
  </head>

  <body class="hold-transition skin-green-light sidebar-mini">
    <div class="wrapper">
    <!-- start HEADER -->
    <?php $this->load->view('backend/assets/header.php'); ?>    
    <!-- end HEADER -->

    <!-- start SIDERBAR -->
    <?php $this->load->view('backend/assets/sidebar.php'); ?>
    <!-- end SIDERBAR -->

    <!-- start CONTENT -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>DATA BARANG MASUK</h1>
        <ol class="breadcrumb">
          <li class="fa fa-money">&nbsp; Data Transaksi</li>
          <li class="active">Barang Masuk</li>
        </ol><br/>

        <div>
          <a data-toggle="modal" data-target="#tambah-data">
          <!-- <a href="<?php echo base_url()."barang_masuk/detail"; ?>"> --> 
            <button class="btn btn-success fa fa-plus">&nbsp; Add Data</button>
          </a>

          <button style="float: right;" onclick="btnPrint()" class="btn btn-sm btn-info fa fa-print" title="PRINT"></button>
          <i style="float: right;">&nbsp;</i>
          <a href="<?php echo base_url()."barang_masuk/export_excel"; ?>">
            <button style="float: right;" class="btn btn-sm btn-success fa fa-file-excel-o" title="EXCEL"></button>
          </a>
          <i style="float: right;">&nbsp;</i>
          <a href="<?php echo base_url()."barang_masuk/export_pdf"; ?>">
            <button style="float: right;" class="btn btn-sm btn-danger fa fa-file-pdf-o" title="PDF"></button>
          </a>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-success">
              <!-- /.box-header -->
              <div class="box-body">
                <form>
                  <table id="tbl_barang_masuk" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>NO. TRANSAKSI</th>
                        <th>NAMA BARANG</th>
                        <th>JUMLAH MASUK</th>
                        <th>TANGGAL MASUK</th>
                        <!-- <th>CREATED AT</th> -->
                        <!-- <th>UPDATED AT</th> -->
                        <!-- <th>ACTION</th> -->
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i=1; foreach($barang_masuk->result() as $row){ ?>
                      <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row->trans_masuk; ?></td>
                          <td><?php echo $row->nama_barang; ?></td>
                          <td><?php echo $row->jumlah_masuk; ?></td>
                          <td><?php echo $row->tanggal_masuk; ?></td>
                          <!-- <td><?php echo $row->created_at; ?></td> -->
                          <!-- <td><?php echo $row->updated_at; ?></td> -->
                          <!-- <td>
                            <a 
                              href="javascript:;"
                              data-trans_masuk  = "<?php echo $row->trans_masuk; ?>"
                              data-nama_barang  = "<?php echo $row->nama_barang; ?>"
                              data-jumlah_masuk = "<?php echo $row->jumlah_masuk; ?>"
                              data-tanggal      = "<?php echo $row->tanggal_masuk; ?>"
                              data-toggle       = "modal"
                              data-target       = "#edit-data"
                            >
                              <button data-toggle="modal" class="fa fa-pencil btn btn-sm btn-info" title="EDIT"></button>
                            </a>

                            <a
                              href="javascript:;"
                              data-trans_masuk   = "<?php echo $row->trans_masuk; ?>"
                              data-toggle      = "modal"
                              data-target      = "#delete-data"
                            >
                              <button data-toggle="modal" class="fa fa-trash btn btn-sm btn-danger" title="DELETE"></button>
                            </a>
                          </td> -->
                      </tr>
                      <?php $i++; } ?>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- end CONTENT -->

    <!-- start FOOTER -->
    <?php $this->load->view('backend/assets/footer.php'); ?>
    <!-- end FOOTER -->
    </div>



    <?php 
      $kode = "";
      if($this->uri->segment(3) == "edit"){
        $kode = $rc->position_kode;
      }else{
        $kode = generate_barang('trans_masuk', 'barang_masuk', 'TRM');
      }
    ?>
    <!-- Modal Tambah -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambah-data" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title"><i class="fa fa-plus">&nbsp;</i>Add Data</h4>
                </div>

                <form class="form-horizontal" action="<?php echo base_url()."barang_masuk/do_add";?>" method="post" enctype="multipart/form-data" role="form">
                  
                  <div class="modal-body">
                      <div class="form-group">
                          <!-- <label class="col-sm-3 control-label">ID GUDANG</label> -->
                          <div class="col-sm-9">
                              <input type="hidden" value="<?php echo $kode; ?>" class="form-control" name="trans_masuk" placeholder="Tuliskan Transaksi">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 control-label">NAMA BARANG</label>
                          <div class="col-sm-9">
	                          <select name="kode_barang" id="kode_barang" class="form-control" required="required">
	                          	<?php if(count($barang)){ ?>
	                          		<option value="">-- Select Barang --</option>
	                          		<?php foreach($barang as $list){ ?>
	                          			<?php 
	                          				echo "<option value='".$list['kode_barang']."'>".$list['nama_barang']."</option>";
	                          			?>
	                          		<?php } ?>
	                          	<?php } ?>
	                          </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 control-label">JUMLAH MASUK</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" name="jumlah_masuk" placeholder="Tuliskan Jumlah Masuk" required="required">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 control-label">TANGGAL MASUK</label>
                          <div class="col-sm-9">
                              <input type="text" id="datepicker" class="form-control" name="tanggal_masuk" placeholder="Pilih Tanggal Masuk" required="required">
                          </div>
                      </div>
                  </div>

                  <div class="modal-footer">
                      <button class="btn btn-success" type="submit"> SAVE&nbsp;</button>
                      <button type="button" class="btn btn-warning" data-dismiss="modal"> CANCEL</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
    <!-- END Modal Tambah -->



    <!-- Modal Edit -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title"><i class="fa fa-pencil">&nbsp;</i>Edit Data</h4>
                </div>

                <form class="form-horizontal" action="<?php echo base_url()."barang_masuk/do_edit";?>" method="post" enctype="multipart/form-data" role="form">
                  
                  <div class="modal-body">
                      <div class="form-group">
                          <!-- <label class="col-sm-3 control-label">KODE BARANG</label> -->
                          <div class="col-sm-9">
                              <input type="hidden" class="form-control" name="trans_masuk" id="trans_masuk" placeholder="Tuliskan Id">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 control-label">NAMA BARANG</label>
                          <div class="col-sm-9">
	                          <select name="kode_barang" id="kode_barang" class="form-control" required="required">
	                          	<?php if(count($barang)){ ?>
	                          		<option value="">-- Select Barang --</option>
	                          		<?php foreach($barang as $list){ ?>
	                          			<?php 
	                          				echo "<option value='".$list['kode_barang']."'>".$list['nama_barang']."</option>";
	                          			?>
	                          		<?php } ?>
	                          	<?php } ?>
	                          </select>

                            <!-- <?php echo form_dropdown('nama_barang', $nama_barang, set_value('nama_barang', isset($barang['kode_barang']) ? $barang['kode_barang'] : '-'), ['class' => 'form-control']); ?> -->

                            <!-- <div class="form-group has-error">
                              <span class="help-block">
                                <?php echo form_error('kode_barang'); ?>
                              </span>
                            </div> -->
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 control-label">JUMLAH MASUK</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" id="jumlah_masuk" name="jumlah_masuk" placeholder="Tuliskan Jumlah Masuk" required="required">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 control-label">TANGGAL MASUK</label>
                          <div class="col-sm-9">
                              <input type="text" id="update_masuk" class="form-control" name="tanggal_masuk" placeholder="Pilih Tanggal Masuk" required="required">
                          </div>
                      </div>
                  </div>

                  <div class="modal-footer">
                      <button class="btn btn-warning" type="submit"> UPDATE&nbsp;</button>
                      <button type="button" class="btn btn-info" data-dismiss="modal"> CANCEL</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
    <!-- END Modal Edit -->



    <!-- Modal Delete -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delete-data" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title"><i class="fa fa-trash">&nbsp;</i>Delete Data</h4>
                </div>

                <form class="form-horizontal" action="<?php echo base_url()."barang_masuk/do_delete";?>" method="post" enctype="multipart/form-data" role="form">
                  
                  <div class="modal-body">
                      <div class="form-group">
                          <h4 class="col-sm-9 control-label">Apakah Anda Yakin Ingin Delete Data Ini ?</h4>
                          <input type="hidden" class="form-control" id="trans_masuk" name="trans_masuk">
                      </div>
                  </div>

                  <div class="modal-footer">
                      <button class="btn btn-danger" type="submit"> DELETE&nbsp;</button>
                      <button type="button" class="btn btn-info" data-dismiss="modal"> CANCEL</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
    <!-- END Modal Delete -->


    <script>
        $(document).ready(function() {
            // Untuk sunting
            $('#edit-data').on('show.bs.modal', function (event) {
                var div 	= $(event.relatedTarget) // Tombol dimana modal di tampilkan
                var modal  	= $(this)

                // Isi nilai pada field
                modal.find('#trans_masuk').attr("value",div.data('trans_masuk'));
                modal.find('#nama_barang').attr("value",div.data('nama_barang'));
                modal.find('#tanggal_masuk').attr("value",div.data('tanggal_masuk'));
                modal.find('#jumlah_masuk').attr("value",div.data('jumlah_masuk'));
            });


            $('#delete-data').on('show.bs.modal', function (event) {
                var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                var modal          = $(this)

                // Isi nilai pada field
                modal.find('#trans_masuk').attr("value",div.data('trans_masuk'));
            });
        });
    </script>


    <!-- DataTables -->
    <script src="<?php echo base_url()."assets/bower_components/datatables.net/js/jquery.dataTables.min.js"; ?>"></script>
    <script src="<?php echo base_url()."assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"; ?>"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url()."assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"; ?>"></script>
    
    <script>
    $(function () {
      $('#tbl_barang_masuk').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false
      })
    })

    function btnPrint(){
        var divToPrint  = document.getElementById('tbl_barang_masuk');
        var popupWin    = window.open('', '_blank', 'width=700, height=500');
        popupWin.document.open();
        popupWin.document.write('<html>\n\
                                    <head>\n\
                                    </head>\n\n\
                                    <body onload="window.print()">\n\
                                        <h2 align="center">Report Barang</h2>\n\
                                        <table border="1" style="border-collapse: collapse;">\n\
                                            '+ divToPrint.innerHTML +'\n\
                                        </table>\n\
                                    </body>\n\
                                </html>');
        popupWin.document.close();
      }

      //Date picker
      $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
      });

      $('#update_masuk').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
      });
    </script>
  </body>
</html>
