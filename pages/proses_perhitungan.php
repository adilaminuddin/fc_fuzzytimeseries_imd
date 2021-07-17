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
		<h2 class="page-header">.:: Proses Perhitungan ::.<!-- Button trigger modal -->
			
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
							<ul class="nav nav-pills">
								<li class="active"><a href="#interval" data-toggle="tab">Interval</a>
								</li>
								<li><a href="#fuzzifikasi" data-toggle="tab">Fuzzifikasi</a>
								</li>
								<li><a href="#flr" data-toggle="tab">Fuzzy Logic Relationship</a>
								</li>
								<li><a href="#flrg" data-toggle="tab">Fuzzy Logic Relationship Group</a>
								</li>
								<li><a href="#defuzzifikasi" data-toggle="tab">Defuzzifikasi FLRG</a>
								</li>
								<li><a href="#hasil" data-toggle="tab">Hasil Peramalan</a>
								</li>
								<li><a href="#akurasi" data-toggle="tab">Akurasi Peramalan</a>
								</li>
							</ul>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="col-lg-12">
								<!-- /.panel-heading -->
								<div class="panel-body">
									<!-- Tab panes -->
									<div class="tab-content" style='margin-top:-20px'>
										<div class="tab-pane fade in active" id="interval">
											<?php
												$qry = "select * from kebutuhan_bandwidth";
												$qryR = mysqli_query($conn,$qry);
												while($data = mysqli_fetch_array($qryR)){
													$data_band[] = $data['jumlah'];
												}
												$jml = 0;
												for($i=0; $i<(count($data_band)-1); $i++){
													if($data_band[$i] > $data_band[$i+1])
														$jml += $data_band[$i] - $data_band[$i+1];
													else 
														$jml += $data_band[$i+1] - $data_band[$i];
												}
												$jarak = round(ceil((($jml/(count($data_band)-1))/2)),-2);
												
												
												$qry1 = "SELECT min(jumlah) as min FROM `kebutuhan_bandwidth`";
												$qry2 = mysqli_query($conn,$qry1);
												$min = mysqli_fetch_array($qry2);
												$min = $min['min'];
												
												$qry3 = "SELECT max(jumlah) as max FROM `kebutuhan_bandwidth`";
												$qry4 = mysqli_query($conn,$qry3);
												$max = mysqli_fetch_array($qry4);
												$max = $max['max'];
												
												$max = (round($max, -2)+100);
												
												$temp_min = $max;
												$temp_max = 0;
												$i=0;
												while($temp_min >= $min){
													$temp_max = $temp_min;
													$temp_min = $temp_min-$jarak;
													$temp_interval[$i][0] = $temp_min;
													$temp_interval[$i][1] = $temp_max;
													$i++;
												}
												
												$interval = transpose($temp_interval);
												echo "<br>";
												//print_r($interval);
											?>
											
														<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
															<?php
																$warna = array("danger","primary","success","info","warning");
																$count_warna = 0;
																for($i=0; $i<count($interval); $i++){
																	echo "<div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>";
																	echo "<a class='btn btn-sm btn-block btn-".$warna[$count_warna]." block' style='margin-top:10px;'>U<sub>".($i+1)."</sub></a>";
																	echo "<a class='btn btn-sm btn-block btn-default block' style='margin-bottom:10px;'><center>".$interval[$i][0]."-".$interval[$i][1]."</center></a>";
																	echo "</div>";
																	if($count_warna < 4) $count_warna++;
																	else $count_warna = 0;
																}
																
															?>
														</div>
										</div>
										<div class="tab-pane fade in" id="fuzzifikasi">
											<br>
											<div class="dataTable_wrapper">
												<table class="table table-striped table-bordered table-hover" id="dataTables-example">
												<thead>
													<tr>
														<th><center>No</center></th>
														<th><center>Bulan</center></th>
														<th><center>Tahun</center></th>
														<th><center>Bandwidth</center></th>
														<th><center>Fuzzifikasi</center></th>
													</tr>
												</thead>
												<tbody>
													<?php
													
														$qryS = "SELECT k.id, b.nama as bulan, k.tahun, k.jumlah FROM `kebutuhan_bandwidth` k, bulan b where k.bulan = b.id";
														$qry2 = mysqli_query($conn,$qryS);
														$i=0;
														while($data = mysqli_fetch_array($qry2)){
															echo "<tr>";
															echo "<td><center>".($i+1)."</center></td>";
															echo "<td align='center'>".ucwords($data['bulan'])."</td>";
															echo "<td align='center'>".ucwords($data['tahun'])."</td>";
															echo "<td><center>".$data['jumlah']."</center></td>";
															
															$indeks = cek_interval($data['jumlah'],$interval);
															$fuzzifikasi[$i] = $indeks;
															echo "<td><center>A<sub>".$indeks."</sub></center></td>";
															echo "</tr>";
															
															$i++;
														}
														
													?>
													
												</tbody>
												</table>
											</div>
											<!-- /.table-responsive -->
										</div>
										
										<div class="tab-pane fade in" id="flr">
											<br>
											<div class="dataTable_wrapper">
												<table class="table table-striped table-bordered table-hover" id="dataTables-example2">
												<thead>
													<tr>
														<th><center>No</center></th>
														<th><center>Urutan Waktu</center></th>
														<th><center>FLR</center></th>
													</tr>
												</thead>
												<tbody>
													<?php
														$qryS = "SELECT k.id, b.nama as bulan, k.tahun, k.jumlah FROM `kebutuhan_bandwidth` k, bulan b where k.bulan = b.id";
														$qry2 = mysqli_query($conn,$qryS);
														while($data = mysqli_fetch_array($qry2)){
															$waktu[] = $data;
														}
														
														/* for($i=0; $i<count($interval); $i++){
															$flrg[$i][0] = "";
														} */
														
														for($i=0; $i<(count($waktu)-1); $i++){
														
															echo "<tr>";
															echo "<td><center>".($i+1)."</center></td>";
															echo "<td style='padding-left:30px'>".ucwords($waktu[$i][1])." ".$waktu[$i][2]." - ".ucwords($waktu[($i+1)][1])." ".$waktu[($i+1)][2]."</td>";
															echo "<td><center>A<sub>".$fuzzifikasi[$i]."</sub> - A<sub>".$fuzzifikasi[($i+1)]."</sub></center></td>";
															echo "</tr>";
															
															$save_flrg[($fuzzifikasi[$i]-1)][] = $fuzzifikasi[($i+1)];
														}
														
													?>
												</tbody>
												</table>
											</div>
                            <!-- /.table-responsive -->
										</div>
										
										<div class="tab-pane fade in" id="flrg">
											<br>
											<div class="dataTable_wrapper">
												<table class="table table-striped table-bordered table-hover" id="dataTables-example3">
												<thead>
													<tr>
														<th><center>No</center></th>
														<th><center>Current State</center></th>
														<th><center>Hasil Peramalan</center></th>
													</tr>
												</thead>
												<tbody>
													<?php
													
														for($i=0; $i<count($interval); $i++){
															if(!empty($save_flrg[$i])){
																$unik[$i] = array_unique($save_flrg[$i]);
																foreach($unik[$i] as $key=>$value){
																	$flrg[$i][] = $value;
																}
															}
														}
														$x=0;
														for($i=0; $i<count($interval); $i++){
															if(!empty($flrg[$i])){
																echo "<tr>";
																	echo "<td align='center'>".($x+1)."</td>";
																	echo "<td align='center'>A<sub>".($i+1)."</sub> => </td>";
																	echo "<td align='center'>";
																	for($j=0; $j<count($flrg[$i]); $j++){
																		if($j<(count($flrg[$i])-1))
																			echo "A<sub>".$flrg[$i][$j]."</sub>, ";
																		else
																			echo "A<sub>".$flrg[$i][$j]."</sub>";
																	}
																	echo "</td>";
																echo "</tr>";
																$x++;
															}
														}
													?>
													
												</tbody>
												</table>
											</div>
										<!-- /.table-responsive -->
										</div>
										
										<div class="tab-pane fade in" id="defuzzifikasi">
											<br>
											<div class="dataTable_wrapper">
												<table class="table table-striped table-bordered table-hover" id="dataTables-example4">
												<thead>
													<tr>
														<th><center>No</center></th>
														<th><center>Current State</center></th>
														<th><center>Next State</center></th>
													</tr>
												</thead>
												<tbody>
													<?php
													
														
														for($i=0; $i<count($interval); $i++){
															$jml = 0;
															if(!empty($flrg[$i])){
																for($j=0; $j<count($flrg[$i]); $j++){
																	$jml += (($interval[($flrg[$i][$j]-1)][0]+$interval[($flrg[$i][$j]-1)][1])/2);
																}
																$rata2[] = $jml/count($flrg[$i]);
															}
															else{
																$rata2[] = (($interval[$i][0]+$interval[$i][1])/2);
															}
														}
														
														for($i=0; $i<count($rata2); $i++){
															echo "<tr>";
																echo "<td align='center'>".($i+1)."</td>";
																echo "<td align='center'>A<sub>".($i+1)."</sub></td>";
																echo "<td align='center'>".number_format($rata2[$i],2)."</td>";
															echo "</tr>";
														}
														
													?>
												</tbody>
												</table>
											</div>
										<!-- /.table-responsive -->
										</div>
										
										<div class="tab-pane fade in" id="hasil">
											<br>
											<div class="dataTable_wrapper">
												<table class="table table-striped table-bordered table-hover" id="dataTables-example5">
												<thead>
													<tr>
														<th><center>No</center></th>
														<th><center>Bulan</center></th>
														<th><center>Tahun</center></th>
														<th><center>Data Perkembangan Aktual</center></th>
														<th><center>Fuzzifikasi</center></th>
														<th><center>Peramalan</center></th>
													</tr>
												</thead>
												<tbody>
													<?php
														$_SESSION['interval'] = $interval;
														$_SESSION['rata2'] = $rata2;
														
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
																echo "<td align='center'>-</td>";
																echo "<td><center>-</center></td>";
																echo "<td><center>".number_format($ramalan,2)."</center></td>";
															echo "</tr>";
													?>
												</tbody>
												</table>
											</div>
										<!-- /.table-responsive -->
										</div>
										
										<div class="tab-pane fade in" id="akurasi">
											<br>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<?php
														
														$qry = "select * from kebutuhan_bandwidth";
														$qry2 = mysqli_query($conn,$qry);
														$row = mysqli_num_rows(mysqli_query($conn,$qry));
														$i=0; $jml = 0;
														
														while($data2 = mysqli_fetch_array($qry2)){
															$jml += abs(($data2['jumlah']-$hasil[$i])/$data2['jumlah']);
															$i++;
														} 
														$akurasi = (100*$jml)/$row;
														echo "<button class='btn btn-info'>MAPE</button>&nbsp;= <u>100 % x ".number_format($jml,2);
														echo "</u><br/>";
														echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
														echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
														echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row;
														echo "<br/>";
														
														echo "<button class='btn btn-info'>MAPE</button>&nbsp;= ".number_format($akurasi,2)." %";
														echo "<br/>";
														
													?>
												</div>
										</div>
										
									</div>
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
	