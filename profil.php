<?php
// session & koneksi sudah otomatis dari admin.php
$user = $_SESSION['username'];

// ambil data user login
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$hasil = $stmt->get_result();
$user = $hasil->fetch_assoc();
$stmt->close();
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-person-circle"></i> Profile User</h5>
                </div>

                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <!-- Username -->
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" 
                                   value="<?= $user['username']; ?>" readonly>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Kosongkan jika tidak diganti">
                        </div>

                        <!-- Foto -->
                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="foto" class="form-control">
                        </div>

                        <!-- Foto lama -->
                        <div class="mb-3 text-center">
                            <?php if ($user['foto'] != '') { ?>
                                <img src="img/<?= $user['foto']; ?>" 
                                     class="rounded-circle shadow" width="120">
                            <?php } else { ?>
                                <p class="text-muted">Belum ada foto</p>
                            <?php } ?>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="simpan" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
// ===== PROSES SIMPAN =====
if (isset($_POST['simpan'])) {

    // update password jika diisi
    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $stmt = $conn->prepare("UPDATE user SET password=? WHERE username=?");
        $stmt->bind_param("si", $password, $id_user);
        $stmt->execute();
        $stmt->close();
    }

    // update foto jika diupload
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, "img/" . $foto);

        $stmt = $conn->prepare("UPDATE user SET foto=? WHERE username=?");
        $stmt->bind_param("si", $foto, $id);
        $stmt->execute();
        $stmt->close();

        // update session foto
        $_SESSION['foto'] = $foto;
    }

    echo "<script>
        alert('Profile berhasil diperbarui');
        document.location='admin.php?page=profile';
    </script>";
}
?>
