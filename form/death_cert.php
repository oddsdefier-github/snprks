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
        <h3 style="text-align : center; font-size: 20px;">This is to Clarify that</h3>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 80%; font-size: 25px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['residence']) ?>
                </td>
                <td style="width: 20%; font-size: 25px; text-align: right;">a resident of</td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 8%; font-size: 25px; text-align: right;">barrio</td>
                <td style="width: 40%; font-size: 25px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['barrio']) ?>
                </td>
                <td style="width: 20%; font-size: 25px; text-align: right;">Municipality of</td>
                <td style="width: 30%; font-size: 25px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['municipal']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 15%; font-size: 25px; text-align: right;">Province of</td>
                <td style="width: 80%; font-size: 25px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['province']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 34%; font-size: 25px; text-align: right;">single, son(daughter) of</td>
                <td style="width: 35%; font-size: 19px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['name1']) ?>
                </td>
                <td style="width: 5%; font-size: 25px; text-align: right;">and</td>
                <td style="width: 30%; font-size: 19px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['name2']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 40%; font-size: 25px; text-align: right;">husband or wife (widowed) of</td>
                <td style="width: 65%; font-size: 25px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['name2']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 9.5%; font-size: 25px; text-align: right;">died on</td>
                <td style="width: 15%; font-size: 25px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['date_of_death']) ?>
                </td>
                <td style="width: 10%; font-size: 25px; text-align: right;">day of </td>
                <td style="width: 25%; font-size: 25px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['date_of_burial']) ?>
                </td>
                <td style="width: 15%; font-size: 25px; text-align: right;">at the age of </td>
                <td style="width: 10%; font-size: 25px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['age']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 101%; margin-left: 0%;">
            <tr>
                <td style="width: 100%; font-size: 24.5px; text-align: center;">years, and was buried in the Roman
                    Catholic Cemetery of this Parish/Municipal</td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 16%; font-size: 25px; text-align: right;">cemetary of</td>
                <td style="width: 80%; font-size: 25px; white-space: nowrap; text-align : center;  border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['place_of_burial']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 20%; text-align: right;   font-size: 25px;"> on the day of &nbsp;</td>
                <td style="width: 80%; font-size: 25px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['date_created']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 32%; text-align: right; font-size: 25px;"> The cause of death was&nbsp;</td>
                <td style="width: 68%; font-size: 25px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['death']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 101%; margin-left: 0%;">
            <tr>
                <td style="width: 100%; font-size: 24.5px; text-align: center;">He /She received the last Sacraments of
                    Confession, Extreme Unction, and Holy</td>
            </tr>
        </table>
        <table style="width: 101%; margin-left: 0%;">
            <tr>
                <td style="width: 100%; font-size: 24.5px; text-align: left;">Viaticum before death or he /she was not
                    able to receive any Sacrament before death.</td>
            </tr>
        </table>
        <br>
        <table style="width: 101%; margin-left: 0%;">
            <tr>
                <td style="width: 100%; font-size: 24.5px; text-align: center;">This is a true copy of the original
                    record as it appears in the Register of Dead of</td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width:30%; text-align: right; font-size: 25px;">this Parish, Book No. &nbsp;</td>
                <td style="font-size: 20px; text-align : center;  border-bottom: 1px solid black;"><?= htmlspecialchars($user['book']) ?>
                <td style="width:13%; text-align: right; font-size: 25px;">Page No.</td>
                <td style="font-size: 20px; text-align : center;   border-bottom: 1px solid black;"><?= htmlspecialchars($user['page']) ?>
                <td style="width:15%; text-align: right; font-size: 25px;">Line No.</td>
                <td style="font-size: 20px; text-align : center;   border-bottom: 1px solid black;"><?= htmlspecialchars($user['line']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 100%; font-size: 24.5px; text-align: center;">In witness whereof I affix my signature
                    and put the seal of this Parish on the</td>
            </tr>
        </table>
        <table style="width: 40%; margin-left: 0%;">
            <tr>
                <td style="width: 12%; text-align: right; font-size: 25px;"> the day of &nbsp;</td>
                <td style="width: 15%; font-size: 20px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['date_created']) ?>
                </td>
            </tr>
        </table>
        <h4 style="margin: 1; text-align: right; font-size: 25px; margin-right: 20px;  "><?= htmlspecialchars($user['name_of_priest']) ?>
        </h4>
        <h4 style="margin: 1; text-align: right; font-size: 14px; margin-right: 20px;  ">
            PARISH PRIEST</h4>
    </div>
    <script>
        window.onload = function () {
            window.print();
        };
    </script>