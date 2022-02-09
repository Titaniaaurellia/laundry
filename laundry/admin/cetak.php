<!doctype html>
<html lang="en">
<?php
  session_start();
  if($_SESSION['status_login']!=true){
   header('location:../index.php');
  }
  ?>
  <head>
  	<title>Web Laundry</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
  </head>
  <body>
		
  <div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<h1><a href="index.html" class="logo">L.</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="home.php"><span class="fa fa-home"></span>Home</a>
          </li>
          <li>
              <a href="tampil_user.php"><span class="fa fa-user"></span>Petugas</a>
          </li>
          <li>
            <a href="tampil_member.php"><span class="fa fa-sticky-note"></span>Member</a>
          </li>
          <li>
            <a href="tampil_outlet.php"><span class="fa fa-cogs"></span>Outlet</a>
          </li>
          <li>
            <a href="paket.php"><span class="fa fa-paper-plane"></span>Paket Laundry</a>
          </li>
          <li>
            <a href="tampil_transaksi.php"><span class="fa fa-exchange"></span>Transaksi</a>
          </li>
        </ul>

        <div class="footer">
        	<p>
					  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
					</p>
        </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="generate.php">Generate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <div class="card-header pb-0">
          <h3>Laporan Transaksi</h3>
        </div>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

    </style>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jenis Paket</th>
            <th>QTY</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
        <?php
        include "koneksi.php";

        $data = mysqli_query($conn, "select * from transaksi");
        while ($dt_transaksi = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td style='text-align: center;'><?php echo $dt_transaksi['id_transaksi'] ?></td>
                <?php
                $qry_member = mysqli_query($conn, "select * from transaksi join member on member.id_member=transaksi.id_member where id_transaksi= '" .$dt_transaksi['id_transaksi'] . "'");
                $dt_member = mysqli_fetch_array($qry_member);
                ?>
                <td><?php echo $dt_member['nama']; ?></td>
                <?php
                $qry_paket = mysqli_query($conn, "select * from transaksi join paket on paket.id_paket=transaksi.id_paket where id_transaksi='" . $dt_transaksi['id_transaksi'] . "'");
                $dt_paket = mysqli_fetch_array($qry_paket);
                ?>
                <td><?php echo $dt_paket['jenis']; ?></td>
                <td><?php echo $dt_transaksi['qty']; ?></td>
                <td><?php echo $dt_transaksi['tanggal']; ?></td>
                <td><?php echo $dt_transaksi['status']; ?> </td>
                <?php
                $total = $dt_transaksi['qty'] * $dt_paket['harga'];
                ?>
                <td>Rp <?=$total?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>