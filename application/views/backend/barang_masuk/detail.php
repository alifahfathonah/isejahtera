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
        <h1>DATA DETAIL MASUK</h1>
        <ol class="breadcrumb">
          <li class="fa fa-money">&nbsp; Data Transaksi</li>
          <li class="active">Barang Masuk</li>
        </ol><br/>

        <div>
          <button class="btn btn-sm btn-success fa fa-plus" onclick="addRow('tbl_gudang')">&nbsp; Add</button>
          <button class="btn btn-sm btn-danger fa fa-trash" onclick="deleteRow('tbl_gudang')">&nbsp; Delete</button>
          <a href="">
            <button class="btn btn-sm btn-info fa fa-save">&nbsp; Save</button>
          </a>

          <button style="float: right;" onclick="btnPrint()" class="btn btn-sm btn-info fa fa-print" title="PRINT"></button>
          <i style="float: right;">&nbsp;</i>
          <button style="float: right;" class="btn btn-sm btn-success fa fa-file-excel-o" title="EXCEL"></button>
          <i style="float: right;">&nbsp;</i>
          <button style="float: right;" class="btn btn-sm btn-danger fa fa-file-pdf-o" title="PDF"></button>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-success">
              <!-- form start -->
              <form class="form-horizontal">
                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-3 control-label">TANGGAL MASUK</label>
                      <div class="col-sm-9">
                          <input type="text" id="datepicker" class="form-control" name="tanggal_masuk" placeholder="Pilih Tanggal Masuk">
                      </div>
                  </div>                  

                  <div class="form-group">
                      <label class="col-sm-3 control-label">NAMA SUPPLIER</label>
                      <div class="col-sm-9">
                        <select name="kode_supplier" id="kode_supplier" class="form-control">
                          <?php if(count($supplier)){ ?>
                            <option value="">-- Select Supplier --</option>
                            <?php foreach($supplier as $list){ ?>
                              <?php 
                                echo "<option value='".$list['kode_supplier']."'>".$list['nama_supplier']."</option>";
                              ?>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-success">
              <!-- form start -->
              <form class="form-horizontal" name="detailForm">
                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-3 control-label">NAMA BARANG</label>
                      <div class="col-sm-9">
                        <select name="kode_barang" onclick="add()" id="kode_barang" class="form-control">
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
                      <label class="col-sm-3 control-label">UNIT</label>
                      <div class="col-sm-9">
                          <select name="unit" class="form-control">
                            <option value="">-- Select Unit --</option> 
                            <option value="PCS">PCS</option>  
                            <option value="DUS">DUS</option>  
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 control-label">HARGA</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" onblur="stopCalc()" onfocus="startCalc()" id="harga" name="harga" placeholder="Tuliskan Harga">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 control-label">JUMLAH</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" onblur="stopCalc()" onfocus="startCalc()" id="jumlah" name="jumlah" placeholder="Tuliskan Jumlah">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 control-label">SUB TOTAL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" value="0" id="sub_total" name="sub_total" readonly="readonly">
                      </div>
                  </div>   
              </form>
            </div>
        </div>
      </section>

      <!-- <div class="col-xs-12">
            <div class="box box-success">
              <!-- /.box-header -->
              <!-- <div class="box-body">
                <form>
                  <table id="tbl_gudang" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>NAMA BARANG</th>
                        <th>UNIT</th>
                        <th>HARGA</th>
                        <th>JUMLAH</th>
                        <th>SUB TOTALaa</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                          <td><input name="chk" type="checkbox" /></td>
                          <td><input type="text" /></td>
                          <td><input type="text" /></td>
                          <td><input type="text" /></td>
                          <td><input type="text" /></td>
                          <td><input type="text" /></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div> -->

          <div class="col-xs-12">
            <div class="box box-success">
              <form>
                <table id="table_temp" class="table table-bordered table-striped table-hover">
                  <input type="button" name="" value="Add Row" id="add_row">

                  <thead>
                    <th width="10">No</th>
                    <th width="70">Nama</th>
                  </thead>
                </table>
              </form>
            </div>  
          </div>
    </div>
    <!-- end CONTENT -->

    <!-- start FOOTER -->
    <?php $this->load->view('backend/assets/footer.php'); ?>
    <!-- end FOOTER -->
    </div>


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
      $('#tbl_gudang').DataTable({
        'paging'      : false,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : false,
        'autoWidth'   : false
      })
    })

    function btnPrint(){
        var divToPrint  = document.getElementById('tbl_barang');
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

      function startCalc(){
        interval = setInterval("calc()", 1);
      }

      function calc(){
        hrg = document.detailForm.harga.value;
        jml = document.detailForm.jumlah.value;

        document.detailForm.sub_total.value = hrg * jml;
      }

      function stopCalc(){
        clearInterval(interval);
      }

      //Date picker
      $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
      });

      function addRow(tableID) {
         var table = document.getElementById(tableID);
         var rowCount = table.rows.length;
         var row = table.insertRow(rowCount);

         var cell1 = row.insertCell(0);
         var element1 = document.createElement("input");
         element1.type = "checkbox";
         element1.name="chkbox[]";
         cell1.appendChild(element1);

         var cell2 = row.insertCell(1);
         var element3 = document.createElement("input");
         element3.type = "text";
         element3.name = "txtbox[]";
         cell2.appendChild(element3);


         var cell3 = row.insertCell(2);
         var element2 = document.createElement("input");
         element2.type = "text";
         element2.name = "txtbox[]";
         cell3.appendChild(element2);

         var cell4 = row.insertCell(3);
         var element2 = document.createElement("input");
         element2.type = "text";
         element2.name = "txtbox[]";
         cell4.appendChild(element2);

         var cell5 = row.insertCell(4);
         var element2 = document.createElement("input");
         element2.type = "text";
         element2.name = "txtbox[]";
         cell5.appendChild(element2);

         var cell6 = row.insertCell(5);
         var element2 = document.createElement("input");
         element2.type = "text";
         element2.name = "txtbox[]";
         cell6.appendChild(element2);
        }

        function deleteRow(tableID) {
          try{
           var table = document.getElementById(tableID);
           var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
              var row = table.rows[i];
              var chkbox = row.cells[0].childNodes[0];

              if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
              }
            }
          }catch(e) {
            alert(e);
          }
        }

        $(document).ready(function(){
          var t       = $('#table_temp').DataTable();
          var counter = 1;

          $('#add_row').on('click', function(){
            t.row.add([
              counter,
              $('#harga').val(),
            ]).draw(true);

            counter++;
          });
        });
    </script>
  </body>
</html>