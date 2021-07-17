<?php
	
	include "../koneksi.php";
	include "function.php";

    $stmt1 = "";
	if(isset($_POST['add'])){
	//SELECT `id`, `bulan`, `tahun`, `jumlah` FROM `kebutuhan_bandwidth` WHERE 1
		$qrySelect = "SELECT * FROM `tb_mapel` WHERE  `nama_mapel` = '".$_POST['nama_mapel']."'";
		$qrySelect2 = mysqli_query($conn,$qrySelect);
		$count = mysqli_num_rows($qrySelect2);
		if($count == 0){
            $nama_mapel = $_POST['nama_mapel'];
			$qry = "INSERT INTO `tb_mapel`(`nama_mapel`) VALUES ('$nama_mapel')";
			$qry2 = mysqli_query($conn,$qry);
			if($qry2) $stmt1 = "<div class='alert alert-success'>Tambah Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
				else $stmt1 = "<div class='alert alert-danger'>Tambah Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
		else{
			$stmt1 = "<div class='alert alert-danger'>Data Sudah Ada<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
	}

    if(isset($_POST['edits']) && isset($_POST['id_mapel'])){
		
		$qrySelect = "SELECT id_mapel, nama_mapel FROM `tb_mapel` WHERE  `nama_mapel` = '".$_POST['nama_mapel']."'";
		$qrySelect2 = mysqli_query($conn,$qrySelect);
		$count = mysqli_num_rows($qrySelect2);
		if($count == 0){
            $nama_mapel = $_POST['nama_mapel'];
            $id_mapel = $_POST['id_mapel'];
			$qry = "UPDATE tb_mapel SET '$nama_mapel' WHERE id_mapel = '$id_mapel'";
			$qry2 = mysqli_query($conn,$qry);
			if($qry2) $stmt1 = "<div class='alert alert-success'>Edit Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
				else $stmt1 = "<div class='alert alert-danger'>Edit Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
		else{
			$stmt1 = "<div class='alert alert-danger'>Data Sudah Ada<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
        
	}
	
	if(isset($_POST['hapus']) && isset($_POST['id_mapel'])){
		$qryD = "DELETE FROM tb_mapel WHERE id_mapel = ".$_POST['id_mapel'];
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
		<h2 class="page-header">.:: Data Mata Pelajaran ::.<!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSurvey" style="float:right;">
				Input Data
			</button>
		</h2>

    <?php echo $stmt1; ?>
    <div class="modal fade" id="addSurvey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="?content=Data_Mapel" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Input</h4>
                    </div>
                    <div class="modal-body">
                        <fieldset>
                            <div class="form-group">
                                <label>Nama Mata Pelajaran:</label>
                                <input class="form-control"  placeholder="Nama"  name="nama_mapel" type="text" required>
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
        <!-- <div class="panel-heading">
            Data Mata Pelajaran
        </div> -->
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th><center>No</center></th>
                            <th><center>Mata Pelajaran</center></th>
                            <th><center>Act</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $qryS = "SELECT * FROM tb_mapel";
                            $qry2 = mysqli_query($conn,$qryS);
                            $i=1;
                            while($data = mysqli_fetch_array($qry2)){
                                ?>
                                <tr>
                                    <td align="center"><?php echo $i++  ?></td>
                                    <td align="center"><?php echo $data['nama_mapel'] ?></td>
                                    <td>
                                        <center>
                                            <button class='btn btn-warning' data-toggle='modal' data-target="#edits<?php echo $data['id_mapel'] ?>"><span class='fas fa-pencil-alt' aria-hidden='true'></span></button>
                                            <button class='btn btn-danger' data-toggle='modal' data-target="#hapus<?php echo $data['id_mapel'] ?>"><span class='fa fa-trash' aria-hidden='true'></span></button>
                                        </center>
                                    </td>

                                    <!-- edit -->
                                    <div class="modal fade" id="edits<?php echo $data['id_mapel']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                <input type="hidden" name="id_mapel" value="<?php echo $data['id_mapel']; ?>">
                                                                
                                                                <label>Nama Mata Pelajaran:</label>
                                                                <input  class="form-control"  name="nama_mapel" value="<?php echo $data['nama_mapel']; ?>" type="text">
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
                                    <div class="modal fade" id="hapus<?php echo $data['id_mapel']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="?content=Data_Mapel" method="POST">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Hapus</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                    <input type="hidden" name="id_mapel" value="<?php echo $data['id_mapel']; ?>">
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