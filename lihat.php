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

        body{
            font-family: Arial;
            background: #f4f6f9;
            padding: 40px;
        }

        h1{
            margin-bottom: 30px;
        }

        .kembali{
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .gallery{
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(250px,1fr));
            gap: 20px;
        }

        .card{
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
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

        .hapus{
            display: inline-block;
            text-decoration: none;
            background: red;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .hapus:hover{
            background: darkred;
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

foreach ($files as $file) {

    if ($file != "." && $file != "..") {

        $path = $target_dir . $file;

        echo "

        <div class='card'>

            <img src='$path'>

            <div class='card-body'>

                <p>$file</p>

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

?>

</div>

</body>
</html>