<?php
include('config.php');


$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM marriage WHERE id='$id'");
$user = mysqli_fetch_assoc($sql);
?>
<html>

<head>
    <style>
        .certificate {
            width: 793.70px;
            height: 1122.52px;
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
        <img src="../img/logo2.png" alt="Logo" class="logo">
        <img src="../img/logo.png" alt="Logo" class="logo2">
        <h2 class="title">APOSTOLIC VICARIATE OF CALAPAN</h2>
        <h2 class="title">STO. NIÑO PARISH</h2>
        <p class="title2">ROXAS ORIENTAL MINDORO</p>
        <center>
        <h1 style="font-size: 70px; font-family: &quot;Edwardian Script ITC&quot;, cursive;">Certificate of Marriage</h1>
        </center>
        <h3 style="text-align : center; font-size: 20px;">This certifies that</h3>
        <table style="width: 80%; margin: 0 auto;">
            <tr>
                <td style="width: 49%; font-size: 20px; white-space: nowrap; text-align : center; border-bottom: 1px solid black;"><?= htmlspecialchars($user['groom_name']) ?></td>
                <td style="width: 9%; font-size: 20px; text-align: right;">&nbsp;and&nbsp;&nbsp;</td>
                <td style=" width: 49%; font-size: 20px; white-space: nowrap; text-align : center; border-bottom: 1px solid black;"><?= htmlspecialchars($user['bride_name']) ?></td>
            </tr>
        </table>
        <table style="width: 80%; margin: 0 auto;">
            <tr>
                <td style=" font-size: 20px; text-align: right;">Age: </td>
                <td style="width: 46%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['groom_age']) ?></td>
                <td style="width: 9%; font-size: 20px; text-align: right;">&nbsp;&nbsp;&nbsp;</td>
                <td style=" width: 49%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['bride_age']) ?></td>
            </tr>
        </table>
        <table style="width: 80%; margin: 0 auto;">
            <tr>
                <td style=" width: 14.5%; font-size: 20px; text-align: right;">Native of : </td>
                <td style="width: 35%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['natives']) ?></td>
                <td style="width: 9%; font-size: 20px; text-align: right;">&nbsp;&nbsp;&nbsp;</td>
                <td style=" width: 49%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['native']) ?></td>
            </tr>
        </table>
        <table style="width: 80%; margin: 0 auto;">
            <tr>
                <td style=" width: 14.5%; font-size: 20px; text-align: right;">Residence: </td>
                <td style="width: 35%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['groom_address']) ?></td>
                <td style="width: 9%; font-size: 20px; text-align: right;">&nbsp;&nbsp;&nbsp;</td>
                <td style=" width: 49%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['bride_address']) ?></td>
            </tr>
        </table>
        <table style="width: 80%; margin: 0 auto;">
            <tr>
                <td style=" width: 10%; font-size: 20px; text-align: right;">Father: </td>
                <td style="width: 40%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['groom_father']) ?></td>
                <td style="width: 9%; font-size: 20px; text-align: right;">&nbsp;&nbsp;&nbsp;</td>
                <td style=" width: 49%; font-size: 20px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['bride_father']) ?></td>
            </tr>
        </table>
        <table style="width: 80%; margin: 0 auto;">
            <tr>
                <td style=" width: 10%; font-size: 20px; text-align: right;">Mother: </td>
                <td style="width: 40%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['groom_mother']) ?></td>
                <td style="width: 9%; font-size: 20px; text-align: right;">&nbsp;&nbsp;&nbsp;</td>
                <td style=" width: 49%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['bride_name']) ?></td>
            </tr>
        </table>
        <br>
        <p style="text-align:center; font-size:15px; font-family:Arial, sans-serif;  margin: 0;
            padding: 5px;">were united in</p>
        <h3 style="text-align:center; font-size:22px; font-family: 'Times New Roman', Times, serif; margin: 0;
            padding: 0;">HOLY MATRIMONY</h3>
        <p style="text-align:center; font-size:15px; font-family:Arial, sans-serif;  margin: 0;
            padding: 5px;">According to the Rites of the Holy Roman Catholic Church</p>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width: 35%; text-align: right; font-size: 20px;"> &nbsp;&nbsp;&nbsp;&nbsp;on the day of
                    &nbsp;</td>
                <td style="width: 60%; font-size: 20px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['date_of_marriage']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width: 50%; text-align: right; font-size: 20px;"> The Marriage was soeminized by Rev.</td>
                <td style="width: 40%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;">
                <?= htmlspecialchars($user['rev']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width: 33%; text-align: right; font-size: 20px;"> in presence the of</td>
                <td style="width: 33%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['presence1']) ?><t/td>
                <td style="width: 5%; font-size: 20px;">
                <td style="width: 35%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['presence2']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width: 33%; text-align: right; font-size: 20px;"> Residence </td>
                <td style="width: 33%; font-size: 20px; text-align : center;  white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['address1']) ?></td>
                <td style="width: 5%; font-size: 20px; text-align: right;"></td>
                <td style="width: 35%; font-size: 20px; text-align : center; white-space: nowrap; border-bottom: 1px solid black;"><?= htmlspecialchars($user['address2']) ?>
                </td>
            </tr>
        </table>

        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width:90%; text-align: right; font-size: 20px;">witnesses as appears from the Marriage
                    Records of the Church, Book No.</td>
                <td style="width:4%; font-size: 20px;  border-bottom: 1px solid black;"><?= htmlspecialchars($user['book']) ?>
        </table>
        <table style="width: 60%; margin-left: 0%;">
            <tr>
                <td style="width:5%; text-align: right; font-size: 20px;">Page no</td>
                <td style="width:5%; font-size: 20px;  border-bottom: 1px solid black;"><?= htmlspecialchars($user['page']) ?>
                <td style="width:0%; text-align: right; font-size: 20px;">Line</td>
                <td style="width:5%; font-size: 20px;  border-bottom: 1px solid black;"><?= htmlspecialchars($user['line']) ?>
                </td>
            </tr>
        </table>
        <br>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width:42%; text-align: right; font-size: 20px;">I further certify that the Marriage License
                    No.</td>
                <td style="width:6%; font-size: 16px; text-align: center; border-bottom: 1px solid black;"><?= htmlspecialchars($user['license']) ?>
                <td style="width:10%; text-align: right; font-size: 20px;">issued at</td>
                <td style="width:20%; font-size: 20px; text-align: center;  border-bottom: 1px solid black;"><?= htmlspecialchars($user['issue']) ?>
                </td>
            </tr>
        </table>
        <table style="width: 90%; margin-left: 0%;">
            <tr>
                <td style="width:10%; text-align: right; font-size: 20px;">on</td>
                <td style="width:30%; font-size: 20px; text-align: center;  border-bottom: 1px solid black;"><?= htmlspecialchars($user['date_of_marriage']) ?>
                <td style="width:30%; text-align: right; font-size: 20px;">in favor of said parties was exhibited.</td>
                </td>
            </tr>
        </table>
        <table style="width: 60%; margin-left: 0%;">
            <tr>
                <td style="width:5%; text-align: right; font-size: 20px;"></td>
                <td style="width:5%; font-size: 20px;  border-bottom: 1px solid white;">
                <td style="width:0%; text-align: right; font-size: 20px;">Dated</td>
                <td style="width:5%; font-size: 20px; text-align: center;  border-bottom: 1px solid black;"><?= htmlspecialchars($user['created_at']) ?>
                </td>
            </tr>
        </table>
      <br>
      <br>
      <br>
      <p style="font-size: 20px; padding: 0px; margin: 0; margin-left: 75%; width: 30%;"><strong><a style="font-size: 25px;"><strong><?= htmlspecialchars($user['priest_name']) ?></strong></a></strong></p>
<p style="font-size: 20px; padding: 0px; margin: 0; margin-left: 75%;"><strong>Parish Priest</strong></p>


    </div>
        <script>
            window.onload = function () {
                window.print();
            };
        </script>