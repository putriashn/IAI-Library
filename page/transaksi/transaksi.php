<?php 
require_once 'function.php';
// menampilkan DB buku
// $ambilTransaksi = $conn->query("SELECT * FROM tb_transaksi WHERE status = 'pinjam'") or die(mysqli_error($conn));

$sql = $conn->query("SELECT * FROM tb_transaksi INNER JOIN books
										ON tb_transaksi.id_books = books.id INNER JOIN pengguna
										ON tb_transaksi.id_user = pengguna.id_user WHERE status = 'pinjam'
										") or die(mysqli_error($conn));

?>
<!-- <pre>
	<?php var_dump($pecah); ?>
</pre> -->
<h1 class="mt-4">Riwayat Peminjaman</h1>
<div class="mt-3 mb-2">
    <a href="?p=transaksi&aksi=tambah" class="btn btn-primary mb-3 ml-0" style="background-color: #576CBD;border-color: #576CBD;border-radius: 50px;"><i class="fa fa-plus"></i> Pinjam Buku</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Judul</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Terlambat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($pecah = $sql->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $pecah['username']; ?></td>
                        <td><?= $pecah['title']; ?></td>
                        <td><?= $pecah['tgl_pinjam']; ?></td>
                        <td><?= $pecah['tgl_kembali']; ?></td>
                        <td>
                        	<?php 
                        	$denda = 1000;
                        	$tgl_dateline = $pecah['tgl_kembali'];
                        	$tgl_kembali = date('d-m-Y');

                        	$lambat = terlambat($tgl_dateline, $tgl_kembali);
                        	$denda1 = $lambat * $denda;

                        	if($lambat > 0) { ?>
                        		<div style='color:red;'><?= $lambat ?> hari<br> (Rp. <?= number_format($denda1) ?>)</div>
                        	<?php
                        	} else {
                        		echo $lambat . " Hari";
                        	}
                        	?>
                        </td>
                        <td><?= $pecah['status']; ?></td>
                        <td>
                            <a href="?p=transaksi&aksi=kembali&id=<?= $pecah['id_transaksi']; ?>&judul=<?= $pecah['title']; ?>" class="btn btn-sm btn-primary" style="border-radius: 50px;">Kembalikan</a>
                            <!-- <a href="?p=transaksi&aksi=perpanjang&id=<?= $pecah['id_transaksi']; ?>&judul=<?= $pecah['title']; ?>&lambat=<?= $lambat ?>&tgl_kembali=<?= $pecah['tgl_kembali']; ?>" class="btn btn-success btn-sm" style="border-radius: 50px;">Perpanjang</a> -->
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>