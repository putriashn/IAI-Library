<?php 
// menangkap id_buku di url
$id_anggota = $_GET['id'];

$conn->query("DELETE FROM pengguna WHERE id_user = $id_anggota") or die(mysqli_error($conn));
echo "<script>alert('Data Berhasil Dihapus.');window.location='?p=anggota';</script>";

?>