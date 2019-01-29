            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              </div>
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
                  //campo de texto
                  if(isset($camposTextareaHTML)){
                    foreach ($camposTextareaHTML as $key => $campos) {
                      echo form_label($key);
                      echo form_textarea($campos);  
                    }
                  }
                  //campos select
                  if(isset($camposSelect)){

                    foreach ($camposSelect as $chave => $valor) {
                      $fieldSelect="";
                      foreach ($valor as $key => $campos) {
                          //echo form_label($key);
                          //echo form_dropdown($key, $options, '');
                              if(!is_array($campos)){
                                $fieldSelect=$campos; 
                              }else{
                                echo form_label($key);
                                echo form_dropdown($fieldSelect, $campos, '', 'class="form-control"');
                              }
                        }

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