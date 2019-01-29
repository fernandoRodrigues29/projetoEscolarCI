    <div class="box-header">
      <div class="row mt-1">
        <div class="col-lg-3 col-sm-6">
          <a href="<?php echo base_url('c_aluno/cadastrar');?>" class="btn-success btn-lg">Cadastrar</a>    
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
<script type="text/javascript">
  $(document).ready(function() {
   /**/
    $('#tabelaJSON').DataTable({
       "ajax": "<?php echo base_url('c_aluno/listar_jsonEncode2');?>",
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
            var campoAcoes = "<a class='btn btn-info' href='/c_aluno/editar/"+data.id+"'>Editar</a>";
                campoAcoes += "|<a class='btn btn-danger' href='/c_aluno/deletar/"+data.id+"'>Ecluir</a>";
            //console.log(data);    
            return campoAcoes; 
          }
        }
       ]
    });
    /**/
});
</script>