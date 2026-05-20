<?php

$target_dir = "uploads/";

// =======================
// HAPUS FILE
// =======================
if (isset($_GET['hapus'])) {

    $file = basename($_GET['hapus']);

    $path = $target_dir . $file;

    if (file_exists($path)) {

        unlink($path);

        echo "
        <script>
            alert('File berhasil dihapus');
            window.location='lihat.php';
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Lihat Upload</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 40px;
        }

        h1{
            margin-top: 20px;
            margin-bottom: 30px;
            color: #333;
        }

        /* =========================
           BUTTON KEMBALI
        ========================= */

        .kembali{
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .kembali:hover{
            background: #0056b3;
        }

        /* =========================
           GALLERY
        ========================= */

        .gallery{
            margin-top: 30px;

            display: grid;

            grid-template-columns:
            repeat(auto-fit, minmax(250px,1fr));

            gap: 20px;
        }

        .card{
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover{
            transform: translateY(-5px);
        }

        .card img{
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .card-body{
            padding: 15px;
            text-align: center;
        }

        .nama-file{
            margin-bottom: 15px;
            color: #444;
            word-break: break-word;
        }

        /* =========================
           BUTTON DOWNLOAD
        ========================= */

        .download{
            display: inline-block;
            text-decoration: none;
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .download:hover{
            background: #1e7e34;
        }

        /* =========================
           BUTTON HAPUS
        ========================= */

        .hapus{
            display: inline-block;
            text-decoration: none;
            background: red;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            margin-top: 10px;
            transition: 0.3s;
        }

        .hapus:hover{
            background: darkred;
        }

        /* =========================
           KOSONG
        ========================= */

        .kosong{
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            color: #666;
        }

    </style>

</head>

<body>

<a href="upload.php" class="kembali">
    Kembali Upload
</a>

<h1>Hasil Upload</h1>

<div class="gallery">

<?php

$files = scandir($target_dir);

$adaFile = false;

foreach ($files as $file) {

    if ($file != "." && $file != "..") {

        $adaFile = true;

        $path = $target_dir . $file;

        echo "

        <div class='card'>

            <img src='$path'>

            <div class='card-body'>

                <p class='nama-file'>$file</p>

                <!-- BUTTON DOWNLOAD -->
                <a 
                    class='download'
                    href='$path'
                    download
                >
                    Unduh
                </a>

                <br><br>

                <!-- BUTTON HAPUS -->
                <a 
                    class='hapus'
                    href='?hapus=$file'
                    onclick=\"return confirm('Yakin ingin menghapus file ini?')\"
                >
                    Hapus
                </a>

            </div>

        </div>

        ";
    }
}

// kalau belum ada file
if (!$adaFile) {

    echo "
    <div class='kosong'>
        Belum ada file yang diupload
    </div>
    ";
}

?>

</div>

</body>
</html>