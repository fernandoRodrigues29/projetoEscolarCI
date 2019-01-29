    <?php
      $uri_gerenciar=$_SERVER['REQUEST_URI'];
        $uri_explode_gerenciar = explode("/",$uri_gerenciar);
          $controleUrl =$uri_explode_gerenciar[2];
         
    ?>

    <div class="box-header">

      <div class="row mt-1">
        <div class="col-lg-3 col-sm-6">
          <a href="<?php echo base_url($urlCadastro);?>" class="btn-success btn-lg">Cadastrar</a>    
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-3">
          <?php 
                if($this->session->flashdata('mensagem')):
                  $arr=$this->session->flashdata('mensagem');
                    $mensagem_retorno = $arr['mensagem_retorno'];
                      printf('<div class="alert %s alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            %s</div>',$mensagem_retorno['tipo'],$mensagem_retorno['msg']);  
                endif;
          ?>
        </div>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
       <table class="table table-hover" id="tabelaJSON">
       </table>
    </div><!-- /.box-body -->
<style type="text/css">
  #tabelaJSON tbody td:nth-child(3){
    text-align: right;
  }
</style>    
<script type="text/javascript">
  $(document).ready(function() {
   /*/c_aluno/gerenciar*/
   /*<?php echo ''.$controleUrl; ?>*/
    $('#tabelaJSON').DataTable({
      <?php if($controleUrl=='c_usuario'):?>
       "ajax": "<?php echo base_url('c_usuario/listar_jsonEncode');?>",
       "columns": [
        {title:'ID', data: "id" },
        {title:'NOME',data: "nome" },
        {title:'E-MAIL',data: "email" },
        {
          title:'IMAGEM',
          //data: "img"
          data: null,
          render: function(data, type, row){
            var imagem = "<?php echo base_url('/public/img/users/'); ?>"+data.img
            var campoImg = "<img src='"+imagem+"' style='width: 65px;height: 65px;'>";
            return campoImg;
          } 
        },
        {
          title:'Ações',
          data: null,
          render: function ( data, type, row ) {
            var campoAcoes = "<a class='btn btn-info' href='/c_usuario/editar/"+data.id+"'>Editar</a>";
                campoAcoes += "|<a class='btn btn-danger' href='/c_usuario/deletar/"+data.id+"'>Ecluir</a>";
            //console.log(data);    
            return campoAcoes; 
          }
        }
       ]
       <?php endif; ?>

       <?php if($controleUrl=='c_professor'):?>
           "ajax": "<?php echo base_url('c_professor/listar_jsonEncode');?>",
           "columns": [
            {title:'ID', data: "id" },
            {title:'NOME',data: "nome" },
            {
              title:'Ações',
              data: null,
              render: function ( data, type, row ) {
                var campoAcoes = "<a class='btn btn-info' href='/c_professor/editar/"+data.id+"'>Editar</a>";
                    campoAcoes += "|<a class='btn btn-danger' href='/c_professor/deletar/"+data.id+"'>Ecluir</a>";
                //console.log(data);    
                return campoAcoes; 
              }
            }
           ]
       <?php endif; ?>
       <?php if($controleUrl=='c_aluno'):?>
           "ajax": "<?php echo base_url('c_aluno/listar_jsonEncode');?>",
           "columns": [
            {title:'ID', data: "id" },
            {title:'NOME',data: "nome" },
            {
              title:'Ações',
              data: null,
              render: function ( data, type, row ) {
                var campoAcoes = "<a class='btn btn-info' href='/c_aluno/editar/"+data.id+"'>Editar</a>";
                    campoAcoes += "|<a class='btn btn-danger' href='/c_aluno/deletar/"+data.id+"'>Ecluir</a>";
                //console.log(data);    
                return campoAcoes; 
              }
            }
           ]
       <?php endif; ?>       
       <?php if($controleUrl=='c_disciplina'):?>
           "ajax": "<?php echo base_url('c_disciplina/listar_jsonEncode');?>",
           "columns": [
            {title:'ID', data: "id" },
            {title:'TITULO',data: "titulo" },
            {
              title:'Ações',
              data: null,
              render: function ( data, type, row ) {
                var campoAcoes = "<a class='btn btn-info' href='/c_disciplina/editar/"+data.id+"'>Editar</a>";
                    campoAcoes += "|<a class='btn btn-danger' href='/c_disciplina/deletar/"+data.id+"'>Ecluir</a>";
                //console.log(data);    
                return campoAcoes; 
              }
            }
           ]
       <?php endif; ?>
       <?php if($controleUrl=='c_turma'):?>
           "ajax": "<?php echo base_url('c_turma/listar_jsonEncode');?>",
           "columns": [
            {title:'ID', data: "id" },
            {title:'TURMA',data: "turma" },
            {
              title:'Ações',
              data: null,
              render: function ( data, type, row ) {
                var campoAcoes = "<a class='btn btn-info' href='/c_turma/editar/"+data.id+"'>Editar</a>";
                    campoAcoes += "|<a class='btn btn-danger' href='/c_turma/deletar/"+data.id+"'>Ecluir</a>";
                //console.log(data);    
                return campoAcoes; 
              }
            }
           ]
       <?php endif; ?>              
    });
    /**/
});
</script>