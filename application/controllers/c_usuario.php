<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
	class c_Usuario extends CI_Controller {
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

		function cadastrar() {
			$campos = array(
				'nome'  => array(
					'type'  => 'text',
                    'name'  => 'nome',
                    'class' => 'form-control'
				),
				'email' => array(
					'type'  => 'email',
                    'name'  => 'email',
                    'class' => 'form-control'
				),
				'login' => array(
					'type'  => 'text',
                    'name'  => 'login',
                    'class' => 'form-control'
				),
				'senha' => array(
					'type'  => 'password',
                    'name'  => 'senha',
                    'class' => 'form-control'
				),
				'Imagem' => array(
					'type'  => 'file',
                    'name'  => 'arquivo',
                    'class' => 'form-control'
				)			
			);

			//carregar infromaçãoes do usuario 
			
			$componentes = array(
				'urlContoroller'=>'c_usuario/cadastrar',
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos
			);

			if($this->input->post()){
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'login' , 
		                'label'  =>  'Login' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'senha' , 
		                'label'  =>  'Senha' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'nome' , 
		                'label'  =>  'Nome' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'email' , 
		                'label'  =>  'E-mail' , 
		                'rules'  =>  'trim|required' 
		        )
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');							
					}else{
						$dados['nome'] = $this->input->post('nome');
						$dados['login'] = $this->input->post('login');
						$dados['email'] = $this->input->post('email');
												
						//trocar criptogrfia, pela do C_I
						$dados['senha'] = md5($this->input->post('senha'));	
							$imagem_ext = explode('.', $_FILES['arquivo']['name']);
								$ext = end($imagem_ext);
									$nome_imagem_cripto = md5(date('Y-m-d h:m:s'));
										$caminho = $_SERVER['DOCUMENT_ROOT']."/public/img/users/";
											$this->uploadArquivo($nome_imagem_cripto,$ext,$caminho);
								
								$retorno = $this->auxiliar->inserir('usuarios',$dados);
									//retorna o id do cadastro
									if($retorno){
									$componentes['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Usuario cadastrado com sucesso');
										//inserir imagem
										$this->auxiliar->inserir('imagem_usuario',array('img'=>$nome_imagem_cripto.".".$ext,'fk_usuario'=>$retorno));
										
									}else {
										$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro no Cadastro');
									}
									
									//redirecioana para login
  								    //redirect('index.php/c_login','refresh');
					}

			} 
			//carrrega a pagina com as informações
			//$this->load->view('form_login',$componentes);

			$paginasColecao['conteudo'] = $this->load->view('pages/v_cadastro',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
		}
		function editar($id) {
			//bloqueio para redirecionar quando o id for nullo ou literal
			if(empty($id) || !intval($id)){
				redirect('index.php/c_usuario/gerenciar');
			}
			//carrega model aluno
			$this->load->model('usuario_m');
			//carregar infromaçãoes do usuario 
			$retorno = $this->auxiliar->selectClausula('usuarios','nome,email,login',array('id'=>$id));
			// 
			$bdImg = $this->usuario_m->ListarUsuariosComImagemClausula("usuarios.id=".$id);
			
			$rs = $retorno[0];
			$rsImg =$bdImg[0]['img'];
			$avatar = base_url("/public/img/users/".$rsImg); 
			/**/
			$campos = array(
				'nome'  => array(
					'type'  => 'text',
                    'name'  => 'nome',
                    'class' => 'form-control',
                    'value' => $rs['nome']
				),
				'email' => array(
					'type'  => 'email',
                    'name'  => 'email',
                    'class' => 'form-control',
                    'value' => $rs['email']
				),
				'login' => array(
					'type'  => 'text',
                    'name'  => 'login',
                    'class' => 'form-control',
                    'value' => $rs['login']
				),
				'senha' => array(
					'type'  => 'password',
                    'name'  => 'senha',
                    'class' => 'form-control'
				),
				'Imagem' => array(
					'type'  => 'file',
                    'name'  => 'arquivo',
                    'class' => 'form-control'
				)			
			);
			
			$hidden = array('id' => $id,
				'img_antiga'=>$rsImg);
			
			$componentes = array(
				'urlContoroller'=>'c_usuario/editar/'.$id,
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos,
				'hidden'=>$hidden,
				'avatar'=>$avatar
			);
			

			if($this->input->post()) {
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'login' , 
		                'label'  =>  'Login' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'nome' , 
		                'label'  =>  'Nome' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'email' , 
		                'label'  =>  'E-mail' , 
		                'rules'  =>  'trim|required' 
		        ) 
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');							
					}else{
						$id = $this->input->post('id');
						$dados['nome'] = $this->input->post('nome');
						$dados['login'] = $this->input->post('login');
						$dados['email'] = $this->input->post('email');
						
							/*resolver isso de metodo string*/
							//se a senha foi preenchaida, coloque na string do metodo
							if($this->input->post('senha') != ''){
								$dados['senha'] = md5($this->input->post('senha'));	
								$dados = " nome = '".$dados['nome']."', login = '".$dados['login']."' , email =  '".$dados['email']."', senha =  '"
								.$dados['senha']."'";
							}else{
								$dados = " nome = '".$dados['nome']."', login = '".$dados['login']."' , email =  '".$dados['email']."'";
							}
						$where = " id = ".$id." ";
						$retorno = $this->auxiliar->atualizar_string('usuarios',$dados,$where);
						//atulizar arquivos
						if($_FILES['arquivo']['size'] != 0){
							//delete o arquivo antigo
							$this->deletarArquivo($this->input->post('img_antiga'));
							
							//upload do arquivo
							$imagem_ext = explode('.', $_FILES['arquivo']['name']);
								$ext = end($imagem_ext);
									$nome_imagem_cripto = md5(date('Y-m-d h:m:s'));
										$caminho = $_SERVER['DOCUMENT_ROOT']."/public/img/users/";
											$this->uploadArquivo($nome_imagem_cripto,$ext,$caminho);
											//inserir no banco de dados
											//verificar se existe registro no banco
											if(count($this->auxiliar->selectClausula('imagem_usuario','img',array('fk_usuario'=>$id))) > 0){
												//atualiza o registro existente
												//*trocar por printf as concatenações
												$this->auxiliar->atualizar_string('imagem_usuario','img = "'.$nome_imagem_cripto.".".$ext.'"','fk_usuario = '.$id);
											}else{
												//se não, cadastra um novo registro
												$nomeImagem = $nome_imagem_cripto.".".$ext;
													$dadoCadastroImagem = array('id'=>null,'img'=>$nomeImagem,'fk_usuario'=>$id);
														$this->auxiliar->inserir('imagem_usuario',$dadoCadastroImagem);
											}
																		
						}
							/**/
							if($retorno){
								$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Usuario Atualizado com sucesso!');
								$this->session->set_flashdata('mensagem', $arr_mensagem);
							}else {
								$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro no Cadastro');
								$this->session->set_flashdata('mensagem', $arr_mensagem);
							}
							/**/
					}
					redirect('/index.php/c_usuario/gerenciar');	
			} 

			$paginasColecao['conteudo'] = $this->load->view('pages/v_editar',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
			/**/
		}

		function gerenciar() {
			$arr['urlCadastro'] = "c_usuario/cadastrar";
			$paginasColecao['conteudo'] = $this->load->view('pages/v_gerenciar',$arr,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
		}

		function deletar($id) {
			if(empty($id) || !intval($id)){
				redirect('c_usuario/gerenciar');
			}
			//deletar imagem
				//resgatar nome imagem
				$nome_img = $this->auxiliar->selectClausula('imagem_usuario','img','fk_usuario = '.$id);
				//* trocar pro um fetch
				$img = $nome_img[0]['img'];
				//apagar arquivo
				$this->deletarArquivo($img);
				//apagar imagem no banco
				$this->auxiliar->excluir('imagem_usuario','fk_usuario ='.$id);
			//deletar aluno
			$retorno = $this->auxiliar->excluir('usuarios','id='.$id);
				if($retorno){
					$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-info','msg'=>'Rgistro excluido com sucesso!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}else {
					$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro ao deletar o registro!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}

			redirect('index.php/c_usuario/gerenciar');		
		}

		function listar_jsonEncode(){
			$this->load->model('usuario_m');
			$conteudo = $this->usuario_m->ListarUsuariosComImagem();
			
			$linha = array();
			foreach ($conteudo as $key => $value) {
				$coluna['id'] = $value['id'];
				$coluna['nome'] = $value['nome'];
				$coluna['email'] = $value['email'];
					if($value['img'] == null){
						$coluna['img'] = '000.png';
					}else{
						$coluna['img'] = $value['img'];	
					}
				
					$linha[] = $coluna;
				
			}
			$data = array('data'=>$linha);
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
		//criar lista para a view
		function criaArrayFormatado($arr,$nomeCampo){
			$linha = array();
			foreach ($arr as $key => $value) {
				$linha[$value['id']] = $value[$nomeCampo];
			}
			return $linha;
		}

	}
?>