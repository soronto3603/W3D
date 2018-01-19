<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>W3D</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <div class=modal style="background-color:rgba(0,0,0,0.3)" id=modal_loading>
    <div class=modal_margin style="margin-top:40%">
      <center>
        <img src="Wedges.gif">
        <div id=loading_text style="background-color:white;border-radius:10px;width:200px;height:100px;line-height:100px;color:black;"></div>
      </center>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">OpenDroneMap Web Interface</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="charts.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="tables.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tables</span>
          </a>
        </li>
      </ul>

    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"  >OpenDroneMap Project</li>
      </ol>

      <div class="row">
        <div class="col-lg-8">
          <div class="mb-0 mt-4"><input id=newname type=text><div class=new_project_btn onclick="create_project()">New Project</div></div>
          <!-- Card Columns Example Social Feed-->
          <div class="mb-0 mt-4">Projects</div>
          <hr class="mt-2">
          <div class="card-columns">
            <!-- Example Social Card-->

            <?php

            $path='/var/www/html/w3d/odm_project';

            $files=scandir($path);
            foreach($files as $v){
              if($v=="." || $v=="..")continue;
              $project_count++;
              $pj_files=scandir($path."/".$v."/images");
              $pj_file=$pj_files[3];

              $date=date("F d Y H:i:s",filemtime($path."/".$v."/images/".$pj_file));
              $file_count=sizeof($pj_files);
              if($file_count<=1)$file_count=0;
              $isfinish=0;
              $find_textur=scandir($path."/".$v);
              $count=0;
              foreach($find_textur as $vv){
                if($count>=7){
                  $isfinish=1;
                }
                $count++;
              }
              project_card($v,$date,"./odm_project/".$v."/images/".$pj_file,$file_count,$isfinish);
            }

              function project_card($name,$date,$img,$count,$isfinish){

                echo '<div class="card mb-3">
                  <a href="#">
                    <img class="card-img-top img-fluid w-100" src="'.$img.'" alt="">
                  </a>
                  <div class="card-body">
                    <h6 class="card-title mb-1"><a href="#">'.$name.'</a></h6>
                    <p class="card-text small">'.$date.'
                      <a href="#">#</a>
                    </p>
                    <div>
                      <form action="upload.php" method="post" multipart="" enctype="multipart/form-data">
                          <input type="file" name="img[]" multiple>
                          <input type="submit">
                          <input type="hidden" name="name" value="'.$name.'">
                      </form>
                    </div>
                    <div style="background-color: #007bff;border-radius: 10px;
                    width: 110px;text-align: center;height: 40px;
                    line-height: 40px;color: white;position: relative;top: 10px;
                    " onclick="run_project(\''.$name.'\')">Run</div>';
                    if($isfinish==1){
                      echo '<div style="background-color: #007bff;border-radius: 10px;
                      width: 110px;text-align: center;height: 40px;
                      line-height: 40px;color: white;position: relative;top: -30px;left:130px;
                      " onclick="show_file(\''.$name.'\')">Result</div>';
                    }
                  echo '</div>

                  <div class="card-footer small text-muted">Image Count : '.$count.'</div>
                </div>';
              }
            ?>
          </div>
          <!-- /Card Columns-->
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © OpenDroneMap made by soronto at 2017-11-28</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    <script>
      function create_project(){
        var name=document.getElementById('newname').value;
        $.get("project_create.php",{name:name}).done((r)=>{
          window.location.reload();
        });
      }
      function run_project(name){
        document.getElementById('loading_text').innerHTML=name+" is running";
        document.getElementById('modal_loading').style.display="block";
        $.get("php_odm_client.php",{name:name}).done((r)=>{
        });
        setTimeout(()=>{document.getElementById('modal_loading').style.display="none";},10000);
      }
      function show_file(name){
        window.location.href="http://202.31.147.197:7680/w3d/result.php?name="+name+"";
      }
    </script>
  </div>
</body>

</html>
