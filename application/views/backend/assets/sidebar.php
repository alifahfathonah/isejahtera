<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="<?php echo base_url()."admin"; ?>">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-database"></i>
          <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url()."jenis"; ?>"><i class="fa fa-circle-o text-green"></i> Data Jenis</a></li>
          <li><a href="<?php echo base_url()."barang"; ?>"><i class="fa fa-circle-o text-green"></i> Data Barang</a></li>
          <li><a href="<?php echo base_url()."supplier/index"; ?>"><i class="fa fa-circle-o text-green"></i> Data Supplier</a></li>
          <li><a href="<?php echo base_url()."gudang"; ?>"><i class="fa fa-circle-o text-green"></i> Data Gudang</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-money"></i>
          <span>Data Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url()."barang_masuk"; ?>"><i class="fa fa-circle-o text-green"></i> Barang Masuk</a></li>
          <li><a href="<?php echo base_url()."barang_keluar"; ?>"><i class="fa fa-circle-o text-green"></i> Barang Keluar</a></li>
        </ul>
      </li>

      <!-- <li class="treeview">
        <a href="#">
          <i class="fa fa-table"></i>
          <span>Data Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url()."laporan_masuk"; ?>"><i class="fa fa-circle-o text-green"></i> Barang Masuk</a></li>
          <li><a href="<?php echo base_url()."laporan_keluar"; ?>"><i class="fa fa-circle-o text-green"></i> Barang Keluar</a></li>
        </ul>
      </li> -->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>