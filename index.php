<?php
include 'config.php';

// Mengambil data produk dari database
$sql = "SELECT * FROM produk ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flora Bliss</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header id="header">
        <nav class="navbar">
            <div class="logo">
                <h2>🌸 Flora Bliss</h2>
            </div>
            <ul class="nav-menu">
                <li><a href="#home" class="nav-link">HOME</a></li>
                <li><a href="#product" class="nav-link">PRODUCT</a></li>
                <li><a href="#feature" class="nav-link">FEATURE</a></li>
                <li><a href="#contact" class="nav-link">CONTACT</a></li>
                <li><a href="admin.php" class="nav-link">ADMIN</a></li>
            </ul>
        </nav>
    </header>

    <!-- Home Section -->
    <section id="home" class="home">
        <div class="home-content">
            <h1>Selamat Datang di Flora Bliss</h1>
            <p>Kami menyediakan berbagai macam bunga segar untuk kebutuhan Anda</p>
            <button class="btn" onclick="document.getElementById('product').scrollIntoView()">Lihat Produk</button>
        </div>
    </section>

    <!-- Product Section -->
    <section id="product" class="product">
        <div class="container">
            <h2>Produk Kami</h2>
            <div class="product-grid">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="product-card">';
                        echo '<div class="product-image">🌸</div>';
                        echo '<h3>' . htmlspecialchars($row['nama_produk']) . '</h3>';
                        echo '<p>' . htmlspecialchars($row['deskripsi']) . '</p>';
                        echo '<span class="price">Rp ' . number_format($row['harga'], 0, ',', '.') . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Tidak ada produk tersedia.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Feature Section -->
    <section id="feature" class="feature">
        <div class="container">
            <h2>Keunggulan Kami</h2>
            <div class="feature-grid">
                <div class="feature-item">
                    <div class="feature-icon">🚚</div>
                    <h3>Pengiriman Cepat</h3>
                    <p>Kami memberikan layanan pengiriman yang cepat dan aman</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🌺</div>
                    <h3>Bunga Segar</h3>
                    <p>Semua bunga kami selalu dalam kondisi segar dan berkualitas</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">💰</div>
                    <h3>Harga Terjangkau</h3>
                    <p>Harga yang kompetitif dengan kualitas terbaik</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2>Hubungi Kami</h2>
            <div class="contact-info">
                <div class="contact-item">
                    <h3>📍 Alamat</h3>
                    <p>Jl. Pertanian No. 123, Bengkalis</p>
                </div>
                <div class="contact-item">
                    <h3>✉️ Email</h3>
                    <p><a href="mailto:flora.bliss123@gmail.com" >flora.bliss123@gmail.com</a></p>
                </div>
                <div class="contact-item">
                    <h3>📞 WhatsApp</h3>
                    <p><a href="https://wa.me/6282322927835">082322927835</a></p>
                </div>
                <div class="contact-item">
                    <h3>📷 Instagram</h3>
                    <p><a href="https://www.instagram.com/flora_bliss123" target="_blank">@flora_bliss</a></p>
                </div>
                <div class="contact-item">
                    <h3>🅵 Facebook</h3>
                    <p><a href="https://www.facebook.com/FloraBliss" target="_blank">FloraBliss</a></p>
                </div>
                <div class="contact-item">
                    <h3>𝕏 Twitter</h3>
                    <p><a href="https://twitter.com/flora_bliss123" target="_blank">flora_bliss123</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Flora Bliss. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
$conn->close();
?>