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
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Acesso Restrito</h3>
                            		<p>Entre com seu Usuario e senha:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-user"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
			                  	<?php echo validation_errors(); ?>
                                <?php 
                                    if($msgErro):
                                        echo "<p class='alert alert-warning'> ".$msgErro." </p>";
                                    endif;
                                ?>
                                <?php echo form_open('index.php/c_login/autenticacao',array('class'=>'login-form')); ?>
                                    <div class="form-group">
			                    		<label class="sr-only" for="form-username">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                        Usuario
                                        </label>
			                        	<input type="text" name="usuario" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Senha</label>
			                        	<input type="password" name="senha" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
			                        <button type="submit" class="btn">Acessar!</button>
                                    <a href="/index.php/login_c/cadastrar">Criar Conta</a>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Javascript -->
        <script src="<?php echo base_url('public/js/jquery-1.11.1.min.js')?>"></script>
        <script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('public/js/jquery.backstretch.min.js')?>"></script>
        <script src="<?php echo base_url('public/js/scripts.js')?>"></script>
    </body>

</html>