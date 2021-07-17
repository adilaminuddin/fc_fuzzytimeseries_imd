<?php 

	include "../koneksi.php";
	
	if(isset($_SESSION['username']['role_id'])){
	$stmt1 = "";
	if(isset($_POST['edits']) && isset($_POST['id'])){
		if($_POST['nama'] != "" && $_POST['username'] != "" && $_POST['password'] != "" && $_POST['confirm_password'] != ""){
			if($_POST['password'] == $_POST['confirm_password']){
				$qry = "UPDATE user SET `nama` = '".$_POST['nama']."', `username` = '".$_POST['username']."', `password` = '".$_POST['password']."' WHERE id = ".$_POST['id'];
				$qry2 = mysqli_query($conn,$qry);
				if($qry2) $stmt1 = "<div class='alert alert-success'>Edit Data Berhasil<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
					else $stmt1 = "<div class='alert alert-danger'>Edit Data Gagal<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
			}
			else{
				$stmt1 = "<div class='alert alert-danger'>Confirm Password tidak sama dengan Password<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
			}	
		}
		else{
			$stmt1 = "<div class='alert alert-danger'>Silahkan isi semua form<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button></div>";
		}
	}

?>

<div class="row">
     <div class="col-lg-12">
          <h1 class="page-header">.:: Setting ::.</h1>
     </div>
	 <div class="col-lg-7">
					<?php 
						
						$qry = "SELECT * from user WHERE username = '".$_SESSION['username']['role_id']."'";
						$data = mysqli_fetch_array(mysqli_query($conn,$qry));
					
					?>
					
					<?php echo $stmt1; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p ><span style='font-size:18px'>User</span>
							<button class='btn btn-primary' style='float:right' data-toggle='modal' data-target='#edits<?php echo $data['id']; ?>'>Edit</button>
							</p>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
									
										<tr class="danger">
                                            <td align="right" class="col-lg-2"><b>Nama :</b></td>
                                            <td align="left" class="col-lg-5"><?php echo $data['role_id']; ?></td>
                                        </tr>
										<tr class="success">
                                            <td align="right" class="col-lg-2"><b>Username :</b></td>
                                            <td align="left" class="col-lg-5"><?php echo $data['username']; ?></td>
                                        </tr>
										<tr class="info">
                                            <td align="right" class="col-lg-2"><b>Password :</b></td>
                                            <td align="left" class="col-lg-5" type='password'><?php echo $data['password']; ?></td>
                                        </tr>
										
										<!-- .modal-dialog -->
										<div class="modal fade" id="edits<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<form action="?content=Setting" method="POST">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title" id="myModalLabel">Edit</h4>
															</div>
															<div class="modal-body">
																<fieldset>
																	<div class="form-group">
																		<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
																		
																		<?php
																			$qry = "select * from data_pemain where id = ".$data['id'];
																			$qryP = mysqli_query($conn,$qry);
																		?>
																		
																		<label>Nama:</label>
																		<input class="form-control"  placeholder="Nama"  name="nama" type="text" value="<?php echo $data['nama'];?>">
																		<br>
																		
																		<label>Username:</label>
																		<input class="form-control"  placeholder="Username"  name="username" type="text" value="<?php echo $data['username'];?>">
																		<br>
																		
																		<label>Password Baru:</label>
																		<input class="form-control"  placeholder="Password"  name="password" type="password" value="<?php echo $data['password'];?>">
																		<br>
																		
																		<label>Confirm Password:</label>
																		<input class="form-control"  placeholder="Confirm Password"  name="confirm_password" type="password" value="<?php echo $data['password'];?>">
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
										<!-- /.modal-dialog -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
</div>
<!-- /.row -->

<?php
	function type_pass($password){
		
	}

}
else{
	
	header("location:login.php");
}

?>
   