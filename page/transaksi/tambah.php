<?php 
// menampilkan judul buku di TB_buku di bagian option pilih buku
$tampilNamaBuku = $conn->query("SELECT * FROM books ORDER BY title ASC") or die(mysqli_error($conn));

// menampilkan nama anggota & nim di TB_anggota di bagian option pilih anggota
$tampilNamaAnggota = $conn->query("SELECT * FROM pengguna ORDER BY username ASC") or die(mysqli_error($conn));

// $sql = $conn->query("SELECT * FROM tb_buku INNER JOIN tb_anggota ON tb_buku.id_buku = tb_anggota.id_anggota") or die(mysqli_error($conn));

$tgl_pinjam = date('d-m-Y');
$tujuh_hari = mktime(0,0,0, date('n'), date('j') + 7, date('Y'));
$kembali = date('d-m-Y', $tujuh_hari);

if(isset($_POST['tambah'])) {
    
    $tgl_pinjam = htmlspecialchars($_POST['tgl_pinjam']);
    $tgl_kembali = htmlspecialchars($_POST['tgl_kembali']);
    
    // $nama_buku = $_POST['buku'];
    // $pecahB = explode(".", $nama_buku);
    // $judul = $pecahB[0];
    $nama_buku = $_POST['buku'];
    $pecahB = explode(".", $nama_buku);
    $id = $pecahB[0];
    $judul = $pecahB[1];
    // var_dump($id); 
    // var_dump($judul); die;

    // $nama_anggota = $_POST['nama'];
    // $pecahN = explode(".", $nama_anggota);
    // $nim = $pecahN[0];
    $nama_anggota = $_POST['nama'];
    $pecahN = explode(".", $nama_anggota);
    $id_user = $pecahN[0];


    $sql = $conn->query("SELECT * FROM books WHERE title = '$judul'") or die(mysqli_error($conn));
    while($data = $sql->fetch_assoc()) {
        $sisa = $data['stock'];

        if($sisa == 0) {
            echo "<script>alert('Stok Buku Habis, Transaksi, tidak dapat dilakukan, silahkan tambahkan stok buku dulu.');window.location='?p=transaksi&aksi=tambah';</script>";
        } else {
            $conn->query("INSERT INTO tb_transaksi VALUES(null, '$id', '$id_user', '$tgl_pinjam', '$tgl_kembali', 'pinjam')") or die(mysqli_error($conn));
            $conn->query("UPDATE books SET stock = (stock-1) WHERE id = '$id'") or die(mysqli_error($conn));
            echo "<script>alert('Data transaksi berhasil ditambahkan.');window.location='?p=transaksi&aksi=tambah';</script>";
        }
    }
}


?>

<h1 class="mt-4 mb 4">Tambah Data Peminjaman</h1>
<div class="card-header mt-3mb-5">
	
	<form action="" method="post">
    
    <div class="form-group">
        <label class="small mb-1" for="nama_buku">Buku</label>
        <select name="buku" id="nama_buku" class="form-control">
            <option value="">-- Pilih Buku --</option>
            <?php 
            while ($pecahBuku = $tampilNamaBuku->fetch_assoc()) {
                $optionValue = $pecahBuku['id'] . '.' . $pecahBuku['title'];
                $optionText = $pecahBuku['title'];
            
                if ($pecahBuku['stock'] == 0) {
                    $optionText .= ' (Buku sedang dipinjam)';
                } 
            
                if ($pecahBuku['stock'] > 0) {
                    echo "<option value='$optionValue'>$optionText</option>";
                } else {
                    echo "<option value='$optionValue' disabled>$optionText</option>";
                }
            }            
            ?>
        </select>
    </div>

    <div class="form-group">
        <label class="small mb-1" for="nama_anggota">Nama</label>
        <select name="nama" id="nama_anggota" class="form-control">
            <option value="">-- Pilih Anggota --</option>
            <?php 
            while ($pecahAnggota = $tampilNamaAnggota->fetch_assoc()) {
            echo "<option value='$pecahAnggota[id_user]'>$pecahAnggota[username]</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tgl_pinjam">Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" onchange="calculateReturnDate()" value="<?= $tgl_pinjam ?>" onclick="this.type='date'" >
    </div>
    <div class="form-group">
        <label for="tgl_kembali">Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" readonly>
    </div>

    <script>
        function calculateReturnDate() {
            var tglPinjam = document.getElementById("tgl_pinjam").value;
            var tglKembali = new Date(tglPinjam);
            tglKembali.setDate(tglKembali.getDate() + 7);

            var yyyy = tglKembali.getFullYear();
            var mm = String(tglKembali.getMonth() + 1).padStart(2, '0');
            var dd = String(tglKembali.getDate()).padStart(2, '0');

            var formattedDate = yyyy + '-' + mm + '-' + dd;
            document.getElementById("tgl_kembali").value = formattedDate;
        }
    </script>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary float-right mt-4" name="tambah" style="background-color: #576CBD;border-color: #576CBD;border-radius: 50px;">Tambah Data</button>
    </div>
	</form>
</div>