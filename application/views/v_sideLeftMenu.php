 <?php 
  $registro = $this->session->userdata('usuarios');
  $nome_usuario = $registro['nome'];
  $email_usuario = $registro['email'];
  $img_usuario = $registro['img'];               
?>
 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url('public/img/users/'.$img_usuario)?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $nome_usuario;?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $email_usuario;?></a>
            </div>
          </div>
          <!-- search form --
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">NAVEGAÇÂO PRINCIPAL></li>
            <li>
              <a href="/index.php/c_usuario/gerenciar">
                <i class="fa fa-th"></i> <span>Usuarios</span> <small class="label pull-right bg-blue">#Cad.Usuario</small>
              </a>
            </li>            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Aluno</span>
                <span class="label pull-right bg-blue">#Principal</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/index.php/c_aluno/gerenciar"><i class="fa fa-circle-o"></i>Gerênciar</a></li>
                <li><a href="/index.php/c_aluno/inserir_disiciplina"><i class="fa fa-circle-o"></i>Inserir Disciplina </a></li>
              </ul>
            </li>            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Professor</span>
                <span class="label pull-right bg-blue">#Cad.Prof</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/index.php/c_professor/gerenciar"><i class="fa fa-circle-o"></i>Gerênciar</a></li>
                <li><a href="/index.php/c_professor/inserir_turma"><i class="fa fa-circle-o"></i>Inserir Turmas </a></li>
              </ul>
            </li>             
            <li>
              <a href="/index.php/c_disciplina/gerenciar">
                <i class="fa fa-th"></i> <span>Disciplina</span> <small class="label pull-right bg-blue">#Cad.Disc</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Turma</span>
                <span class="label pull-right bg-blue">#Gest.turma</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/index.php/c_turma/gerenciar"><i class="fa fa-circle-o"></i>Gerênciar</a></li>
                <li><a href="/index.php/c_turma/inserir_aluno"><i class="fa fa-circle-o"></i>Inserir Aluno </a></li>
                <li><a href="/index.php/c_turma/inserir_prof"><i class="fa fa-circle-o"></i>Inserir Professor </a></li>
              </ul>
            </li>                                                

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
