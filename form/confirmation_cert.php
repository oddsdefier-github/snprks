<?php
include('config.php');
;

$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM communion WHERE id='$id'");
$user = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Certificate</title>
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
            font-size: 20px;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .title2 {
            text-align: center;
            font-size: 15px;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-style: italic;
        }


        .logo {
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
            <h1 style="font-size: 60px; font-family: &quot;Edwardian Script ITC&quot;, cursive;">Confirmation Certificate</h1>
        </center>
        <h3 style="text-align : center; font-size: 20px;">This is to Clarify</h3>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 7%; font-size: 25px; text-align: right;">that &nbsp;</td>
                <td style="width: 95%; text-align: center; font-size: 25px; white-space: nowrap; border-bottom: 1px solid black;">
                  
                    <?= htmlspecialchars($user['child_name']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 20%; font-size: 25px; text-align: right;">child of&nbsp; </td>
                <td style="font-size: 25px; text-align: center; white-space: nowrap; border-bottom: 1px solid black;">
                    
                    <?= htmlspecialchars($user['father_name']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="font-size: 25px; text-align: right;">and&nbsp; </td>
                <td style="font-size: 25px; text-align: center; white-space: nowrap; border-bottom: 1px solid black;">
                   
                    <?= htmlspecialchars($user['mother_name']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 30%; text-align: right; font-size: 25px;">baptizes on the day of &nbsp;</td>
                <td style="width: 60%; font-size: 25px; text-align: center; white-space: nowrap; border-bottom: 1px solid black;">
                    <?= htmlspecialchars($user['date_of_baptism']) ?>
                </td>
                <td style="width: 10%; text-align: right; font-size: 25px;">in the</td>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 10%; font-size: 25px; text-align: right;">Parish &nbsp;</td>
                <td style="width: 90%; font-size: 25px; text-align: center; white-space: nowrap; border-bottom: 1px solid black;">
                    
                    <?= htmlspecialchars($user['church']) ?>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <p style="text-align:center; font-size:15px; font-family:Arial, sans-serif;     margin: 0;
            padding: 0;">RECEIVED</p>
        <h3 style="text-align:center; font-size:20px; font-family:Arial, sans-serif;    margin: 0;
            padding: 0;">THE HOLY SACRAMENT OF CONFIRMATION</h3><br>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width: 20%; text-align: right; font-size: 25px;"> on the day of &nbsp;</td>
                <td style="width: 60%; font-size: 25px; text-align: center; white-space: nowrap; border-bottom: 1px solid black;">
                    <?= htmlspecialchars($user['date_of_communion']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width:23%; text-align: right; font-size: 25px;">by the Most Rev. &nbsp;</td>
                <td style="width:50%; font-size: 25px; text-align: center; white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['rev']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width:23%; text-align: right; font-size: 25px;">the Sponsors being: &nbsp;</td>
                <td style="width:42%; font-size: 25px; text-align: center; white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['spo']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width:23%; text-align: right; font-size: 25px;">&nbsp;</td>
                <td style="width:42%; font-size: 25px; white-space: nowrap; border-bottom: 1px solid black;">
                </td>
            </tr>
        </table>
        <br>
        <br>
        <table style="width: 98%; margin-left: 0%;">
            <tr>
                <td style="width:30%; text-align: right; font-size: 25px;">as show on page &nbsp;</td>
                <td style="font-size: 25px; text-align: center; border-bottom: 1px solid black;"><?= htmlspecialchars($user['page']) ?></td>
                <td style="width:10%; text-align: right; font-size: 25px;">line</td>
                <td style="font-size: 25px; text-align: center;  border-bottom: 1px solid black;"><?= htmlspecialchars($user['line']) ?></td>
                <td style="width:40%; text-align: right; font-size: 25px;">of the Confirmation Book No.</td>
                <td style="font-size: 25px;  text-align: center;  border-bottom: 1px solid black;"><?= htmlspecialchars($user['book']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-left: 0%;">
            <tr>
                <td style="width: 43%; text-align: right; font-size: 25px;">of this Caholic Church Dated : &nbsp;</td>
                <td style="width: 50%; font-size: 25px; text-align: center; white-space: nowrap; border-bottom: 1px solid black;">
                    <?= htmlspecialchars($user['date_of_baptism']) ?>
                </td>
            </tr>
        </table>
        <p  style="text-align : left; font-size: 20px;"><strong>Purpose:</strong><p>
    <a>______________________________________________</a>
    <br>
    <br>
    <a>______________________________________________</a>
    <p style="text-align:right; font-size:20px; padding:0px; margin:0px;"><strong><a style="width:45%; font-size:25px;"><strong><?= htmlspecialchars($user['minister_name']) ?></strong></a></strong></p>
<p style="text-align:right; font-size:20px; padding:0px; margin:0px;"><strong><i>Parish Priest&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></strong></p>

    </div>
    <script>
        window.onload = function () {
            window.print();
        };
    </script>