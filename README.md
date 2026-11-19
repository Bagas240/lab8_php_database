# Praktikum 8: PHP dan Database MySQL

**Mata Kuliah** : Pemrograman Web OBE
**Program Studi** : Teknik Informatika
**Nama** : Bagas
**NIM** : _(isi NIM)_
**Kelas** : _(isi kelas)_

---

## Daftar Isi

1. [Tujuan](#tujuan)
2. [Persiapan](#persiapan)
3. [Membuat Database](#membuat-database-studi-kasus-data-barang)
4. [Membuat Program CRUD](#membuat-program-crud)
   - [koneksi.php](#1-file-koneksi-database-koneksiphp)
   - [index.php (Read)](#2-menampilkan-data-read--indexphp)
   - [tambah.php (Create)](#3-menambah-data-create--tambahphp)
   - [ubah.php (Update)](#4-mengubah-data-update--ubahphp)
   - [hapus.php (Delete)](#5-menghapus-data-delete--hapusphp)
5. [Struktur Folder](#struktur-folder)
6. [Alur Kerja Aplikasi](#alur-kerja-aplikasi)
7. [Kesimpulan](#kesimpulan)

---

## Tujuan

1. Mahasiswa mampu memahami konsep dasar Database.
2. Mahasiswa mampu memahami konsep dasar CRUD menggunakan PHP.
3. Mahasiswa mampu membuat program CRUD sederhana menggunakan PHP.

**CRUD** adalah singkatan dari empat operasi dasar pada data:

| Operasi | Arti | Perintah SQL | File pada praktikum |
|---------|------|--------------|---------------------|
| **C**reate | Menambah data | `INSERT` | `tambah.php` |
| **R**ead | Menampilkan data | `SELECT` | `index.php` |
| **U**pdate | Mengubah data | `UPDATE` | `ubah.php` |
| **D**elete | Menghapus data | `DELETE` | `hapus.php` |

---

## Persiapan

Alat yang dibutuhkan:

- Text editor (VSCode)
- XAMPP (Apache, MySQL/MariaDB, PHP)
- Browser

Langkah persiapan:

1. Buat folder baru bernama **`lab8_php_database`** pada docroot web server, yaitu `htdocs` (contoh: `d:\xampp\htdocs\lab8_php_database`).
2. Folder tersebut dapat diakses melalui browser di `http://localhost/lab8_php_database/`. Selama belum ada file di dalamnya, browser hanya menampilkan **Index of /lab8_php_database** (halaman daftar direktori Apache).

> 📸 **Screenshot:** Direktori `lab8_php_database` di dalam `htdocs`
> `![Direktori Lab8](screenshots/01-direktori-lab8.png)`

> 📸 **Screenshot:** Tampilan `http://localhost/lab8_php_database/` (Index of)
> `![Tampilan Web](screenshots/02-index-of.png)`

### Menjalankan MySQL Server

1. Buka **XAMPP Control Panel**.
2. Klik **Start** pada modul **Apache** dan **MySQL**.
3. Pastikan kedua modul berstatus hijau (running). Apache berjalan pada port 80/443 dan MySQL pada port 3306.

> 📸 **Screenshot:** XAMPP Control Panel dengan Apache dan MySQL berjalan
> `![XAMPP Control](screenshots/03-xampp-control.png)`

### Mengakses MySQL Client menggunakan phpMyAdmin

Setelah Apache dan MySQL berjalan, buka `http://localhost/phpmyadmin/` melalui browser. phpMyAdmin dipakai untuk membuat database, membuat tabel, dan menjalankan perintah SQL.

---

## Membuat Database: Studi Kasus Data Barang

### Rancangan Tabel

Studi kasus yang dipakai adalah **data barang**. Rancangan field pada modul:

| Nama Field | Tipe Data | Ukuran | Keterangan |
|------------|-----------|--------|------------|
| Id_Barang | INT | 10 | Primary Key, Autoincrement |
| Kategori | Varchar | 30 | |
| Nama | Varchar | 50 | |
| Gambar | Varchar | 100 | |
| Harga_Beli | INT | 8 | |
| Harga_Jual | INT | 8 | |
| Stok | INT | 4 | |

### Membuat Database

```sql
CREATE DATABASE latihan1;
```

Perintah ini membuat database baru bernama `latihan1`.

### Membuat Tabel

```sql
CREATE TABLE data_barang (
  id_barang int(10) auto_increment Primary Key,
  kategori varchar(30),
  nama varchar(30),
  gambar varchar(100),
  harga_beli decimal(10,0),
  harga_jual decimal(10,0),
  stok int(4)
);
```

Penjelasan tiap kolom:

| Kolom | Tipe | Penjelasan |
|-------|------|------------|
| `id_barang` | `int(10)` | Kunci utama (primary key). `auto_increment` membuat nilainya naik otomatis (1, 2, 3, ...) setiap ada data baru. |
| `kategori` | `varchar(30)` | Kategori barang, misalnya Elektronik, Komputer, Hand Phone. |
| `nama` | `varchar(30)` | Nama barang. |
| `gambar` | `varchar(100)` | Nama/path file gambar barang (yang disimpan hanya teks path-nya, bukan file gambarnya). |
| `harga_beli` | `decimal(10,0)` | Harga beli, angka sampai 10 digit tanpa desimal. |
| `harga_jual` | `decimal(10,0)` | Harga jual, angka sampai 10 digit tanpa desimal. |
| `stok` | `int(4)` | Jumlah stok barang. |

> 📸 **Screenshot:** Tampilan phpMyAdmin setelah tabel `data_barang` dibuat pada database `latihan1`
> `![phpMyAdmin](screenshots/04-phpmyadmin.png)`

### Menambahkan Data

```sql
INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok)
VALUES ('Elektronik', 'HP Samsung Android', 'hp_samsung.jpg', 2000000, 2400000, 5),
('Elektronik', 'HP Xiaomi Android', 'hp_xiaomi.jpg', 1000000, 1400000, 5),
('Elektronik', 'HP OPPO Android', 'hp_oppo.jpg', 1800000, 2300000, 5);
```

Penjelasan: satu perintah `INSERT` memasukkan **3 baris data sekaligus**. Daftar kolom ditulis setelah nama tabel, lalu nilainya ditulis berurutan pada `VALUES`. Kolom `id_barang` tidak ditulis karena terisi otomatis oleh `auto_increment`.

Untuk memeriksa hasilnya:

```sql
select * from data_barang;
```

Hasil: 3 baris data dengan `id_barang` 1, 2, dan 3.

> 📸 **Screenshot:** Tampilan data barang hasil `select * from data_barang;`
> `![Data Barang](screenshots/05-data-barang.png)`

---

## Membuat Program CRUD

Semua file PHP berikut dibuat di dalam folder `lab8_php_database`.

### 1. File Koneksi Database (`koneksi.php`)

File ini menghubungkan PHP dengan database MySQL. File ini akan di-*include* oleh file-file lain agar tidak perlu menulis ulang kode koneksi.

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan1";

$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn == false)
{
    echo "Koneksi ke server gagal.";
    die();
} #else echo "Koneksi berhasil";
?>
```

**Penjelasan kode:**

| Baris | Penjelasan |
|-------|------------|
| `$host = "localhost";` | Alamat server database (komputer lokal). |
| `$user = "root";` | Username MySQL bawaan XAMPP. |
| `$pass = "";` | Password kosong (default XAMPP). |
| `$db = "latihan1";` | Nama database yang dipakai. |
| `mysqli_connect(...)` | Fungsi untuk membuka koneksi ke MySQL. Hasilnya disimpan di `$conn`. |
| `if ($conn == false)` | Jika koneksi gagal, tampilkan pesan "Koneksi ke server gagal." |
| `die();` | Menghentikan eksekusi program jika koneksi gagal. |
| `#else echo "Koneksi berhasil";` | Bagian ini di-*comment*. Hapus tanda `#` (uncomment) untuk menampilkan pesan "Koneksi berhasil" saat menguji koneksi. |

**Cara menguji:** buka `http://localhost/lab8_php_database/koneksi.php`. Agar pesan sukses tampil, uncomment bagian `echo "Koneksi berhasil";`.

> 📸 **Screenshot:** Tampilan tes koneksi ("Koneksi berhasil")
> `![Tes Koneksi](screenshots/06-tes-koneksi.png)`

---

### 2. Menampilkan Data (Read) – `index.php`

File ini membaca semua data dari tabel `data_barang` dan menampilkannya dalam bentuk tabel HTML.

```php
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
            <?php if($result): ?>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><img src="gambar/<?= $row['gambar'];?>" alt="<?= $row['nama'];?>"></td>
                <td><?= $row['nama'];?></td>
                <td><?= $row['kategori'];?></td>
                <td><?= $row['harga_beli'];?></td>
                <td><?= $row['harga_jual'];?></td>
                <td><?= $row['stok'];?></td>
                <td><?= $row['id_barang'];?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td colspan="7">Belum ada data</td>
            </tr>
            <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>
```

**Penjelasan kode:**

| Bagian | Penjelasan |
|--------|------------|
| `include("koneksi.php");` | Menyertakan file koneksi sehingga variabel `$conn` bisa dipakai. |
| `$sql = 'SELECT * FROM data_barang';` | Query untuk mengambil seluruh kolom dan seluruh baris dari tabel `data_barang`. |
| `mysqli_query($conn, $sql)` | Menjalankan query ke database. Hasilnya disimpan di `$result`. |
| `<link href="style.css" ...>` | Menghubungkan halaman dengan file CSS untuk tampilan. |
| `<table>` dan `<th>` | Membuat tabel dengan judul kolom: Gambar, Nama Barang, Kategori, Harga Jual, Harga Beli, Stok, Aksi. |
| `<?php if($result): ?>` | Mengecek apakah query berhasil. |
| `while($row = mysqli_fetch_array($result))` | Perulangan yang mengambil data satu baris demi satu baris dari hasil query. Setiap baris disimpan di array `$row`. |
| `<?= $row['nama'];?>` | Singkatan dari `<?php echo $row['nama']; ?>`, mencetak isi kolom `nama`. |
| `<img src="gambar/<?= $row['gambar'];?>" ...>` | Menampilkan gambar dari folder `gambar/`, nama file diambil dari kolom `gambar`. |
| `else: ... Belum ada data` | Jika query gagal, ditampilkan baris "Belum ada data" yang menggabungkan 7 kolom (`colspan="7"`). |
| `endwhile; endif;` | Penutup struktur kontrol dengan sintaks alternatif (cocok dicampur dengan HTML). |

> 📸 **Screenshot:** Tampilan halaman `index.php` (Data Barang)
> `![Tampilan index](screenshots/07-index.png)`

---

### 3. Menambah Data (Create) – `tambah.php`

File ini berisi form input barang baru dan kode PHP untuk menyimpannya ke database, termasuk mengunggah file gambar.

```php
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit']))
{
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] == 0)
    {
        $filename = str_replace(' ', '_',$file_gambar['name']);
        $destination = dirname(__FILE__) .'/gambar/' . $filename;
        if(move_uploaded_file($file_gambar['tmp_name'], $destination))
        {
            $gambar = 'gambar/' . $filename;;
        }
    }
    $sql = 'INSERT INTO data_barang (nama, kategori,harga_jual, harga_beli, stok, gambar) ';
    $sql .= "VALUE ('{$nama}', '{$kategori}','{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Tambah Barang</title>
</head>
<body>
<div class="container">
    <h1>Tambah Barang</h1>
    <div class="main">
    <form method="post" action="tambah.php" enctype="multipart/form-data">
        <div class="input">
            <label>Nama Barang</label>
            <input type="text" name="nama" />
        </div>
        <div class="input">
            <label>Kategori</label>
            <select name="kategori">
                <option value="Komputer">Komputer</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Hand Phone">Hand Phone</option>
            </select>
        </div>
        <div class="input">
            <label>Harga Jual</label>
            <input type="text" name="harga_jual" />
        </div>
        <div class="input">
            <label>Harga Beli</label>
            <input type="text" name="harga_beli" />
        </div>
        <div class="input">
            <label>Stok</label>
            <input type="text" name="stok" />
        </div>
        <div class="input">
            <label>File Gambar</label>
            <input type="file" name="file_gambar" />
        </div>
        <div class="submit">
            <input type="submit" name="submit" value="Simpan" />
        </div>
    </form>
    </div>
</div>
</body>
</html>
```

**Penjelasan bagian PHP (proses simpan):**

| Bagian | Penjelasan |
|--------|------------|
| `error_reporting(E_ALL);` | Menampilkan semua jenis pesan error PHP, berguna saat belajar/debugging. |
| `include_once 'koneksi.php';` | Menyertakan koneksi database satu kali saja. |
| `if (isset($_POST['submit']))` | Blok ini hanya jalan jika tombol **Simpan** (name `submit`) sudah ditekan. Jika halaman baru dibuka, hanya form yang tampil. |
| `$_POST['nama']`, dst. | Mengambil nilai yang diketik pengguna pada form (nama, kategori, harga jual, harga beli, stok). |
| `$_FILES['file_gambar']` | Mengambil informasi file yang diunggah (nama, lokasi sementara, status error). |
| `$gambar = null;` | Nilai awal path gambar. Tetap `null` jika tidak ada file yang diunggah. |
| `if ($file_gambar['error'] == 0)` | Error `0` berarti file berhasil diterima server. |
| `str_replace(' ', '_', ...)` | Mengganti spasi pada nama file dengan garis bawah agar nama file aman. |
| `dirname(__FILE__) . '/gambar/' . $filename` | Menentukan lokasi tujuan penyimpanan: folder `gambar` di dalam folder aplikasi. |
| `move_uploaded_file(tmp_name, $destination)` | Memindahkan file dari lokasi sementara ke folder tujuan. Jika berhasil, `$gambar` diisi `'gambar/' . $filename`. |
| `$sql = 'INSERT INTO ...'` | Menyusun query `INSERT` ke tabel `data_barang` dari nilai-nilai yang diambil tadi. |
| `mysqli_query($conn, $sql)` | Menjalankan query penyimpanan. |
| `header('location: index.php');` | Setelah selesai, pengguna diarahkan kembali ke halaman daftar barang. |

**Penjelasan bagian form (HTML):**

| Elemen | Penjelasan |
|--------|------------|
| `method="post"` | Data dikirim dengan metode POST (tidak tampil di URL). |
| `action="tambah.php"` | Data dikirim ke file `tambah.php` itu sendiri. |
| `enctype="multipart/form-data"` | Wajib ada agar form dapat mengirim file (upload gambar). |
| `<input type="text" name="...">` | Kolom isian teks untuk nama, harga jual, harga beli, dan stok. Atribut `name` menjadi kunci pada `$_POST`. |
| `<select name="kategori">` | Dropdown pilihan kategori: Komputer, Elektronik, Hand Phone. |
| `<input type="file" name="file_gambar">` | Tombol pilih file gambar (dibaca lewat `$_FILES`). |
| `<input type="submit" name="submit" value="Simpan">` | Tombol kirim form. |

> 📸 **Screenshot:** Tampilan form Tambah Barang
> `![Tambah Barang](screenshots/08-tambah-barang.png)`

---

### 4. Mengubah Data (Update) – `ubah.php`

File ini menampilkan form yang sudah terisi data lama berdasarkan `id`, lalu menyimpan perubahannya.

```php
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit']))
{
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] == 0)
    {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination))
        {
            $gambar = 'gambar/' . $filename;;
        }
    }
    $sql = 'UPDATE data_barang SET ';
    $sql .= "nama = '{$nama}', kategori = '{$kategori}', ";
    $sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' ";
    if (!empty($gambar))
        $sql .= ", gambar = '{$gambar}' ";
    $sql .= "WHERE id_barang = '{$id}'";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data tidak tersedia');
$data = mysqli_fetch_array($result);
function is_select($var, $val) {
    if ($var == $val) return 'selected="selected"';
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Ubah Barang</title>
</head>
<body>
<div class="container">
    <h1>Ubah Barang</h1>
    <div class="main">
    <form method="post" action="ubah.php" enctype="multipart/formdata">
        <div class="input">
            <label>Nama Barang</label>
            <input type="text" name="nama" value="<?php echo $data['nama'];?>" />
        </div>
        <div class="input">
            <label>Kategori</label>
            <select name="kategori">
                <option <?php echo is_select ('Komputer', $data['kategori']);?> value="Komputer">Komputer</option>
                <option <?php echo is_select ('Komputer', $data['kategori']);?> value="Elektronik">Elektronik</option>
                <option <?php echo is_select ('Komputer', $data['kategori']);?> value="Hand Phone">Hand Phone</option>
            </select>
        </div>
        <div class="input">
            <label>Harga Jual</label>
            <input type="text" name="harga_jual" value="<?php echo $data['harga_jual'];?>" />
        </div>
        <div class="input">
            <label>Harga Beli</label>
            <input type="text" name="harga_beli" value="<?php echo $data['harga_beli'];?>" />
        </div>
        <div class="input">
            <label>Stok</label>
            <input type="text" name="stok" value="<?php echo $data['stok'];?>" />
        </div>
        <div class="input">
            <label>File Gambar</label>
            <input type="file" name="file_gambar" />
        </div>
        <div class="submit">
            <input type="hidden" name="id" value="<?php echo $data['id_barang'];?>" />
            <input type="submit" name="submit" value="Simpan" />
        </div>
    </form>
    </div>
</div>
</body>
</html>
```

**Penjelasan alur:**

1. **Mengambil data lama.** Halaman dibuka dengan URL berbentuk `ubah.php?id=1`. Nilai `id` diambil dengan `$_GET['id']`, lalu query `SELECT ... WHERE id_barang = '{$id}'` mengambil satu barang. Hasilnya disimpan ke `$data`.
2. **Mengisi form.** Setiap input diberi `value="<?php echo $data['...']; ?>"` sehingga form otomatis berisi data lama.
3. **Fungsi `is_select($var, $val)`.** Membandingkan dua nilai. Jika sama, mengembalikan `selected="selected"` agar opsi dropdown kategori terpilih otomatis sesuai data.
4. **Input hidden `id`.** `<input type="hidden" name="id" ...>` membawa `id_barang` ke proses simpan tanpa terlihat oleh pengguna, supaya diketahui baris mana yang diubah.
5. **Menyimpan perubahan.** Saat tombol **Simpan** ditekan (`isset($_POST['submit'])`), nilai form diambil lewat `$_POST`, lalu disusun query `UPDATE data_barang SET nama = ..., kategori = ..., harga_jual = ..., harga_beli = ..., stok = ... WHERE id_barang = ...`.
6. **Gambar bersifat opsional.** Bagian `if (!empty($gambar)) $sql .= ", gambar = '{$gambar}' ";` hanya menambahkan perubahan kolom `gambar` jika pengguna memilih file baru. Jika tidak, gambar lama dipertahankan.
7. **Redirect.** Setelah query dijalankan, `header('location: index.php');` mengarahkan kembali ke daftar barang.

Proses upload gambar (`$_FILES`, `str_replace`, `move_uploaded_file`) sama seperti pada `tambah.php`.

> 📸 **Screenshot:** Tampilan form Ubah Barang
> `![Ubah Barang](screenshots/09-ubah-barang.png)`

---

### 5. Menghapus Data (Delete) – `hapus.php`

```php
<?php
include_once 'koneksi.php';
$id = $_GET['id'];
$sql = "DELETE FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
header('location: index.php');
?>
```

**Penjelasan kode:**

| Baris | Penjelasan |
|-------|------------|
| `include_once 'koneksi.php';` | Menyertakan koneksi database. |
| `$id = $_GET['id'];` | Mengambil `id` barang dari URL, misalnya `hapus.php?id=2`. |
| `DELETE FROM data_barang WHERE id_barang = '{$id}'` | Menghapus baris yang `id_barang`-nya sama dengan `id` tersebut. Klausa `WHERE` wajib ada agar tidak semua data terhapus. |
| `mysqli_query($conn, $sql);` | Menjalankan perintah hapus. |
| `header('location: index.php');` | Kembali ke halaman daftar barang setelah data terhapus. |

---

## Struktur Folder

```
htdocs/
└── lab8_php_database/
    ├── gambar/          (folder tujuan upload gambar)
    ├── koneksi.php      (koneksi database)
    ├── index.php        (Read: tampil data)
    ├── tambah.php       (Create: tambah data)
    ├── ubah.php         (Update: ubah data)
    ├── hapus.php        (Delete: hapus data)
    └── style.css        (tampilan halaman)
```

Catatan: `index.php`, `tambah.php`, dan `ubah.php` memanggil `style.css`, dan gambar barang dibaca/diunggah ke folder `gambar/`, sehingga keduanya perlu tersedia di folder aplikasi.

---

## Alur Kerja Aplikasi

```
                  ┌──────────────┐
                  │  index.php   │  ← SELECT (Read)
                  │ daftar barang│
                  └──────┬───────┘
        ┌────────────────┼────────────────┐
        ▼                ▼                ▼
 ┌─────────────┐  ┌─────────────┐  ┌─────────────┐
 │ tambah.php  │  │  ubah.php   │  │  hapus.php  │
 │ INSERT      │  │  UPDATE     │  │  DELETE     │
 └──────┬──────┘  └──────┬──────┘  └──────┬──────┘
        └────────────────┴────────────────┘
                         ▼
              header('location: index.php')
```

Semua file memakai `koneksi.php` untuk terhubung ke database `latihan1`. Setelah proses tambah, ubah, atau hapus selesai, pengguna selalu diarahkan kembali ke `index.php`.

---

## Kesimpulan

Pada Praktikum 8 ini telah dipelajari:

1. Cara menjalankan MySQL Server melalui XAMPP dan mengakses phpMyAdmin.
2. Cara membuat database `latihan1`, tabel `data_barang`, dan mengisi data dengan perintah SQL `INSERT`.
3. Cara menghubungkan PHP ke MySQL menggunakan `mysqli_connect()` pada file `koneksi.php`.
4. Implementasi empat operasi CRUD:
   - **Read** dengan `SELECT` dan `mysqli_fetch_array()` pada `index.php`.
   - **Create** dengan `INSERT` dan upload gambar pada `tambah.php`.
   - **Update** dengan `UPDATE` dan pengisian form otomatis pada `ubah.php`.
   - **Delete** dengan `DELETE` pada `hapus.php`.
5. Cara mengirim data antar halaman memakai `$_GET` (id pada URL) dan `$_POST` (isi form), serta `$_FILES` untuk file unggahan.
