<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-90">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Sistem Peramalan</div>
</a>
<!-- Divider -->
<hr class="sidebar-divider my-0">
<?php
    if($_SESSION['username']['role_id'] == '1'){
    ?>
    <?php
        $module = @$_GET['content'];
        if ($module=="Home"){
            echo '<li class="nav-item active"><a class="nav-link" href="?content=Home"><i class="fas fa-fw fa-tachometer-alt"></i><span><span>Dashboard</span></a></li>';
        }else{
            echo '<li class="nav-item"><a class="nav-link" href="?content=Home"><i class="fas fa-fw fa-tachometer-alt"></i><span><span>Dashboard</span></a></li>';
        }
        ?>
        <?php
            if (@$_GET['content']){
                echo "<a class=\"active\" href=\"javascript:;\">";
            }else{
                echo "<a href=\"javascript:;\">";
            }
        ?>

        <hr class="sidebar-divider">

        <!-- <li class="nav-item"> -->
        <?php
         $module = @$_GET['content'];
          if ($module=="Data_Akun"){
            echo '<li class="nav-item active">';
          }elseif ($module=="Data_Guru") {
            echo '<li class="nav-item active">'; 
          }elseif ($module=="Data_Siswa") {
            echo '<li class="nav-item active">';
          }else{
            echo '<li class="nav-item">';
          }
        ?>
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users"></i>
                <span>Pengguna</span>
            </a>
            <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar"> -->
            <?php
                $module = @$_GET['content'];
                if ($module=="Data_Akun"){
                    echo '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">';
                }elseif ($module=="Data_Guru") {
                    echo '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">'; 
                }elseif ($module=="Data_Siswa") {
                    echo '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">';
                }else{
                    echo '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">';
                }
                ?>
                <div class="bg-white py-3 collapse-inner rounded">
                <?php
                    $module = @$_GET['content'];
                    if ($module=="Data_Akun"){
                        echo '<a class="collapse-item active" href="?content=Data_Akun">User</a>';
                    }else{
                        echo '<a class="collapse-item" href="?content=Data_Akun">User</a>';
                    }
                    ?>
                    <!-- <a class="collapse-item" href="?content=Data_Akun">User</a> -->
                    <?php
                    $module = @$_GET['content'];
                    if ($module=="Data_Guru"){
                        echo '<a class="collapse-item active" href="?content=Data_Guru">Guru</a>';
                    }else{
                        echo '<a class="collapse-item" href="?content=Data_Guru">Guru</a>';
                    }
                    ?>
                    <?php
                    $module = @$_GET['content'];
                    if ($module=="Data_Siswa"){
                        echo '<a class="collapse-item active" href="?content=Data_Siswa">Siswa</a>';
                    }else{
                        echo '<a class="collapse-item" href="?content=Data_Siswa">Siswa</a>';
                    }
                    ?>
                    <!-- <a class="collapse-item" href="?content=Data_Guru">Guru</a>
                    <a class="collapse-item" href="?content=Data_Siswa">Siswa</a> -->
                </div>
            </div>
        </li>
        
                    <?php
                    $module = @$_GET['content'];
                    if ($module=="Data_Mapel"){
                        echo '<li class="nav-item active"><a class="nav-link" href="?content=Data_Mapel"><i class="fas fa-fw fa-book-open"></i><span>Mata Pelajaran</span></a></li>';
                    }else{
                        echo '<li class="nav-item"><a class="nav-link" href="?content=Data_Mapel"><i class="fas fa-fw fa-book-open"></i><span>Mata Pelajaran</span></a></li>';
                    }
                    ?>
        
        <li class="nav-item">
            <a class="nav-link" href="?content=Data_Kelas">
                <i class="fas fa-fw fa-table"></i>
                <span>Kelas</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?content=Data_KD">
                <i class="fas fa-fw fa-book-reader"></i>
                <span>Kompetensi Dasar</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?content=Data_Nilai">
                <i class="fas fa-fw fa-file-signature"></i>
                <span>Nilai Siswa</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?content=Data_Bandwidth">
                <i class="fas fa-fw fa-copy"></i>
                <span>Rekapan Nilai Siswa</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTri"
                aria-expanded="true" aria-controls="collapseTri">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Peramalan</span>
            </a>
            <div id="collapseTri" class="collapse" aria-labelledby="headingTri" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="?content=Proses_Perhitungan">Proses Perhitungan</a>
                    <a class="collapse-item" href="?content=Laporan">Laporan</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    <?php 
        } 
        else if($_SESSION['username']['role_id'] == '2'){
    ?>
        


    <?php
        }
    ?>