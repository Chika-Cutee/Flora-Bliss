<?php
include 'config.php';

// Mengambil ID produk dari URL
$id = $_GET['id'];

// Proses update produk
if (isset($_POST['update'])) {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    
    $sql = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga='$harga' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil diupdate!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Mengambil data produk berdasarkan ID
$sql = "SELECT * FROM produk WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location.href='admin.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Flora Bliss</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .edit-container {
            max-width: 600px;
            margin: 100px auto 50px;
            padding: 20px;
        }
        
        .form-container {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
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
            margin-right: 10px;
        }
        
        .btn-submit:hover {
            background: #c2185b;
        }
        
        .btn-back {
            background: #2196F3;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        
        .btn-back:hover {
            background: #1976D2;
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h1 style="color: #e91e63; text-align: center; margin-bottom: 30px;">Edit Produk</h1>
        
        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <label for="nama_produk">Nama Produk:</label>
                    <input type="text" id="nama_produk" name="nama_produk" value="<?php echo htmlspecialchars($row['nama_produk']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea id="deskripsi" name="deskripsi" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="harga">Harga (Rp):</label>
                    <input type="number" id="harga" name="harga" value="<?php echo $row['harga']; ?>" min="0" step="0.01" required>
                </div>
                
                <button type="submit" name="update" class="btn-submit">Update Produk</button>
                <a href="admin.php" class="btn-back">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>