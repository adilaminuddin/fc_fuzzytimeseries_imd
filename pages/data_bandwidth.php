<?php

	include "../koneksi.php";

	$stmt1 = "";
	if(isset($_POST['add'])){
	//SELECT `id`, `bulan`, `tahun`, `jumlah` FROM `kebutuhan_bandwidth` WHERE 1
		$qrySelect = "SELECT * FROM `kebutuhan_bandwidth` WHERE  `bulan` = '".$_POST['bulan']."' and `tahun` = '".$_POST['tahun']."' and `jumlah` = '".$_POST['jumlah']."'";
		$qrySelect2 = mysqli_query($conn,$qrySelect);
		$count = mysqli_num_rows($qrySelect2);
		if($count == 0){
			$qry = "INSERT INTO `kebutuhan_bandwidth`(`bulan`, `tahun`, `jumlah`) VALUES (".$_POST['bulan'].",".$_POST['tahun'].",".$_POST['jumlah'].")";
			$qry2 = mysqli_query($conn,$qry);
			if($qry2) $stmt1 = "<div class='alert alert-success'>Tambah Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
				else $stmt1 = "<div class='alert alert-danger'>Tambah Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
		else{
			$stmt1 = "<div class='alert alert-danger'>Data Sudah Ada<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
	}
	
	if(isset($_POST['edits']) && isset($_POST['id'])){
		
		$qrySelect = "SELECT * FROM `kebutuhan_bandwidth` WHERE  `bulan` = '".$_POST['bulan']."' and `tahun` = '".$_POST['tahun']."' and `jumlah` = '".$_POST['jumlah']."'";
		$qrySelect2 = mysqli_query($conn,$qrySelect);
		$count = mysqli_num_rows($qrySelect2);
		if($count == 0){
			$qry = "UPDATE kebutuhan_bandwidth SET `bulan` = ".$_POST['bulan'].", `tahun` = ".$_POST['tahun'].", `jumlah` = ".$_POST['jumlah']." WHERE id = ".$_POST['id'];
			$qry2 = mysqli_query($conn,$qry);
			if($qry2) $stmt1 = "<div class='alert alert-success'>Edit Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
				else $stmt1 = "<div class='alert alert-danger'>Edit Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
		else{
			$stmt1 = "<div class='alert alert-danger'>Data Sudah Ada<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
	}
	
	if(isset($_POST['hapus']) && isset($_POST['id'])){
		$qryD = "DELETE FROM kebutuhan_bandwidth WHERE id = ".$_POST['id'];
		$qryD2 = mysqli_query($conn,$qryD);
		
		if($qryD2) $stmt1 = "<div class='alert alert-success'>Hapus Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
			else $stmt1 = "<div class='alert alert-danger'>Hapus Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
	}
	
?>
	<head>
	
    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

	
	</head>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">.:: Data Nilai Siswa ::.<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSurvey" style="float:right;">
				Input Data
			</button>
		</h2>	
		
	<?php echo $stmt1; ?>
    
	
<!-- /.row -->
	<div class="modal fade" id="addSurvey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="?content=Data_Bandwidth" method="POST">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Input</h4>
						</div>
						<div class="modal-body">
							<fieldset>
								<div class="form-group">
									<label>Bulan:</label>
									<select name='bulan' class='form-control'>
									<?php
										$qry = "select * from bulan";
										$qry2 = mysqli_query($conn,$qry);
										while($dataB = mysqli_fetch_array($qry2)){
											echo "<option value='".$dataB['id']."'>".ucwords($dataB['nama'])."</option>";
										} 
									?>
									</select>
									<br>
									
									<label>Tahun:</label>
									<input class="form-control"  placeholder="Tahun"  name="tahun" type="text">
									<br>
									
									<label>Jumlah Nilai Rata-Rata:</label>
									<input  class="form-control"  placeholder="Jumlah"  name="jumlah" type="number" min="1">
									<br>
										
								</div>
							</fieldset>
						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" name="add" class="btn btn-primary" http-equiv='refresh'>Save</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
	</div>	
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Data Nilai Siswa
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>Bulan</center></th>
                                            <th><center>Tahun</center></th>
                                            <th><center>Nilai Perkembangan</center></th>
											<th><center>Act</center></th>
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
												echo "<td>
													<center><button class='btn btn-warning' data-toggle='modal' data-target='#edits".$data['id']."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>
													<button class='btn btn-danger' data-toggle='modal' data-target='#hapus".$data['id']."'><span class='fa fa-trash' aria-hidden='true'></span></button></center>
												</td>";
												echo "</tr>";
												
												?>
												
															<div class="modal fade" id="edits<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<form action="?content=Data_Bandwidth" method="POST">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																					<h4 class="modal-title" id="myModalLabel">Edit</h4>
																				</div>
																				<div class="modal-body">
																					<fieldset>
																						<div class="form-group">
																							<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
																							
																							<label>Bulan:</label>
																							<select name='bulan' class='form-control'>
																							<?php
																								$qryB = "select * from bulan";
																								$qryB2 = mysqli_query($conn,$qryB);
																								while($dataB = mysqli_fetch_array($qryB2)){
																									$selected = "";
																									if($data['bulan'] == $dataB['nama']) $selected = "selected";
																									echo "<option $selected value='".$dataB['id']."'>".ucwords($dataB['nama'])."</option>";
																								} 
																							?>
																							</select>
																							<br>
																							
																							<label>Tahun:</label>
																							<input class="form-control"  placeholder="Tahun"  name="tahun" value='<?php echo $data['tahun']; ?>' type="text">
																							<br>
																							
																							<label>Jumlah Nilai Rata-Rata:</label>
																							<input  class="form-control"  placeholder="Jumlah"  name="jumlah" value='<?php echo $data['jumlah']; ?>' type="number" min="1">
																							<br>
																						</div>
																					</fieldset>
																				</div>
																				<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																						<button type="submit" name="edits" class="btn btn-primary" http-equiv='refresh'>Edit</button>
																				</div>
																			</form>
																		</div>
																		<!-- /.modal-content -->
																	</div>
																	<!-- /.modal-dialog -->
															</div>	
															
															<!-- hapus --->
															<div class="modal fade" id="hapus<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<form action="?content=Data_Bandwidth" method="POST">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																					<h4 class="modal-title" id="myModalLabel">Hapus</h4>
																				</div>
																				<div class="modal-body">
																					<fieldset>
																						<div class="form-group">
																								<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
																								Anda yakin ingin menghapus?
																						</div>
																					</fieldset>
																				</div>
																				<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
																						<button type="submit" name="hapus" class="btn btn-primary" http-equiv='refresh'>Ya</button>
																				</div>
																			</form>
																		</div>
																		<!-- /.modal-content -->
																	</div>
																	<!-- /.modal-dialog -->
															</div>	
												
												<?php
												$i++;
											}
											
										?>
										
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
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
	
	