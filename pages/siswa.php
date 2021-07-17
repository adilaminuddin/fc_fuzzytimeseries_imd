<?php
	
	include "../koneksi.php";
	include "function.php";

    $stmt1 = "";
	if(isset($_POST['add'])){
	//SELECT `id`, `bulan`, `tahun`, `jumlah` FROM `kebutuhan_bandwidth` WHERE 1
		$qrySelect = "SELECT * FROM tb_siswa WHERE `nisn` = '".$_POST['nisn']."' and `nama_siswa` = '".$_POST['nama_siswa']."' and `kelas_id` = '".$_POST['kelas_id']."'";
		$qrySelect2 = mysqli_query($conn,$qrySelect);
		$count = mysqli_num_rows($qrySelect2);
		if($count == 0){
			$qry = "INSERT INTO tb_siswa(nisn,nama_siswa, kelas_id) VALUES ('".$_POST['nisn']."','".$_POST['nama_siswa']."','".$_POST['kelas_id']."')";
			$qry2 = mysqli_query($conn,$qry);
			if($qry2) $stmt1 = "<div class='alert alert-success'>Tambah Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
				else $stmt1 = "<div class='alert alert-danger'>Tambah Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
		else{
			$stmt1 = "<div class='alert alert-danger'>Data Sudah Ada<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
	}

    if(isset($_POST['edits']) && isset($_POST['id_siswa'])){
		
		$qrySelect = "SELECT * FROM `tb_siswa` WHERE `nisn` = '".$_POST['nisn']."' and `nama_siswa` = '".$_POST['nama_siswa']."'";
		$qrySelect2 = mysqli_query($conn,$qrySelect);
		$count = mysqli_num_rows($qrySelect2);
		if($count == 0){
			$qry = "UPDATE tb_mapel SET $nama_mapel => $nama_mapel";
			$qry2 = mysqli_query($conn,$qry);
			if($qry2) $stmt1 = "<div class='alert alert-success'>Edit Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
				else $stmt1 = "<div class='alert alert-danger'>Edit Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
		else{
			$stmt1 = "<div class='alert alert-danger'>Data Sudah Ada<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
	}
	
	if(isset($_POST['hapus']) && isset($_POST['id_siswa'])){
		$qryD = "DELETE FROM tb_siswa WHERE id_siswa = ".$_POST['id_siswa'];
		$qryD2 = mysqli_query($conn,$qryD);
		
		if($qryD2) $stmt1 = "<div class='alert alert-success'>Hapus Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
			else $stmt1 = "<div class='alert alert-danger'>Hapus Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
	}

?>
    <head>
	
    <!-- DataTables CSS -->
    <!-- <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet"> -->

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

	
	</head>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">.:: Data Siswa ::.<!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSurvey" style="float:right;">
				Input Data
			</button>
		</h2>

    <?php echo $stmt1; ?>
    <div class="modal fade" id="addSurvey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="?content=Data_Siswa" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Input</h4>
                    </div>
                    <div class="modal-body">
                        <fieldset>
                            <div class="form-group">

                                <label>NISN:</label>
                                <input class="form-control"  placeholder="NISN"  name="nisn" type="text" required>
                                <br>

                                <label>Nama Siswa:</label>
                                <input class="form-control"  placeholder="Nama Siswa"  name="nama_siswa" type="text" required>
                                <br>

                                <label>Kelas & Jurusan:</label> 
                                <select name='kelas_id' class='form-control'>
                                <?php
                                    $qry = "SELECT k.id_kelas, k.nama_kelas, j.nama_jurusan FROM `tb_kelas` k, `tb_jurusan` j WHERE k.jurusan_id = j.id_jurusan";
                                    $qry2 = mysqli_query($conn,$qry);
                                    while($dataB = mysqli_fetch_array($qry2)){
                                        echo "<option value='".$dataB['id_kelas']."'>".ucwords($dataB['nama_kelas'])."&nbsp;-&nbsp;".ucwords($dataB['nama_jurusan'])."</option>";
                                    } 
                                ?>
                                </select>
                                <br>
                                </select>
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
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th><center>No</center></th>
                            <th><center>NISN</center></th>
                            <th><center>Nama Siswa</center></th>
                            <th><center>Kelas</center></th>
                            <th><center>Jurusan</center></th>
                            <th><center>Act</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $qryS = "SELECT s.nisn, s.id_siswa, s.nama_siswa, k.nama_kelas, j.nama_jurusan FROM `tb_siswa` s, `tb_kelas` k, `tb_jurusan` j WHERE s.kelas_id=k.id_kelas AND k.jurusan_id=j.id_jurusan";
                            $qry2 = mysqli_query($conn,$qryS);
                            $i=1;
                            while($data = mysqli_fetch_array($qry2)){
                                ?>
                                <tr>
                                    <td align="center"><?php echo $i++  ?></td>
                                    <td align="center"><?php echo $data['nisn'] ?></td>
                                    <td align="center"><?php echo $data['nama_siswa'] ?></td>
                                    <td align="center"><?php echo $data['nama_kelas'] ?></td>
                                    <td align="center"><?php echo $data['nama_jurusan'] ?></td>
                                    <td>
                                        <center>
                                            <button class='btn btn-warning' data-toggle='modal' data-target="#edits<?php echo $data['id_siswa'] ?>"><span class='fas fa-pencil-alt' aria-hidden='true'></span></button>
                                            <button class='btn btn-danger' data-toggle='modal' data-target="#hapus<?php echo $data['id_siswa'] ?>"><span class='fa fa-trash' aria-hidden='true'></span></button>
                                        </center>
                                    </td>

                                    <!-- edit -->
                                    <div class="modal fade" id="edits<?php echo $data['id_siswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="?content=Data_Mapel" method="POST">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <input type="hidden" name="id" value="<?php echo $data['id_siswa']; ?>">

                                                                <label>NISN:</label>
                                                                <input  class="form-control"  name="nisn" value='<?php echo $data['nisn']; ?>' type="text" disabled>
                                                                <br>
                                                                
                                                                <label>Nama:</label>
                                                                <input  class="form-control"  name="nama_siswa" value='<?php echo $data['nama_siswa']; ?>' type="text">
                                                                <br>
                                                                
                                                                <label>Kelas & Jurusan:</label>
                                                                <input  class="form-control"  name="nama_kelas" value='<?php echo $data['nama_kelas']; ?>' type="text">
                                                                <br>

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
                                    <div class="modal fade" id="hapus<?php echo $data['id_siswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="?content=Data_Siswa" method="POST">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Hapus</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                    <input type="hidden" name="id_siswa" value="<?php echo $data['id_siswa']; ?>">
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

                                </tr>
                                
                                <?php
                            }
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
            
        </div>
    <!-- /.panel-body -->
    </div>

    </div>
</div>




<!-- jQuery -->
<!-- <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script> -->

<!-- Custom Theme JavaScript -->
<!-- <script src="../dist/js/sb-admin-2.js"></script> -->

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
});
</script>