<?php
	
	include "../koneksi.php";
	include "function.php";
    error_reporting(0);
    $stmt1 = "";
	if(isset($_POST['add'])){
		$qrySelect = "SELECT * FROM user WHERE `username` = '".$_POST['username']."' AND `nama_lengkap` = '".$_POST['nama_lengkap']."'";
        $qrySelect2 = mysqli_query($conn,$qrySelect);
		$count = mysqli_num_rows($qrySelect2);
		if($count == 0){
            if($_POST['mapel_id'] == null || $_POST['kelas_id'] == null){
                $mapel_id = 0;
                $kelas_id = 0;
            } else {
                $mapel_id = $_POST['mapel_id'];
                $kelas_id = $_POST['kelas_id'];
            }
			$qry = "INSERT INTO user (username, password,nama_lengkap, role_id, mapel_id,kelas_id) VALUES ('".$_POST['username']."','".$_POST['password']."','".$_POST['nama_lengkap']."',".$_POST['role_id'].",".$mapel_id.",".$kelas_id.")";
			//echo var_dump($qry);
            $qry2 = mysqli_query($conn,$qry);
            //echo var_dump($qry);
			if($qry2) $stmt1 = "<div class='alert alert-success'>Tambah Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
				else $stmt1 = "<div class='alert alert-danger'>Tambah Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
		else{
			$stmt1 = "<div class='alert alert-danger'>Data Sudah Ada<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
	}

    if(isset($_POST['edits']) && isset($_POST['id_user'])){
		
		$qrySelect = "SELECT * FROM user WHERE  `username` = '".$_POST['username']."' and `password` = '".$_POST['password']."' and `nama_lengkap` = '".$_POST['nama_lengkap']."' and `role_id` = '".$_POST['role_id']."'";
		$qrySelect2 = mysqli_query($conn,$qrySelect);
		$count = mysqli_num_rows($qrySelect2);
		if($count == 0){
            $id = $_POST['id_user'];
            $nama = $_POST['nama_lengkap'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role_id = $_POST['role_id'];
			//$qry = "UPDATE `user` SET username = $username, password = $password, nama_lengkap = '".$nama."',  role_id = $role_id WHERE id_user = $id" ;
            $qry = "UPDATE `user` SET `username`='$username',`password`='$password',`nama_lengkap`='$nama',`role_id`='$role_id' WHERE `id_user`='$id'";
			$qry2 = mysqli_query($conn,$qry);
            //echo var_dump($qry);
			if($qry2){
                $stmt1 = "<div class='alert alert-success'>Edit Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
            }else {
                $stmt1 = "<div class='alert alert-danger'>Edit Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
                //echo var_dump($qry2);
            } 
		}
		else{
			$stmt1 = "<div class='alert alert-danger'>Data Sudah Ada<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
	}
	
	if(isset($_POST['hapus']) && isset($_POST['id_user'])){
		$qryD = "DELETE FROM user WHERE id_user = ".$_POST['id_user'];
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
		<h2 class="page-header">.:: Data Guru ::.<!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputdata" style="float:right;">
				Input Data
			</button>
		</h2>

    <?php echo $stmt1; ?>
    <div class="modal fade" id="inputdata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="?content=Data_Guru" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Input</h4>
                    </div>
                    <div class="modal-body">
                        <fieldset>
                            <div class="form-group">
                                <label>Nama Lengkap:</label>
                                <input class="form-control"  placeholder="Nama"  name="nama_lengkap" type="text" require>
                                <br>
                                
                                <label>Username:</label>
                                <input  class="form-control"  placeholder="Username"  name="username" type="text" require>
                                <br>

                                <label>password:</label>
                                <input  class="form-control"  placeholder="Password"  name="password" type="password" require>
                                <br>

                                <label>Sebagai:</label>
                                <select name="role_id" class="form-control" id="automati" require>
                                <?php
                                    $qry = "select * from role order by id_role desc";
                                    $qry2 = mysqli_query($conn,$qry);
                                    while($dataB = mysqli_fetch_array($qry2)){
                                        echo "<option value='".$dataB['id_role']."'>".ucwords($dataB['nama_role'])."</option>";
                                    }
                                ?>
                                </select>
                                <br>

                                <label>Mata Pelajaran:</label>
                                <select name="mapel_id" class="form-control" id="opsimapel" require>
                                <?php
                                    $qry = "select * from tb_mapel";
                                    $qry2 = mysqli_query($conn,$qry);
                                    while($dataB = mysqli_fetch_array($qry2)){
                                        echo "<option value='".$dataB['id_mapel']."'>".ucwords($dataB['nama_mapel'])."</option>";
                                    }echo '<option value="0" hidden>Tidak Ada</option>';
                                    //echo var_dump($qry);
                                ?>
                                </select>
                                <br>

                                <label>Kelas:</label>
                                <select name="kelas_id" class="form-control" id="opsikelas" require>
                                <?php
                                    $qry = "SELECT k.id_kelas, k.nama_kelas, k.jurusan_id,  j.id_jurusan, j.nama_jurusan FROM tb_kelas AS k, tb_jurusan AS j WHERE k.jurusan_id=j.id_jurusan";
                                    $qry2 = mysqli_query($conn,$qry);
                                    while($dataB = mysqli_fetch_array($qry2)){
                                        echo "<option value='".$dataB['id_kelas']."'>".ucwords($dataB['nama_kelas'])."&mdash; ".ucwords($dataB['nama_jurusan'])."</option>";
                                    }echo '<option value="0" hidden>Tidak Ada</option>';
                                    //echo var_dump($qry);
                                ?>
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
        <div class="panel-heading">
            Data Guru
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th><center>No</center></th>
                            <th><center>Nama</center></th>
                            <th><center>Mata Pelajaran</center></th>
                            <th><center>Kelas</center></th>
                            <th><center>Jurusan</center></th>
                            <th><center>Keterangan</center></th>
                            <th><center>Act</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            // SELECT u.id, u.nama_lengkap, r.name as `role`, u.username, u.password FROM `user` u, `role` r where u.role_id = r.id 
                            $qryS = "SELECT u.id_user, u.nama_lengkap, u.username, u.password, u.role_id, u.mapel_id, r.nama_role, m.nama_mapel, k.nama_kelas, j.nama_jurusan FROM `user` u, `role` r, `tb_mapel` m, `tb_kelas` k, `tb_jurusan` j WHERE u.role_id=r.id_role AND u.mapel_id=m.id_mapel AND u.kelas_id=k.id_kelas AND k.jurusan_id=j.id_jurusan";
                            $qry2 = mysqli_query($conn,$qryS);
                            $i=0;
                            while($data = mysqli_fetch_array($qry2)){
                                
                                echo "<tr>";
                                echo "<td><center>".($i+1)."</center></td>";
                                echo "<td align='center'>".ucwords($data['nama_lengkap'])."</td>";
                                echo "<td align='center'>".ucwords($data['nama_mapel'])."</td>";
                                echo "<td align='center'>".ucwords($data['nama_kelas'])."</td>";
                                echo "<td align='center'>".ucwords($data['nama_jurusan'])."</td>";
                                echo "<td><center>".$data['nama_role']."</center></td>";
                                echo "<td><center><button class='btn btn-warning' data-toggle='modal' data-target='#edits".$data['id_user']."'><span class='fas fa-pencil-alt' aria-hidden='true'></span></button>
                                    <button class='btn btn-danger' data-toggle='modal' data-target='#hapus".$data['id_user']."'><span class='fa fa-trash' aria-hidden='true'></span></button></center>
                                </td>";
                                echo "</tr>";
                                
                                ?>
                                
                                            <!-- edit -->
                                            <div class="modal fade" id="edits<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="?content=Data_Guru" method="POST">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <fieldset>
                                                                        <div class="form-group">
                                                                            <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
                                                                            
                                                                            <label>Nama:</label>
                                                                            <input  class="form-control"  name="nama_lengkap" value='<?php echo $data['nama_lengkap']; ?>' type="text">
                                                                            <br>
                                                                            
                                                                            <label>Username:</label>
                                                                            <input  class="form-control"  name="username" value='<?php echo $data['username']; ?>' type="text">
                                                                            <br>

                                                                            <label>Password</label>
                                                                            <input  class="form-control"  name="password" value='<?php echo $data['password']; ?>' type="text">
                                                                            <br>

                                                                            <label>Sebagai:</label>
                                                                            <select name='role_id' class='form-control'>
                                                                            <?php
                                                                                $qryB = "select * from role";
                                                                                $qryB2 = mysqli_query($conn,$qryB);
                                                                                while($dataB = mysqli_fetch_array($qryB2)){
                                                                                    $selected = "";
                                                                                    if($data['role_id'] == $dataB['id_role']) $selected = "selected";
                                                                                    echo "<option $selected value='".$dataB['id_role']."'>".ucwords($dataB['nama_role'])."</option>";
                                                                                } 
                                                                            ?>
                                                                            </select>
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
                                            <div class="modal fade" id="hapus<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="?content=Data_Guru" method="POST">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Hapus</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <fieldset>
                                                                        <div class="form-group">
                                                                                <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
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

    </div>
</div>





<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
});
</script>
<script>
$('#automati').on('change', function(){
    if($(this).val() === '1') {
        // $("#opsimapel").val("0").change().show();
        $('#opsimapel [value="0"]').attr('selected',true).show();
        $("#opsimapel").prop('disabled', true).show();
        $('#opsikelas [value="0"]').attr('selected',true).show();
        // $("#opsikelas").val("0").change().attr('selected',true).show();
        $("#opsikelas").prop('disabled', true);
    }else if($(this).val() === '2') {
        $("#opsimapel").prop('disabled', false);
        $("#opsimapel").val("1").change().show();
        $("#opsikelas").prop('disabled', false);
        $("#opsikelas").val("1").change().show();
    }else{
        $("#opsimapel").prop('disabled', true);
        $("#opsikelas").prop('disabled', true);
    }
    });
</script>