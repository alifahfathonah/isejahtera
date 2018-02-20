<?php  
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=$title.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>

<table border="1" width="100%">
	<thead>
		<tr>
			<th>NO</th>
			<th>NO TRANSAKSI</th>
			<th>NAMA BARANG</th>
			<th>JUMLAH MASUK</th>
			<th>TANGGAL MASUK</th>
			<th>CREATED AT</th>
			<th>UPDATED AT</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($barang_masuk->result() as $row){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row->trans_masuk; ?></td>
			<td><?php echo $row->nama_barang; ?></td>
			<td><?php echo $row->jumlah_masuk; ?></td>
			<td><?php echo date("Y-m-d", strtotime($row->tanggal_masuk)); ?></td>
			<td><?php echo date("Y-m-d", strtotime($row->created_at)); ?></td>
			<td><?php echo date("Y-m-d", strtotime($row->updated_at)); ?></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>