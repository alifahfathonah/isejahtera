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
			<th>KODE SUPPLIER</th>
			<th>NAMA SUPPLIER</th>
			<th>NO. TELP</th>
			<th>ALAMAT</th>
			<th>CREATED AT</th>
			<th>UPDATED AT</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach($supplier->result() as $row){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row->kode_supplier; ?></td>
			<td><?php echo $row->nama_supplier; ?></td>
			<td><?php echo $row->no_telp; ?></td>
			<td><?php echo $row->alamat; ?></td>
			<td><?php echo date("Y-m-d", strtotime($row->created_at)); ?></td>
			<td><?php echo date("Y-m-d", strtotime($row->updated_at)); ?></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>