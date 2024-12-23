<?php
include 'cookie_handler.php'; // Sertakan cookie handler

// Koneksi ke database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username MySQL Anda
$password = "";     // Sesuaikan dengan password MySQL Anda
$dbname = "mahasiswa_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pagination settings
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data
$totalDataQuery = $conn->query("SELECT COUNT(*) AS total FROM mahasiswa");
$totalData = $totalDataQuery->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

// Tambahkan Data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $angkatan = $_POST['angkatan'];

    setCustomCookie("nama", $nama);
    setCustomCookie("jurusan", $jurusan);
    setCustomCookie("angkatan", $angkatan);

    $query = "INSERT INTO mahasiswa (nama, jurusan, angkatan) VALUES ('$nama', '$jurusan', '$angkatan')";
    if ($conn->query($query) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Hapus Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM mahasiswa WHERE id = $id";
    if ($conn->query($query) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Edit Data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $angkatan = $_POST['angkatan'];

    setCustomCookie("nama", $nama);
    setCustomCookie("jurusan", $jurusan);
    setCustomCookie("angkatan", $angkatan);

    $query = "UPDATE mahasiswa SET nama = '$nama', jurusan = '$jurusan', angkatan = '$angkatan' WHERE id = $id";
    if ($conn->query($query) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Ambil data dari database dengan pagination
$query = "SELECT * FROM mahasiswa LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Data Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff;
            color: #000;
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            color: #000;
        }
        table {
            margin: 20px auto;
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #333;
        }
        th {
            background-color: #000;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #e0e0e0;
            cursor: pointer;
        }
        .button-container {
            text-align: center;
            margin: 20px 0;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }
        .pagination a {
            text-decoration: none;
            color: #fff;
            background-color: #000;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .pagination a:hover {
            background-color: #555;
        }
        footer {
            margin-top: 30px;
        }
        /* Modal styles */
        #editModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        #editModal .close {
            float: right;
            font-size: 1.2rem;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Manajemen Data Mahasiswa</h1>

        <!-- Form Tambah Data -->
        <form method="POST" action="" class="mb-4">
            <div class="form-row">
                <div class="col-md-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required 
                           value="<?= getCustomCookie('nama') ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" required 
                           value="<?= getCustomCookie('jurusan') ?>">
                </div>
                <div class="col-md-2">
                    <input type="number" name="angkatan" class="form-control" placeholder="Angkatan" required 
                           value="<?= getCustomCookie('angkatan') ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" name="add" class="btn btn-success" onclick="return confirmAdd()">Tambah</button>
                </div>
            </div>
        </form>

        <!-- Tabel Data Mahasiswa -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['jurusan'] ?></td>
                            <td><?= $row['angkatan'] ?></td>
                            <td>
                                <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                <button class="btn btn-warning" onclick="editRow('<?= $row['id'] ?>', '<?= $row['nama'] ?>', '<?= $row['jurusan'] ?>', '<?= $row['angkatan'] ?>')">Edit</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>" class="btn btn-primary">Sebelumnya</a>
            <?php endif; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>" class="btn btn-primary">Berikutnya</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal">
        <span class="close" onclick="document.getElementById('editModal').style.display='none';">&times;</span>
        <form method="POST" action="">
            <input type="hidden" name="id" id="editId">
            <div class="form-group">
                <label for="editNama">Nama:</label>
                <input type="text" name="nama" id="editNama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editJurusan">Jurusan:</label>
                <input type="text" name="jurusan" id="editJurusan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editAngkatan">Angkatan:</label>
                <input type="number" name="angkatan" id="editAngkatan" class="form-control" required>
            </div>
            <button type="submit" name="edit" class="btn btn-primary" onclick="return confirmSave()">Simpan</button>
        </form>
    </div>

    <script>
        function confirmAdd() {
            return confirm('Apakah Anda yakin ingin menambahkan data?');
        }

        function confirmSave() {
            return confirm('Apakah Anda yakin ingin menyimpan perubahan data?');
        }

        function editRow(id, nama, jurusan, angkatan) {
            document.getElementById('editId').value = id;
            document.getElementById('editNama').value = nama;
            document.getElementById('editJurusan').value = jurusan;
            document.getElementById('editAngkatan').value = angkatan;
            document.getElementById('editModal').style.display = 'block';
        }
    </script>
</body>
</html>


<?php
$conn->close();
?>
