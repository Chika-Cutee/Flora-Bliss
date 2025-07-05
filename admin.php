<?php
include 'config.php';

// Proses tambah produk
if (isset($_POST['tambah'])) {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    
    $sql = "INSERT INTO produk (nama_produk, deskripsi, harga) VALUES ('$nama_produk', '$deskripsi', '$harga')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Proses hapus produk
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM produk WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil dihapus!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Mengambil semua data produk
$sql = "SELECT * FROM produk ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Flora Bliss</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 100px auto 50px;
            padding: 20px;
        }
        
        .form-container {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #e91e63;
            font-weight: bold;
        }
        
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        
        .btn-submit {
            background: #e91e63;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .btn-submit:hover {
            background: #c2185b;
        }
        
        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background: #e91e63;
            color: white;
        }
        
        tr:hover {
            background: #f5f5f5;
        }
        
        .btn-edit {
            background: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            margin-right: 5px;
        }
        
        .btn-delete {
            background: #f44336;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
        }
        
        .btn-back {
            background: #2196F3;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <a href="index.php" class="btn-back">🏠 Kembali ke Beranda</a>
        
        <h1 style="color: #e91e63; text-align: center; margin-bottom: 30px;">Admin Panel - Kelola Produk</h1>
        
        <!-- Form Tambah Produk -->
        <div class="form-container">
            <h2 style="color: #e91e63; margin-bottom: 20px;">Tambah Produk Baru</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="nama_produk">Nama Produk:</label>
                    <input type="text" id="nama_produk" name="nama_produk" required>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea id="deskripsi" name="deskripsi" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="harga">Harga (Rp):</label>
                    <input type="number" id="harga" name="harga" min="0" step="0.01" required>
                </div>
                
                <button type="submit" name="tambah" class="btn-submit">Tambah Produk</button>
            </form>
        </div>
        
        <!-- Tabel Daftar Produk -->
        <div class="table-container">
            <h2 style="color: #e91e63; padding: 20px; margin: 0;">Daftar Produk</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_produk']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "<td>";
                            echo "<a href='edit.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a>";
                            echo "<a href='admin.php?hapus=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Yakin ingin menghapus produk ini?\")'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align: center;'>Tidak ada produk tersedia</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>