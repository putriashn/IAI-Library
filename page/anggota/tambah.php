<?php 
if(isset($_POST['tambah'])) {
	$username_user = htmlspecialchars($_POST['username']);
	$password_user = htmlspecialchars($_POST['password']);

    if(empty($username_user && $password_user)) {
        echo "<script>alert('Pastikan anda sudah mengisi semua formulir.');window.location='?p=anggota';</script>";
    }

	$sql = $conn->query("INSERT INTO pengguna VALUES (null, '$username_user', '$password_user', 0)") or die(mysqli_error($conn));
    echo "<script>alert('Data berhasil ditambahkan.');window.location='?p=anggota';</script>";
    
	// if($sql) {
	// 	echo "<script>alert('Data Berhasil Ditambahkan.')</script>";
	// } else {
	// 	echo "<script>alert('Data Gagal Ditambahkan.')</script>";
	// }
}

?>

<h1 class="mt-4">Tambah Data Anggota</h1>
<div class="card-header mb-5">
	
	<form action="" method="post">
    <div class="form-group">
        <label class="small mb-1" for="username">Username</label>
        <input class="form-control" id="username" name="username" type="text" placeholder="Masukkan username"/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="nama_anggota">Password</label>
        <input class="form-control" id="password" name="password" type="text" placeholder="Masukan password"/>
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary mt-3" style="background-color: #576CBD;border-radius: 50px;" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>