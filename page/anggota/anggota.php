<?php 
// menampilkan DB buku
$ambilAnggota = $conn->query("SELECT * FROM pengguna ORDER BY id_user DESC") or die(mysqli_error($conn));

?>
<h1 class="mt-4">Data Anggota</h1>

    <a href="?p=anggota&aksi=tambah" class="btn btn-primary mb-4 mt-3" style="background-color: #576CBD; border-color: #576CBD;border-radius: 50px;"><i class="fa fa-plus"></i> Tambah Anggota</a>
    <!-- <a href="./laporan/laporan_anggota_excel.php" target="_blank" class="btn btn-success mb-3"><i class="fa fa-file-excel"></i>
 Export to Excel</a>
 <a href="./laporan/laporan_anggota_pdf.php" target="_blank" class="btn btn-danger mb-3"><i class="fa fa-file-pdf"></i>
 Export to PDF</a> -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data Anggota
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($pecahAnggota = $ambilAnggota->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $pecahAnggota['username']; ?></td>
                        <td><?= $pecahAnggota['password']; ?></td>
                        <td>
                            <a href="?p=anggota&aksi=hapus&id=<?= $pecahAnggota['id_user']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash" onclick="return confirm('Yakin ingin menghapus anggota?')"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>