<?php
session_start();

if (isset($_POST['operator'])) {
    $angka1 = str_replace([','], ['.'], $_POST['angka1']);
    $angka2 = str_replace([','], ['.'], $_POST['angka2']);
    $operator = $_POST['operator'];

    if (!is_numeric($angka1) || !is_numeric($angka2)) {
        echo "<script>alert('Input harus berupa angka')</script>";
    } elseif ($operator == '/' && $angka2 == 0) {
        echo "<script>alert('Tidak dapat membagi dengan Nol')</script>";
    } else {
        switch ($operator) {
            case '+':
                $hasil = $angka1 + $angka2;
                break;
            case '-':
                $hasil = $angka1 - $angka2;
                break;
            case '*':
                $hasil = $angka1 * $angka2;
                break;
            case '/':
                $hasil = $angka1 / $angka2;
                break;
            default:
                echo "Operator tidak valid";
                break;
        }
        $formatted_hasil = (floor($hasil) == $hasil) ? number_format($hasil, 0, ',', '.') : rtrim(rtrim(number_format($hasil, 5, ',', '.'), '0'), ',');
    }
}

if (isset($_POST['hasil'])) {
    $_SESSION['memory'] = $_POST['hasil']; // Simpan hasil ke sesi
}

if (isset($_POST['resethasil'])) {
    unset($_SESSION['memory']); // Hapus memori jika MC ditekan
}

// Ambil nilai dari sesi untuk angka pertama jika ada
$angka1_value = isset($_SESSION['memory']) ? $_SESSION['memory'] : "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator Sederhana | UKK RPL 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <img src="images/logo.jpeg" alt="Logo Kalkulator" class="logo">
        <h2 class="text-center">Kalkulator Sederhana</h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" class="p-2 border rounded bg-light">
                    <label class="form-label">Angka Pertama</label>
                    <input type="text" name="angka1" class="form-control" required pattern="[-]?[0-9.,]+" placeholder="Tambahkan angka" value="<?= $angka1_value ?>">
                    <label class="form-label">Angka Kedua</label>
                    <input type="text" name="angka2" class="form-control" required pattern="[-]?[0-9.,]+" placeholder="Tambahkan angka">
                    <div class="d-flex justify-content-center gap-2 mt-2">
                        <button type="submit" class="btn btn-primary" name="operator" value="+" title="Tambah">+</button>
                        <button type="submit" class="btn btn-secondary" name="operator" value="-" title="Kurang">-</button>
                        <button type="submit" class="btn btn-success" name="operator" value="*" title="Kali">x</button>
                        <button type="submit" class="btn btn-info" name="operator" value="/" title="Bagi">&divide;</button>
                        <button type="reset" class="btn btn-warning" name="reset" value="reset" title="Clear Entry">CE</button>
                    </div>
                </form>

                <div class="p-2 border rounded bg-light">
                    <h4 class="text-center">
                        <?php
                        if (isset($formatted_hasil)) {
                            echo "$angka1 $operator $angka2 = $formatted_hasil";
                        } else {
                            echo "Hasil : ";
                        }
                        ?>
                    </h4>

                    <div class="row">
                        <div class="col-6">
                            <form method="POST">
                                <input type="hidden" name="hasil" value="<?= isset($hasil) ? $hasil : '' ?>">
                                <button type="submit" class="btn btn-primary" title="Memory Entry">ME</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <form method="POST">
                                <button type="submit" name="resethasil" class="btn btn-danger" title="Memory Clear">MC</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center mt-3">&copy; UKK PPLG 2025 | MONA | PPLG</p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>