<?php
//query untuk mengambil data article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);
$jumlah_article = $hasil1->num_rows;

//untuk menambah gallery
$sql2 = "SELECT * FROM gallery";
$hasil2 = $conn->query($sql2);
$jumlah_gallery = $hasil2->num_rows;
?>
<div class="text-center mb-4">
    <h4>Selamat Datang,</h4>
    <h2 class="fw-bold"><?= $_SESSION['username']; ?></h2>
    <img src="uploads/<?= $_SESSION['foto']; ?>" 
         class="rounded-circle mt-2" width="120">
</div>
<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <div class="col">
        <div class="card border border-success mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-newspaper"></i> Article</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-success fs-2"><?php echo $jumlah_article; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    <div class="col">
        <div class="card border border-success mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-camera"></i> Gallery</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-success fs-2">
                            <?php echo $jumlah_gallery; ?>
                        </span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>