<?php
include("koneksi.php");
// query untuk menampilkan data
$sql = 'SELECT * FROM data_barang';
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Data Barang</title>
</head>

<body>
    <div class="container">
        <h1>Data Barang</h1>
        <a href="tambah.php">Tambah Barang</a>
        <div class="main">
            <table>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Katagori</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
                <?php if ($result): ?>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <tr>
                            <?php
                            $gambar = trim((string) $row['gambar']);
                            $src = $gambar !== '' ? $gambar : '';
                            if ($src !== '' && strpos($src, 'gambar/') !== 0) {
                                $src = 'gambar/' . $src;
                            }
                            ?>
                            <td>
                                <?php if ($src !== ''): ?>
                                    <img src="<?= htmlspecialchars($src, ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($row['kategori'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($row['harga_beli'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($row['harga_jual'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?= htmlspecialchars($row['stok'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="ubah.php?id=<?= (int) $row['id_barang']; ?>">Ubah</a>
                                |
                                <a href="hapus.php?id=<?= (int) $row['id_barang']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr>
                        <td colspan="7">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>

</html>