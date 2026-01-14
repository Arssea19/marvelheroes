<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marvel Heroes</title>
    <link rel="icon" href="img/marvel.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <style>
        :root {
        --bg-color: #ffffff;
        --text-color: #000000;
        --card-bg: #f8f9fa;
        }
        [data-theme="dark"] {
        --bg-color: #1e1e1e;
        --text-color: #e0e0e0;
        --card-bg: #2c2c2c;
        }

        [data-theme="dark"] #article {
        color: white !important;
        }
        [data-theme="dark"] .card {
        background-color: #2c2c2c !important;
        color: #e0e0e0 !important;
        }
        body {
        background-color: var(--bg-color);
        color: var(--text-color);
        transition: background-color 0.3s, color 0.3s;
        }
        .card { background-color: var(--card-bg); color: var(--text-color); }
        .footer { background-color: var(--card-bg) !important; }
        .theme-toggle {
        cursor: pointer;
        border: none;
        background: transparent;
        font-size: 20px;
        }
    </style>
  </head>
  <body>
      <!--nav begin-->
      <nav class="navbar navbar-expand-lg bg-success-subtle sticky-top">
        <div class="container">
          <a class="navbar-brand" href="#">Marvel Heroes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
              <li class="nav-item">
                <a class="nav-link" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#article">Article</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#gallery">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php" target="_blank">Login</a>
              </li>
              <button class="theme-toggle me-2" id="darkBtn">🌙</button>
              <button class="theme-toggle" id="lightBtn">☀️</button>
            </ul>
          </div>
        </div>
      </nav>
      <!--nav end-->

      <!--home begin-->
      <section id="home" class="text-center p-5 bg-success text-sm-start">
        <div class="container">
          <div class="d-sm-flex flex-sm-row-reverse align-item-center">
            <img src="img/mcu.jpg" class="img-fluid" width="300">
            <div>
              <h1 class="fw-bold display-4">Marvel Cinematic Universe</h1>
              <h4 class="lead display-6">Website ini menampilkan berbagai karakter dari film Marvel yang terkenal seperti Iron Man, Thor, Captain America, dan lainnya.</h4>
              <span id="tanggal"></span>
              <span id="jam"></span>
            </div>
          </div>
        </div>
      </section>
      <!--home end-->

      <!--article begin-->
      <section id="article" class="text-center p-5">
        <div class="container">
          <h1 class="fw-bold display-4 pb-3">Article</h1>
          <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        while($row = $hasil->fetch_assoc()){
        ?>
        <!--col begin-->
            <div class="col">
            <div class="card h-100">
                    <img src="img/<?=$row["gambar"]?>" class="card-img-top" alt="..."/>
                <div class="card-body">
                    <h5 class="card-title"><?=$row["judul"]?></h5>
                    <p class="card-text"><?=$row["isi"]?></p>
                </div>
                <div class="card-footer">
                    <small class="text-body-secondary"><?=$row["tanggal"]?></small>
                </div>
            </div>
            </div>
        <!--col end-->
        <?php
        }
        ?>
          </div>
        </div>
      </section>
      <!--article end-->

      <!--gallery begin-->
      <section id="gallery" class="text-center p-5 bg-success">
        <div class="container">
          <h1 class="fw-bold display-4 pb-3">Gallery</h1>
          <div id="carouselExampleIndicators" class="carousel slide">
            <?php
            $sql = "SELECT * FROM gallery ORDER BY created_at DESC";
            $hasil = $conn->query($sql);
            $aktif = true;
            ?>
            <div class="carousel-inner">
            <?php while($row = $hasil->fetch_assoc()) { ?>
              <div class="carousel-item <?= $aktif ? 'active' : '' ?>">
                <img src="img/<?= $row['gambar'] ?>" class="d-block w-100">
              </div>
            <?php $aktif = false; } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </section>
      <!--gallery end-->

      <!--footer begin-->
      <footer class="text-center p-5 bg-success-subtle">
        <div>
          <a href="https://www.instagram.com/atharaya_/"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
          <a href="https://wa.me/+628112919194"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
        </div>
        <div>
          Atha Raya Surya Putra &copy; 2025
        </div>
      </footer>
      <!--footer end-->

      <!-- Tombol Back to Top -->
    <button
      id="backToTop"
      class="btn btn-danger rounded-circle position-fixed bottom-0 end-0 m-3 d-none"
    >
      <i class="bi bi-arrow-up" title="Back to Top"></i>
    </button>

    <script type="text/javascript">
      function tampilWaktu() {
      const waktu = new Date();

      const tanggal = waktu.getDate();
      const bulan = waktu.getMonth();
      const tahun = waktu.getFullYear();
      const jam = waktu.getHours();
      const menit = waktu.getMinutes();
      const detik = waktu.getSeconds();

      const arrBulan = ["1", "2", "3", "4","5","6","7","8","9","10","11","12"];

      const tanggal_full = tanggal + "/" + arrBulan[bulan] + "/" + tahun;
      const jam_full = jam + ":" + menit + ":" + detik;

      document.getElementById("tanggal").innerHTML = tanggal_full;
      document.getElementById("jam").innerHTML = jam_full;
      }
      setInterval(tampilWaktu, 1000); 
    </script>
    
    <script type="text/javascript"> 
    const backToTop = document.getElementById("backToTop");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
          backToTop.classList.remove("d-none");
          backToTop.classList.add("d-block");
        } else {
          backToTop.classList.remove("d-block");
          backToTop.classList.add("d-none");
        }
      });

    backToTop.addEventListener("click", function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
    </script>

    <script>
      const darkBtn = document.getElementById("darkBtn");
      const lightBtn = document.getElementById("lightBtn");

      darkBtn.addEventListener("click", () => {
        document.documentElement.setAttribute("data-theme", "dark");
      });

      lightBtn.addEventListener("click", () => {
        document.documentElement.setAttribute("data-theme", "light");
      });
    </script>
  </body>
</html>