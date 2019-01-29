<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Login Form Template</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?php echo base_url('public/font-awesome/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/form-elements.css')?>">
        <link rel="stylesheet" href="<?php echo base_url('public/css/style.css')?>">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url('public/ico/favicon.png')?>">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('public/ico/apple-touch-icon-144-precomposed.png')?>">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('public/ico/apple-touch-icon-114-precomposed.png')?>">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('public/ico/apple-touch-icon-72-precomposed.png')?>">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('public/ico/apple-touch-icon-57-precomposed.png')?>">
        <!---->
 </head>
    <body>
        <!-- Top content -->
        <div class="container">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar</h3>
              
            </div>
            <?php echo validation_errors(); ?>
             <?php 
                if($mensagem_retorno):
                  echo '<div class="alert '.$mensagem_retorno['tipo'].' alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        '.$mensagem_retorno['msg'].'  
                        </div>';
                endif;
                //------------------------------------------------
                if($this->session->flashdata('mensagem')):
                  $arr=$this->session->flashdata('mensagem');
                    $mensagem_retorno = $arr['mensagem_retorno'];
                      printf('<div class="alert %s alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            %s</div>',$mensagem_retorno['tipo'],$mensagem_retorno['msg']);  
                endif;
             ?>
                        
             <?php echo form_open_multipart($urlContoroller,array('class'=>'login-form')); ?>
            <div class="box-body">
                <?php

                  if(isset($camposHTML)){
                  foreach ($camposHTML as $key => $value) {
                    echo '<div class="form-group">';
                      echo form_label($key);
                      echo form_input($value);
                    echo '</div>';
                  }
                }
               ?>
            </div><!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div><!-- /.box-footer-->
            <?php 
              echo form_close();
            ?>
      </div>
  </body>
</html>        