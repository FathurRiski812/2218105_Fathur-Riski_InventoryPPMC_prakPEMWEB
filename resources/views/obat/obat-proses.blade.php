<?php 
include '../koneksi.php';

function upload() {
    $namaFile = $_FILES['Photo']['name'];
    $error = $_FILES['Photo']['error'];
    $tmpName = $_FILES['Photo']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4) {
        echo "
            <script>
                alert('Gambar Harus Diisi');
                window.location = 'obat-entry.php';
            </script>
        ";

        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstentiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstentiGambarValid)) {
        echo "
            <script>
                alert('File Harus Berupa Gambar');
                window.location = 'obat-entry.php';
            </script>
        ";

        return null;
    }

    // lolos pengecekan, upload gambar
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    $oke =  move_uploaded_file($tmpName, '../img_categories/' . $namaFileBaru);
    return $namaFileBaru;

}

if(isset($_POST['simpan'])) {
    $Nama_Obat = $_POST['Nama_Obat'];
    $Harga = $_POST['Harga'];
    $Deskripsi = $_POST['Deskripsi'];
    $Photo = upload();

    if(!$Photo) {
        return false;
    }

    $sql = "INSERT INTO tb_obat VALUES(NULL, '$Photo', '$Nama_Obat', '$Harga','$Deskripsi')";

    if(empty($Nama_Obat) || empty($Harga)|| empty($Deskripsi)) {
        echo "
            <script>
                alert('Pastikan Anda Mengisi Semua Data');
                window.location = 'obat-entry.php';
            </script>
        ";
    }elseif(mysqli_query($koneksi, $sql)) {
        echo "
            <script>
                alert('Data Obat Berhasil Ditambahkan');
                window.location = 'index.php'
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Terjadi Kesalahan');
                window.location = 'obat-entry.php'
            </script>
        ";
    }
}elseif(isset($_POST['edit'])) {
    $id         = $_POST['id'];
    $Nama_Obat = $_POST['nama_obat'];
    $Harga     = $_POST['harga'];
    $Deskripsi = $_POST['deskripsi'];
    $photoLama = $_POST['photoLama'];

    // cek apakah user pilih gambar atau tidak
    if($_FILES['photo']['error']) {
        $photo = $photoLama;
    }else {
        // foto lama akan dihapus dan diganti foto baru
        unlink('../img_categories/' . $photoLama);
        $photo = upload();
    }

    $sql = "UPDATE tb_obat SET 
            Photo = '$photo',
            Nama_Obat = '$Nama_Obat',
            Harga = '$Harga',
            Deskripsi = '$Deskripsi'
            WHERE id = $id";

    if(mysqli_query($koneksi, $sql)) {
        echo "
            <script>
                alert('Data Obat Berhasil Diubah');
                window.location = 'index.php';
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Terjadi Kesalahan');
                window.location = 'obat-edit.php';
            </script>
        ";
    }
}elseif(isset($_POST['hapus'])) {
    $id = $_POST['id'];

    // hapus gambar
    $sql = "SELECT * FROM tb_obat WHERE id = $id";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $photo = $row['Photo'];
    unlink('../img_categories/' . $photo);
    

    $sql = "DELETE FROM tb_obat WHERE id = $id";
    if(mysqli_query($koneksi, $sql)) {
        echo "
            <script>
                alert('Data Obat Berhasil Dihapus');
                window.location = 'index.php';
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Data Obat Gagal Dihapus');
                window.location = 'index.php';
            </script>
        ";
    }
}else {
    header('location: obat.php');
}
