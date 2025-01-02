<?php
//Koneksi Database
$server = "localhost";
$user = "root";
$password = "";
$database = "dbanggota";

//buat koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));


//fungsi tombol simpan ketika diklik
if(isset($_POST['bsimpan'])){

    //pengujian data apakah edit atau simpan baru
    if (isset($_GET['hal'])  == "edit") {
        //data akan diedit
        $edit = mysqli_query($koneksi, "UPDATE tanggota SET
                                            nama = '$_POST[tnama]',
                                            tempat_lahir = '$_POST[ttempat_lahir]',
                                            tanggal_lahir = '$_POST[ttanggal_lahir]',
                                            pengkaderan = '$_POST[tpengkaderan]',
                                            jabatan = '$_POST[tjabatan]'
                                        WHERE id_anggota = '$_GET[id]'
                                        ");

        //pengkondisian edit data
        if($edit){
            echo "<script>
                    alert('Ubah Data Sukses !');
                    document.location='index.php';
                </script>";
        }else{
            echo "<script>
                    alert('Ubah Data Gagal !');
                    document.location='index.php';
                </script>";
        }

    }else{
    //simpan data baru
    //penyimpanan data baru
    $simpan = mysqli_query($koneksi, " INSERT INTO tanggota (nama, tempat_lahir, tanggal_lahir, pengkaderan, jabatan)
                                       VALUE ( '$_POST[tnama]',
                                               '$_POST[ttempat_lahir]',
                                               '$_POST[ttanggal_lahir]',
                                               '$_POST[tpengkaderan]',
                                               '$_POST[tjabatan]' )
                                    ");
    //pengkondisian simpan data baru
    if($simpan){
        echo "<script>
                alert('Simpan Data Sukses !');
                document.location='index.php';
            </script>";
    }else{
        echo "<script>
                alert('Simpan Data Gagal !');
                document.location='index.php';
            </script>";
    }
    }

    
}

//deklarasi variabel data yang di edit
$vnama = "";
$vtempat_lahir = "";
$vtanggal_lahir = "";
$vpengkaderan = "";
$vjabatan = "";

//fungsi edit dan hapus
if(isset($_GET['hal'])) {

    //edit data
    if($_GET['hal'] == "edit"){
        $tampil = mysqli_query($koneksi, "SELECT * FROM tanggota WHERE id_anggota = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data) {
            $vnama = $data['nama'];
            $vtempat_lahir = $data['tempat_lahir'];
            $vtanggal_lahir = $data['tanggal_lahir'];
            $vpengkaderan = $data['pengkaderan'];
            $vjabatan = $data['jabatan'];
        }
    }else if($_GET['hal'] == "hapus"){
        $hapus = mysqli_query($koneksi, "DELETE FROM tanggota WHERE id_anggota = '$_GET[id]' ");
        //hapus data
        if($hapus){
            echo "<script>
                    alert('Hapus Data Sukses !');
                    document.location='index.php';
                </script>";
        }else{
            echo "<script>
                    alert('Hapus Data Gagal !');
                    document.location='index.php';
                </script>";
        }
    }
}








?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ansor Mrican</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
        <!-- container -->
        <div class="container">
            <h3 class="text-center">Daftar Anggota</h3>
            <h3 class="text-center">GP Ansor Mrican</h3>

            <!-- awal row-->
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- card input -->
                    <div class="card">
                        <div class="card-header bg-success text-light">
                            Form Input Data Anggota Ansor Mrican
                        </div>
                        <div class="card-body">
                            <!-- form -->
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="tnama" value="<?=$vnama?>" class="form-control" placeholder="Masukkan Nama Lengkap">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" name="ttempat_lahir" value="<?=$vtempat_lahir?>" class="form-control" placeholder="Masukkan Tempat Lahir">
                                </div>

                                <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="ttanggal_lahir" value="<?=$vtanggal_lahir?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                    <label class="form-label">Pengkaderan</label>
                                    <input type="text" name="tpengkaderan" value="<?=$vpengkaderan?>" class="form-control" placeholder="Masukkan Pengkaderan Yang Pernah Di ikuti">
                                    </div>

                                    <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="tjabatan" value="<?=$vjabatan?>" class="form-control" placeholder="Masukkan Jabatan">
                                    </div>

                                    <div class="text-center">
                                        <hr>
                                        <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
                                        <button class="btn btn-danger" name="bkosongkan" type="reset">Kosongkan</button>
                                        <hr>
                                </div>

                            </form>


                        </div>
                        
                        <div class="card-footer bg-success">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- akhir row -->

            <!-- card output -->
            <div class="card mt-5">
                        <div class="card-header bg-success text-light">
                            Data Anggota Ansor Mrican
                        </div>
                        <div class="card-body">
                            <div class="col-md-6 mx-auto">
                                <form method="POST">
                                    <div class="input-group mb-3">
                                        <input type="text" name="tcari" value="<?=@$_POST['tcari']?>" class="form-control" placeholder="Masukkan kata kunci!">
                                        <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                                        <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                                    </div>
                                </form>
                            </div>

                            <table class="table table-striped table-hover table-bordered">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Pengkaderan</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>

                                <?php
                                //deklarasi menampilkan data
                                $no = 1;

                                //fungsi tombol cari
                                if(isset($_POST['bcari'])){
                                    $keyword = $_POST['tcari'];
                                    $q = "SELECT * FROM tanggota WHERE nama like '%$keyword%' or jabatan like '%$keyword%' order by id_anggota desc";
                                }else {
                                    $q = "SELECT * FROM tanggota order by id_anggota desc";
                                }

                                $tampil = mysqli_query($koneksi, $q);
                                while($data = mysqli_fetch_array($tampil)) {
                                ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['tempat_lahir'] ?>, <?= $data['tanggal_lahir'] ?></td>
                                        <td><?= $data['pengkaderan'] ?></td>
                                        <td><?= $data['jabatan'] ?></td>
                                        <td>
                                            <a href="index.php?hal=edit&id=<?=$data['id_anggota'] ?>" class="btn btn-warning">Ubah</a>
                                            <a href="index.php?hal=hapus&id=<?=$data['id_anggota'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Akan Mengapus Data Ini?')">Hapus</a>
                                        </td>
                                    </tr>

                                <?php } ?>


                            </table>



                        </div>
                        <div class="card-footer bg-success">
                            
                        </div>
                    </div>


        </div>
        <!-- akhir container -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>