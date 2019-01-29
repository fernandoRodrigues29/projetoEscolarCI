<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
	class C_Disciplina extends CI_Controller {
		function __construct(){
			parent::__construct();
			if($this->session->userdata('logado') != TRUE):
				redirect('index.php/c_login/sair','refresh');
			endif;
			$this->load->helper('form');
			$this->load->model('auxiliar');
		}

		function index() {
			$this->cadastrar();
		}
		//metodo
		function cadastrar() {
			
			$campos = array(
				'titulo'  => array(
					'type'  => 'text',
                    'name'  => 'titulo',
                    'class' => 'form-control'
				)							
			);
			$camposTextarea = array(
				'descrição'  => array(
					'type'  => 'textarea',
                    'name'  => 'descricao',
                    'class' => 'form-control'
				),
				'conteudo'  => array(
					'type'  => 'textarea',
                    'name'  => 'conteudo',
                    'class' => 'form-control'
				)							
			);			
			
			$componentes = array(
				'urlContoroller'=>'c_disciplina/cadastrar',
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos,
				'camposTextareaHTML'=>$camposTextarea
			);

			if($this->input->post()){
				/*verificar modo de validar para textarea*/
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'titulo' , 
		                'label'  =>  'Titulo' , 
		                'rules'  =>  'trim|required' 
		        )		         		         
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');							
					}else{
						
						$dados['id'] = null;
						$dados['titulo'] = $this->input->post('titulo');
						$dados['descricao'] = $this->input->post('descricao');
						$dados['conteudo'] = $this->input->post('conteudo');

						$retorno = $this->auxiliar->inserir('disciplina',$dados);
							if($retorno){
								$componentes['mensagem_retorno'] = array('tipo'=>'alert-info','msg'=>'Professor cadastrado com sucesso');
							}else {
								$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro no Cadastro');
							}
					}

			} 

			$paginasColecao['conteudo'] = $this->load->view('pages/v_cadastro',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);

		}

		function editar($id) {
			//bloqueio para redirecionar quando o id for nullo ou literal
			if(empty($id) || !intval($id)){
				redirect('index.php/c_disciplina/gerenciar');
			}
			//carregar infromaçãoes do usuario 
			$registroDisciplina = $this->auxiliar->selectClausulaLinha('disciplina','titulo,descricao,conteudo',array('id'=>$id));
			$campos = array(
				'nome'  => array(
					'type'  => 'text',
                    'name'  => 'titulo',
                    'class' => 'form-control',
                    'value' => $registroDisciplina->titulo
				)			
			);

			$camposTextarea = array(
				'descrição'  => array(
					'type'  => 'textarea',
                    'name'  => 'descricao',
                    'class' => 'form-control',
                    'value' => $registroDisciplina->descricao
				),
				'conteudo'  => array(
					'type'  => 'textarea',
                    'name'  => 'conteudo',
                    'class' => 'form-control',
                    'value' => $registroDisciplina->conteudo
				)							
			);

			$hidden = array('id' => $id);
			
			$componentes = array(
				'urlContoroller'=>'c_disciplina/editar/'.$id,
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos,
				'hidden'=>$hidden,
				'camposTextareaHTML'=>$camposTextarea
			);
			

			if($this->input->post()) {
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'titulo' , 
		                'label'  =>  'Titulo' , 
		                'rules'  =>  'trim|required' 
		        ) 
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');
						$this->session->set_flashdata('mensagem', $arr_mensagem);							
					}else{
						$id = $this->input->post('id');
						$where = array('id'=>$id);
							
							$data['titulo'] = $this->input->post('titulo');
							$data['descricao'] = $this->input->post('descricao');
							$data['conteudo'] = $this->input->post('conteudo');

								$retorno = $this->auxiliar->atualizar('disciplina',$data,$where);
									if($retorno){
										$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Usuario Atualizado com sucesso!');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}else {
										$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-warning','msg'=>'Usuário não foi atualizado');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}
					}
					redirect('index.php/c_disciplina/gerenciar');	
			} 

			$paginasColecao['conteudo'] = $this->load->view('pages/v_editar',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
			/**/
		}

		function gerenciar() {
			$arr['urlCadastro'] = "c_disciplina/cadastrar";
				$paginasColecao['conteudo'] = $this->load->view('pages/v_gerenciar',$arr,TRUE);
					$this->load->view('v_conteiner',$paginasColecao);
		}

		function deletar($id) {
			if(empty($id) || !intval($id)){
				redirect('index.php/c_disciplina/gerenciar');
			}
			//deletar professor
			$retorno = $this->auxiliar->excluir('disciplina','id='.$id);
				if($retorno){
					$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-info','msg'=>'Rgistro excluido com sucesso!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}else {
					$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro ao deletar o registro!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}

			redirect('index.php/c_disciplina/gerenciar');		
		}

		function listar_jsonEncode(){
			$conteudo = $this->auxiliar->selectCampos('disciplina','id,titulo');
				$data = array('data'=>$conteudo);
					echo json_encode($data);
		}
		function uploadArquivo($nome_arquivo,$tipo,$caminho){
			//modificar o nome
			/**/
			$config['upload_path'] = $caminho;
			$config['allowed_types'] = "jpg|png";
			$config['file_name'] = $nome_arquivo.".".$tipo;
			$config['max_size'] = "500";
			/**/
				$this->load->library('upload');
					$this->upload->initialize($config);
						if($this->upload->do_upload('arquivo')){
							//redimensionando a imagem salva 
							$config_crop['image_library']='gd2';
							$config_crop['source_image']=$caminho."/".$nome_arquivo.".".$tipo;
							$config_crop['create_thumb']=FALSE;
							$config_crop['montain_ratio']=FALSE;
							$config_crop['width']=160;
							$config_crop['height']=160;
							//chama a biblioteca
								$this->load->library('image_lib', $config_crop);
								$this->image_lib->resize();

						}else{
							echo $this->upload->display_errors();
						}
		}
		
		function deletarArquivo($arq){
			$caminho = $_SERVER['DOCUMENT_ROOT']."/public/img/users/".$arq;
			unlink($caminho);
		}

	}
?>