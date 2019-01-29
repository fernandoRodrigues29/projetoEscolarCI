            <div class="box-header with-border">
              <h3 class="box-title">Editar</h3>
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
             ?>
            
             <?php echo form_open_multipart($urlContoroller,array('class'=>'login-form'),$hidden); ?>
            <div class="box-body">
                <?php

                  foreach ($camposHTML as $key => $value) {
                    echo '<div class="form-group">';
                      echo form_label($key);
                      echo form_input($value);
                    echo '</div>';
                  }
                  //campo d etexto
                  if(isset($camposTextareaHTML)){
                    foreach ($camposTextareaHTML as $key => $campos) {
                      echo form_label($key);
                      echo form_textarea($campos);  
                    }
                  }
                  if(isset($camposSelect)){

                    foreach ($camposSelect as $chave => $valor) {
                      $fieldSelect="";
                      foreach ($valor as $key => $campos) {
                          //echo form_label($key);
                          //echo form_dropdown($key, $options, '');
                              if(!is_array($campos)){
                                $fieldSelect=$valor[0]; 
                                $rowSelect=$valor[1]; 
                              }else{
                                echo form_label($key);
                                echo form_dropdown($fieldSelect, $campos, $rowSelect, 'class="form-control"');
                              }
                        }

                    }
                  }                                   
               ?>
                <?php if(isset($avatar)):?>
                <div class='form-group'>
                  <div class='row'>
                    <div class='col-4'>
                      <img src='<?php echo $avatar;?>' width='160' height='160'>
                    </div>
                    <div class="col-2">
                      <label>Imagem Atual</label>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
            </div><!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Atualizar</button>
            </div><!-- /.box-footer-->
            <?php 
              echo form_close();
            ?>