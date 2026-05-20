<?php

$target_dir = "uploads/";

// Membuat folder uploads jika belum ada
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// =======================
// PROSES UPLOAD
// =======================
if (isset($_POST['submit'])) {

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $uploadOk = 1;

    // cek file sudah ada
    if (file_exists($target_file)) {

        echo "
        <script>
            alert('File sudah ada');
        </script>
        ";

        $uploadOk = 0;
    }

    // cek ukuran file
    if ($_FILES["fileToUpload"]["size"] > 5000000) {

        echo "
        <script>
            alert('Ukuran file terlalu besar');
        </script>
        ";

        $uploadOk = 0;
    }

    // upload file
    if ($uploadOk == 1) {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            echo "
            <script>
                alert('File berhasil diupload');
            </script>
            ";

        } else {

            echo "
            <script>
                alert('Upload gagal');
            </script>
            ";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Upload File</title>

    <style>

        body{
            font-family: Arial;
            background: #f4f6f9;
            padding: 40px;
        }

        .container{
            width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        h1{
            text-align: center;
            margin-bottom: 20px;
        }

        input[type=file]{
            margin-top: 15px;
            margin-bottom: 20px;
        }

        input[type=submit]{
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        input[type=submit]:hover{
            background: #0056b3;
        }

        .preview{
            margin-top: 20px;
            text-align: center;
        }

        .preview img{
            width: 300px;
            border-radius: 10px;
            border: 2px solid #ccc;
            display: none;
        }

        .lihat{
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: green;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .lihat:hover{
            background: darkgreen;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Upload File</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <input 
            type="file"
            name="fileToUpload"
            id="fileToUpload"
            accept="image/*"
            onchange="previewImage(event)"
            required
        >

        <br>

        <input type="submit" value="Upload File" name="submit">

    </form>

    <!-- PREVIEW -->
    <div class="preview">

        <h3>Preview</h3>

        <img id="preview">

    </div>

    <center>
        <a href="lihat.php" class="lihat">
            Lihat Hasil Upload
        </a>
    </center>

</div>

<script>

function previewImage(event){

    const preview = document.getElementById('preview');

    preview.src = URL.createObjectURL(event.target.files[0]);

    preview.style.display = "block";
}

</script>

</body>
</html>