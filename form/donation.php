<?php
include('config.php');


$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM death WHERE id='$id'");
$user = mysqli_fetch_assoc($sql);
?>
<html>

<head>
    <style>
        .certificate {
            width: 802px;
            height: 1024px;
            margin: 0 auto;
            border: 1px solid black;
            padding: 20px;
            position: relative;
        }


        .title {
            text-align: center;
            font-size: 25px;
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;
            font-style: italic;
        }

        .title2 {
            text-align: center;
            font-size: 25px;
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;

        }

        .certificate .logo {
            position: absolute;
            top: 20px;
            left: 10%;
            transform: translateX(-50%);
            width: 100px;
            height: auto;
        }

        .logo2 {
            position: absolute;
            top: 20px;
            right: 0%;
            transform: translateX(-50%);
            width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <img src="../img/logo.png" alt="Logo" class="logo">
        <img src="../img/logo2.png" alt="Logo" class="logo2">
        <h2 class="title">APOSTOLIC VICARIATE OF CALAPAN</h2>
        <h2 class="title">STO. NIÑO PARISH</h2>
        <p class="title2">ROXAS ORIENTAL MINDORO</p>
        <center>
            <h1 style="font-size: 60px; font-family: &quot;Edwardian Script ITC&quot;, cursive;">Death Certificate </h1>
        </center>




        <script>
        window.onload = function () {
            window.print();
        };
    </script>