<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php
        $cs        = Yii::app()->clientScript;
        $cs->packages = array(
         'jquery.ui'=>array(
          'js'=>array('jui/js/jquery-ui.min.js'),
            'css'=>array('jui/css/base/jquery-ui.css'),
            'depends'=>array('jquery'),
          ),
        );
        $themePath = Yii::app()->theme->baseUrl;
        $assetsPath = Yii::app()->theme->baseUrl.'/assets/';
        $imagesPath = Yii::app()->theme->baseUrl.'/assets/images/';
        //Check user is guest or not
        $guestUser = Yii::app()->session['login_id'];
    ?>

  <!-- Custom fonts for this template-->
  <link href="<?php echo $assetsPath;?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo $assetsPath;?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo $assetsPath;?>css/sb-admin.css" rel="stylesheet">

<!--   <script src="<?php echo $assetsPath;?>vendor/jquery/jquery.min.js"></script>
 -->
 <?php
    /* CSS 
    ========================= */
    //Developer Custom CSS
    $cs->registerCssFile($themePath . '/assets/css/developer.css');
    //Font awesome Css
    $cs->registerCssFile($themePath . '/assets/fontawesome/css/all.css');

    /* JS 
    ========================= */
    // Jquery JS     
    $cs->registerCoreScript('jquery', CClientScript::POS_END);
    //$cs->registerScriptFile($themePath . '/assets/js/jquery-slim.min.js', CClientScript::POS_END);

    $cs->registerCoreScript('jquery.ui', CClientScript::POS_END);

    // Fontawesome js
    $cs->registerScriptFile($themePath . '/assets/fontawesome/js/all.js', CClientScript::POS_END);
    
    
  ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $assetsPath;?>vendor/daterangepicker/daterangepicker.css"/ >
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>
 -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').select2();
});
</script>  
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="javascript:void(0)"><?php echo Yii::app()->name;?></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="javascript::void(0)">
      <i class="fas fa-bars"></i>
    </button>
 
  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo Yii::app()->createUrl('dashboard');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo Yii::app()->createUrl('inventory/create');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Add Inventory</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo Yii::app()->createUrl('inventory');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inventory List</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo Yii::app()->createUrl('customer/create');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Add Customer</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo Yii::app()->createUrl('customer');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Customer List</span>
        </a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">
      <?php
        if(Yii::app()->user->hasFlash('errorMessage'))
        {
        ?>
          <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <?php echo Yii::app()->user->getFlash('errorMessage');?>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
          </div>        
      <?php      
        }
        ?>
      <?php
        if(Yii::app()->user->hasFlash('successMessage'))
        {
        ?>
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <?php echo Yii::app()->user->getFlash('successMessage');?>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
          </div>
      <?php      
        }
        ?>
      	<?php
      		echo $content;
      	?>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © <?php echo Yii::app()->name; ?> <?php echo date("Y")?></span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  <script src="<?php echo $assetsPath;?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo $assetsPath;?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <!-- <script src="<?php echo $assetsPath;?>vendor/chart.js/Chart.min.js"></script> -->
  <script src="<?php echo $assetsPath;?>vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo $assetsPath;?>vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo $assetsPath;?>js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="<?php echo $assetsPath;?>js/demo/datatables-demo.js"></script>
  <!-- <script src="<?php echo $assetsPath;?>js/demo/chart-area-demo.js"></script> -->

    <!-- Date time picker js-->
    <script src="<?php echo $assetsPath;?>vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo $assetsPath;?>vendor/daterangepicker/daterangepicker.min.js"></script>

</body>

</html>
