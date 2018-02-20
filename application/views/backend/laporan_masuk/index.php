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
        <h1>DATA LAPORAN BARANG MASUK</h1>
        <ol class="breadcrumb">
          <li class="fa fa-table">&nbsp; Data Laporan</li>
          <li class="active">Barang Masuk</li>
        </ol><br/>

        <div>
          <!-- <a data-toggle="modal" data-target="#tambah-data">
            <button class="btn btn-success fa fa-plus">&nbsp; Add Data</button>
          </a> -->
          <table border="0" width="100%;">
            <tr>
              <td width="20%;">
                <div class="input-group col-sm-10">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" id="dari" name="dari" class="form-control" placeholder="From">
                </div>      
              </td>

              <td width="20%">
                <div class="input-group col-sm-10">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" id="sampai" name="sampai" class="form-control" placeholder="to">
                </div>      
              </td>

              <td style="float: right;">
                <button style="float: right;" onclick="btnPrint()" class="btn btn-sm btn-info fa fa-print" title="PRINT"></button>
                <i style="float: right;">&nbsp;</i>
                <a href="<?php echo base_url()."barang_masuk/export_excel"; ?>">
                  <button style="float: right;" class="btn btn-sm btn-success fa fa-file-excel-o" title="EXCEL"></button>
                </a>
                <i style="float: right;">&nbsp;</i>
                <a href="<?php echo base_url()."laporan_masuk/export_pdf/"; ?>" target="_blank">
                  <button id="export_pdf" name="export_pdf" style="float: right;" class="btn btn-sm btn-danger fa fa-file-pdf-o" title="PDF"></button>
                </a>
                <input type="button" id="btnpdf" value="a">
              </td>
            </tr>
          </table>
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
                        <th>CREATED AT</th>
                        <th>UPDATED AT</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i=1; foreach($laporan_masuk->result() as $row){ ?>
                      <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row->trans_masuk; ?></td>
                          <td><?php echo $row->nama_barang; ?></td>
                          <td><?php echo $row->jumlah_masuk; ?></td>
                          <td><?php echo $row->tanggal_masuk; ?></td>
                          <td><?php echo $row->created_at; ?></td>
                          <td><?php echo $row->updated_at; ?></td>
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
          'searching'   : false,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : false,
          'destroy'     : true
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
        $('#dari').datepicker({
          format: "yyyy-mm-dd",
          autoclose: true
        });

        $('#sampai').datepicker({
          format: "yyyy-mm-dd",
          autoclose: true
        });



        $.fn.dataTable.ext.search.push(
          function (settings, data, dataIndex) {
              var min = $('#dari').datepicker("getDate");
              var max = $('#sampai').datepicker("getDate");
              var startDate = new Date(data[4]);

              if (min == null && max == null) { return true; }
              if (min == null && startDate <= max) { return true;}
              if (max == null && startDate >= min) {return true;}
              if (startDate >= min && startDate <= max) { return true; }
              return false;
            }
        );


        $("#dari").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        $("#sampai").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        var table = $('#tbl_barang_masuk').DataTable();

        // Event listener to the two range filtering inputs to redraw on input
        $('#dari, #sampai').change(function () {
            table.draw();
        });
        // $.post(<?controller_?>laporan_masuk/export_pdf/+min+max);
    </script>

    <script type="text/javascript">
      $(document).ready(function(){

        $('#btnpdf').click(function(){
            var dari     = $('#dari').datepicker("getDate");
            var sampai   = $('#sampai').datepicker("getDate");
            var base_url = "<?php echo base_url(); ?>";

            var a = dari.getFullYear() + "-" + (dari.getMonth()+1) + "-" + dari.getDate()
            var b = sampai.getFullYear() + "-" + (sampai.getMonth()+1) + "-" + sampai.getDate()
            // var name = $('#name').val();
            //alert(dari);
            $.post(base_url+"laporan_masuk/export_pdf/"+a+"/"+b, function(){
              console.log(base_url+"laporan_masuk/export_pdf/"+a+"/"+b);
            });
        });

      });
    </script>
  </body>
</html>
