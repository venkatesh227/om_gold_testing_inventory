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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  
    <!-- Page level plugin CSS-->
    <link href="<?php echo $assetsPath;?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo $assetsPath;?>css/sb-admin-2.min.css" rel="stylesheet">

 <?php
    /* CSS 
    ========================= */
    //Developer Custom CSS
    $cs->registerCssFile($themePath . '/assets/css/developer.css');
    //Font awesome Css
    //$cs->registerCssFile($themePath . '/assets/fontawesome/css/all.css');

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

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
              <div class="sidebar-brand-text mx-3">
                <?php echo Yii::app()->name;?>
              </div>  
            </a>
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo Yii::app()->createUrl('dashboard')?>">
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
              <a class="nav-link" href="<?php echo Yii::app()->createUrl('inventory/ledger');?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Inventory Ledger</span>
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
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                     <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
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
                <!-- /.container-fluid -->
              </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?php echo Yii::app()->name;?> <?php echo date('Y');?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

     <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo $assetsPath;?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo $assetsPath;?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo $assetsPath;?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo $assetsPath;?>vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
<!--     <script src="<?php echo $assetsPath;?>js/demo/chart-area-demo.js"></script>
    <script src="<?php echo $assetsPath;?>js/demo/chart-pie-demo.js"></script> -->

    <!-- Date time picker js-->
    <script src="<?php echo $assetsPath;?>vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo $assetsPath;?>vendor/daterangepicker/daterangepicker.min.js"></script>

</body>


</html>
