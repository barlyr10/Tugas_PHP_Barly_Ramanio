<?php
// 1. Array multidimensi mata kuliah
$matkul = [
    [
        "nama" => "Algoritma dan Pemrograman",
        "sks" => 3,
        "nilai" => 85
    ],
    [
        "nama" => "Basis Data",
        "sks" => 3,
        "nilai" => 75
    ],
    [
        "nama" => "Sistem Operasi",
        "sks" => 3,
        "nilai" => 60
    ],
    [
        "nama" => "Jaringan Komputer",
        "sks" => 2,
        "nilai" => 90
    ],
    [
        "nama" => "Matematika Diskrit",
        "sks" => 3,
        "nilai" => 50
    ],
    [
        "nama" => "Pemrograman Web",
        "sks" => 3,
        "nilai" => 80
    ]
];

// 2. Fungsi untuk menentukan nilai huruf dan bobot
function hitungBobot($nilai)
{
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

// Variabel untuk menghitung IPS
$totalBobotSKS = 0;
$totalSKS = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Mata Kuliah dan IPS</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h2, h3 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        .mengulang {
            background-color: #ffcccc;
            color: #b30000;
        }

        .lulus {
            background-color: #e2f5e9;
        }

        .ringkasan {
            background-color: #f2f2f2;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <h2>Daftar Nilai Mata Kuliah</h2>

    <table>
        <tr>
            <th>No.</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Bobot</th>
            <th>Status</th>
        </tr>

        <?php $no = 1; ?>

        <?php foreach ($matkul as $mk) : ?>

            <?php
            // Menghitung nilai huruf dan bobot
            $hasil = hitungBobot($mk["nilai"]);

            $huruf = $hasil["huruf"];
            $bobot = $hasil["bobot"];

            // Menentukan status kelulusan
            $status = ($bobot >= 2.0) ? "LULUS" : "MENGULANG";

            // Menentukan warna baris
            $kelas = ($status == "MENGULANG") ? "mengulang" : "lulus";

            // Menghitung total SKS dan total bobot dikali SKS
            $totalSKS += $mk["sks"];
            $totalBobotSKS += $bobot * $mk["sks"];
            ?>

            <tr class="<?= $kelas ?>">
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($mk["nama"]) ?></td>
                <td><?= $mk["sks"] ?></td>
                <td><?= $mk["nilai"] ?></td>
                <td><?= $huruf ?></td>
                <td><?= number_format($bobot, 1) ?></td>
                <td><?= $status ?></td>
            </tr>

        <?php endforeach; ?>

    </table>

    <?php
    // 3. Menghitung IPS
    $ips = ($totalSKS > 0) ? $totalBobotSKS / $totalSKS : 0;

    // 4. Menentukan batas maksimal SKS semester depan
    $maksSKS = ($ips >= 3.00) ? 24 : 20;
    ?>

    <h3>Ringkasan IPS</h3>

    <div class="ringkasan">
        <p>Total Mata Kuliah: <?= count($matkul) ?></p>

        <p>Total SKS: <?= $totalSKS ?></p>

        <p>Total Bobot x SKS:
            <?= number_format($totalBobotSKS, 2) ?>
        </p>

        <p>IPS:
            <strong><?= number_format($ips, 2) ?></strong>
        </p>

        <p>Batas Maksimal SKS Semester Depan:
            <strong><?= $maksSKS ?> SKS</strong>
        </p>
    </div>

</body>
</html>