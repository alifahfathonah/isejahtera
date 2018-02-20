<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('backend/assets/link.php'); ?>
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
    		  <h1>Dashboard</h1>
		      <ol class="breadcrumb">
		        <li class="fa fa-home">&nbsp; Dashboard</li>
		      </ol>
		    </section>

		    <!-- Main content -->
		    <section class="content">

		     <!-- Small boxes (Stat box) -->
		      <div class="row">
		        <div class="col-lg-3 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-green">
		            <div class="inner">
		              <h3><?php echo $masuk; ?></h3>

		              <p>
		              	Transaksi Masuk <br/>
		              	<?php 
		              		$now = date("Y-m-d"); 
		              		echo $now;
		              	?>
		              </p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-shopping-cart"></i>
		            </div>
		            <a href="<?php echo base_url()."barang_masuk"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		          </div>
		        </div>
		        <!-- ./col -->
		        <div class="col-lg-3 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-red">
		            <div class="inner">
		              <h3><?php echo $keluar; ?></h3>

		              <p>
		              	Transaksi Keluar <br/>
		              	<?php 
		              		$now = date("Y-m-d"); 
		              		echo $now;
		              	?>
		              </p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-truck"></i>
		            </div>
		            <a href="<?php echo base_url()."barang_keluar"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		          </div>
		        </div>
		        <!-- ./col -->
		      </div> 
		    </section>
		  </div>
		<!-- end CONTENT -->

		<!-- start FOOTER -->
		<?php $this->load->view('backend/assets/footer.php'); ?>
		<!-- end FOOTER -->
		</div>
	</body>
</html>