<?php
	include "../koneksi.php";
	include "function.php";
	
?>
	<head>
	
    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

	
	</head>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">.:: Laporan ::.<!-- Button trigger modal -->
			<a type="button" href='cetak_laporan.php' class="btn btn-primary" target='blank' style="float:right;">
				Cetak 
			</a>
		</h2>	
		
<!-- /.row -->
	<div class="modal fade" id="addSurvey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
	</div>	
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Laporan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="col-lg-12">
								<!-- /.panel-heading -->
								<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover" id="dataTables-example5">
										<thead>
											<tr>
												<th><center>No</center></th>
												<th><center>Bulan</center></th>
												<th><center>Tahun</center></th>
												<th><center>Nilai Perkembangan Aktual</center></th>
												<th><center>Fuzzifikasi</center></th>
												<th><center>Hasil Peramalan</center></th>
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
								</div>
								<!-- /.panel-body -->
							</div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
    </div>
                <!-- /.col-lg-12 -->
</div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
		
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example2').DataTable({
                responsive: true
        });
    });
    </script>
	
	 <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example3').DataTable({
                responsive: true
        });
    });
    </script>
	
	
	 <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example4').DataTable({
                responsive: true
        });
    });
    </script>
	
	
	 <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example5').DataTable({
                responsive: true
        });
    });
    </script>
	