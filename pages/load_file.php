<?php
if($_GET) {
	switch ($_GET['content']){				
		# ""
		case '' :				
			if(!file_exists ("home.php")) die ("Empty Main Page!"); 
			include "home.php";	break;
		# Home
		case 'Home' :				
			if(!file_exists ("home.php")) die ("Empty Main Page!"); 
			include "home.php";	break;
		# Data_Akun
		case 'Data_Akun' :				
			if(!file_exists ("akun.php")) die ("Empty Main Page!"); 
			include "akun.php"; break;
		# Data_Guru
		case 'Data_Guru' :				
			if(!file_exists ("data_guru.php")) die ("Empty Main Page!"); 
			include "data_guru.php"; break;
		# Data_Mapel
		case 'Data_Mapel' :				
			if(!file_exists ("mapel.php")) die ("Empty Main Page!"); 
			include "mapel.php"; break;
		# Data_Kelas
		case 'Data_Kelas' :				
			if(!file_exists ("kelas.php")) die ("Empty Main Page!"); 
			include "kelas.php"; break;
		# Data_Siswa
		case 'Data_Siswa' :				
			if(!file_exists ("siswa.php")) die ("Empty Main Page!"); 
			include "siswa.php"; break;
		# Data_KD
		case 'Data_KD' :				
			if(!file_exists ("data_kd.php")) die ("Empty Main Page!"); 
			include "data_kd.php"; break;
		# Data_Nilai
		case 'Data_Nilai' :				
			if(!file_exists ("nilai.php")) die ("Empty Main Page!"); 
			include "nilai.php"; break;
		# Data_Bandwidth
		case 'Data_Bandwidth' :				
			if(!file_exists ("data_bandwidth.php")) die ("Sorry Empty Page!"); 
			include "data_bandwidth.php"; break;	
		# Proses_Perhitungan
		case 'Proses_Perhitungan' :				
			if(!file_exists ("proses_perhitungan.php")) die ("Sorry Empty Page!"); 
			include "proses_perhitungan.php"; break;	
		# Laporan
		case 'Laporan' :				
			if(!file_exists ("laporan.php")) die ("Sorry Empty Page!"); 
			include "laporan.php"; break;	
		# Setting
		case 'Setting' :				
			if(!file_exists ("setting.php")) die ("Sorry Empty Page!"); 
			include "setting.php"; break;	

		# Laporan Guru
		case 'Grafik' :				
			if(!file_exists ("grafik.php")) die ("Sorry Empty Page!"); 
			include "laporan_guru.php"; break;	
			
	}
}
?>