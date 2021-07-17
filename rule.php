<?php

$data = array("rendah", "sedang", "tinggi");
print_r($data);
echo "<br/>";
$n=0;
for($i=0; $i<3; $i++){
	for($j=0; $j<3; $j++){
		for($k=0; $k<3; $k++){
			for($l=0; $l<3; $l++){
				for($m=0; $m<3; $m++){
					if($m == 2) $hasil = "diterima";
					else $hasil = "tidak diterima";
					echo "('".$data[$i]."', '".$data[$j]."', '".$data[$k]."', '".$data[$l]."', '".$data[$m]."','".$hasil."'),";
					echo "<br/>";
					$n++;
				}
			}
		}
	}
}

?>