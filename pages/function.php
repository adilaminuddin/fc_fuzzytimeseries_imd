<?php
	include "../koneksi.php";
?>

<?php
	function transpose($temp_interval){
		$x = 0;
		for($i=count($temp_interval); $i>0; $i--){
			$data[$x] = $temp_interval[$i-1];
			$x++;
		}
		return $data;
	}
	
	function cek_interval($data, $interval){
		$indeks = 0;
		for($i=0; $i<count($interval); $i++){
			if(($data >= $interval[$i][0]) && ($data < $interval[$i][1]))
				$indeks = ($i+1);
		}
		return $indeks;
	}
	
	function cek_nilai($flrg, $data1, $data2){
		$indeks = 0;
		
		for($i=0; $i<count($flrg); $i++){
			for($j=0; ($j<count($flrg[$i])-1); $j++){
				echo $flrg[$i][$j]."==".$flrg[$data1][$data2];
				echo "<br>";
			}
			echo "<br>";
		}
		
		return $indeks;
	}
	
	function cek_bulan($temp_bulan){
		include "../koneksi.php";
		$qry = "select * from bulan where nama = '".$temp_bulan."'";
		$qry1 = mysqli_query($conn,$qry);
		$data = mysqli_fetch_array($qry1);
		if($data['id'] != 12)
			$bulan = ($data['id']+1);
		else
			$bulan = 1;
		return $bulan;
	}
	
	function cek_tahun($bulan, $temp_tahun){
		if($bulan == 1) $temp_tahun = $temp_tahun+1;
		return $temp_tahun;
	}

?>
