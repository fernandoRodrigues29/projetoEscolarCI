<!DOCTYPE html>
<html>
<?php $teste = "conteudo";?>
<?php $this->load->view('v_headerLinks')?>
  <body class="skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      <?php $this->load->view('v_header')?>      
      <!-- =============================================== -->
      <!-- Left side column. contains the sidebar -->
      <?php $this->load->view('v_sideLeftMenu'); ?>
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           
            <small>.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> .</a></li>
            <li><a href="#">.</a></li>
            <li class="active">.</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
              <?php 
                if(isset($conteudo)){
                  echo $conteudo;
                }
              ?>
          </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php $this->load->view('v_footer'); ?>
    </div><!-- ./wrapper -->
    <?php $this->load->view('v_scriptsFooter');?>
  </body>
</html>