<?php
	session_start();
	
	include "../koneksi.php";
	include "function.php";
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Laporan Perkembangan Belajar Siswa Daring</title>
	<style>
		* {
		    box-sizing: border-box;
		}

		.header {
			text-align: center;
		    padding: 15px;
		}

		.row:after {
		    content: "";
		    clear: both;
		    display: block;
		}

		[class*="col-"] {
		    float: left;
		    padding: 15px;
		}

		.col-1 {width: 8.33%;}
		.col-2 {width: 16.66%;}
		.col-3 {width: 25%;}
		.col-4 {width: 33.33%;}
		.col-5 {width: 41.66%;}
		.col-6 {width: 50%;}
		.col-7 {width: 58.33%;}
		.col-8 {width: 66.66%;}
		.col-9 {width: 75%;}
		.col-10 {width: 83.33%;}
		.col-11 {width: 91.66%;}
		.col-12 {width: 100%;}

		table {
		    border-collapse: collapse;
		    width: 100%;
		}

		th, td {
		    padding: 8px;
		}

		tr:nth-child(even){background-color: #f2f2f2}
	</style>
</head>
<body>
	<div class="header">
		<h3 style="text-align:center; margin-top: 0px;"><strong>Laporan Hasil Peramalan Perkembangan Belajar Siswa Daring</strong></h3>

		<h1>_____________________________________________________</h1>
	</div>
		
		<table class="table table-striped table-bordered table-hover"  border='1'>
			<thead>
				<tr>
					<th><center>No</center></th>
					<th><center>Bulan</center></th>
					<th><center>Tahun</center></th>
					<th><center>Nilai Raport Aktual</center></th>
					<th><center>Fuzzifikasi</center></th>
					<th><center>Peramalan</center></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$interval = $_SESSION['interval'];
					$rata2 = $_SESSION['rata2'];
					
					$qryS = "SELECT k.id, b.nama as bulan, k.tahun, k.jumlah FROM `kebutuhan_bandwidth` k, bulan b where k.bulan = b.id";
					$qry2 = mysqli_query($conn,$qryS);
					$i=0; $ramalan = "-";
					while($data = mysqli_fetch_array($qry2)){
						echo "<tr>";
						echo "<td><center>".($i+1)."</center></td>";
						echo "<td align='center'>".ucwords($data['bulan'])."</td>";
						echo "<td align='center'>".ucwords($data['tahun'])."</td>";
						echo "<td><center>".$data['jumlah']."</center></td>";
						$indeks = cek_interval($data['jumlah'],$interval);
						echo "<td><center>A<sub>".$indeks."</sub></center></td>";
						echo "<td><center>";
							if($i==0) echo $ramalan;
							else echo number_format($ramalan,2);
						echo "</center></td>";
						echo "</tr>";
						
						$temp_bulan = $data['bulan'];
						$temp_tahun = $data['tahun'];
						$jumlah = $data['jumlah'];
						$ramalan = $rata2[$indeks-1];
						$hasil[] = $ramalan;
						$i++;
					}
						$bln = cek_bulan($temp_bulan);
						$data_bln = mysqli_fetch_array(mysqli_query($conn,"select * from bulan where id = ".$bln));
						$bulan = $data_bln['nama'];
						$tahun = cek_tahun($bln, $temp_tahun);
						
						echo "<tr>";
							echo "<td><center>".($i+1)."</center></td>";
							echo "<td align='center'>".ucwords($bulan)."</td>";
							echo "<td align='center'>".$tahun."</td>";
							//echo "<td align='center'>".$jumlah."</td>";
							echo "<td align='center'>-</td>";
							echo "<td><center>-</center></td>";
							echo "<td><center>".number_format($ramalan,2)."</center></td>";
						echo "</tr>";
				?>
			</tbody>
		</table>
	<script>
		// window.load = print_d();  
		// function print_d(){  
	 		window.print();
	 	//}  
 	</script>
</body>
</html>