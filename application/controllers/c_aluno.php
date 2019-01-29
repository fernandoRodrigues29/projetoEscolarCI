<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
	class C_Aluno extends CI_Controller {
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
				)			
			);

			//carregar infromaçãoes do usuario 
			$todosAsTurmas = $this->auxiliar->selectCampos('turma','id,turma'); 
			
			$camposSelect =array(
				array('turma','Turma'=>$this->criaArrayFormatado($todosAsTurmas,'turma'))
			);
			
			$componentes = array(
				'urlContoroller'=>'c_aluno/cadastrar',
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos,
				'camposSelect'=>$camposSelect
			);

			if($this->input->post()){
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'nome' , 
		                'label'  =>  'Nome' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'email' , 
		                'label'  =>  'E-mail' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'turma' , 
		                'label'  =>  'Turma' , 
		                'rules'  =>  'trim|required' 
		        ) 
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');							
					}else{
						$dados['nome'] = $this->input->post('nome');
						$dados['email'] = $this->input->post('email');
						$dados['fk_turma'] = $this->input->post('turma');						
						
								$retorno = $this->auxiliar->inserir('aluno',$dados);
									if($retorno){
									$componentes['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Aluno cadastrado com sucesso');
										$this->auxiliar->inserir('imagem_usuario',array('img'=>$nome_imagem_cripto.".".$ext,'fk_usuario'=>$retorno));
										
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
				redirect('c_aluno/gerenciar');
			}
			//carrega model aluno
			$this->load->model('aluno_m');
			//carregar infromaçãoes do usuario 
			$retorno = $this->auxiliar->selectClausula('aluno','nome,email,fk_turma',array('id'=>$id));
			// *
			$rs = $retorno[0];
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
				)			
			);

			$todosAsTurmas = $this->auxiliar->selectCampos('turma','id,turma'); 
			$camposSelect =array(
				array('turma',$rs['fk_turma'],'Turma'=>$this->criaArrayFormatado($todosAsTurmas,'turma'))
			);			
			$hidden = array('id' => $id);
			
			$componentes = array(
				'urlContoroller'=>'c_aluno/editar/'.$id,
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos,
				'hidden'=>$hidden,
				'camposSelect'=>$camposSelect
			);
			

			if($this->input->post()) {
				$validarCampos = array( 
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
						$dados['email'] = $this->input->post('email');
						$dados['fk_turma'] = $this->input->post('turma');
							/*resolver isso de metodo string*/
							//se a senha foi preenchaida, coloque na string do metodo
						$dados = " nome = '".$dados['nome']."' , email =  '".$dados['email']."', fk_turma = ".$dados['fk_turma'];
						$where = " id = ".$id." ";
						
						$retorno = $this->auxiliar->atualizar_string('aluno',$dados,$where);
						//atulizar arquivos
							if($retorno){
								$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Aluno Atualizado com sucesso!');
								$this->session->set_flashdata('mensagem', $arr_mensagem);
							}else {
								$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro no Cadastro');
								$this->session->set_flashdata('mensagem', $arr_mensagem);
							}
							/**/
					}
					redirect('/index.php/c_aluno/gerenciar');	
			} 

			$paginasColecao['conteudo'] = $this->load->view('pages/v_editar',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
			/**/
		}

		function gerenciar() {
			$arr['urlCadastro'] = "c_aluno/cadastrar";
			$paginasColecao['conteudo'] = $this->load->view('pages/v_gerenciar',$arr,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
		}

		function deletar($id) {
			if(empty($id) || !intval($id)){
				redirect('c_aluno/gerenciar');
			}
			//deletar aluno
			$retorno = $this->auxiliar->excluir('aluno','id='.$id);
				if($retorno){
					$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-info','msg'=>'Rgistro excluido com sucesso!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}else {
					$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro ao deletar o registro!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}

			redirect('index.php/c_aluno/gerenciar');		
		}

		function listar_jsonEncode(){
			$this->load->model('aluno_m');
			$conteudo = $this->auxiliar->selectCampos('aluno','id,nome');
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
		//inserir disciplina aluno
		function inserir_disiciplina() {
			if($this->input->post()) {
				$validarCampos = array( 
		        	array ( 
		                'field'  =>  'aluno' , 
		                'label'  =>  'Aluno' , 
		                'rules'  =>  'trim|required' 
		        	),
		        	array ( 
		                'field'  =>  'disciplina' , 
		                'label'  =>  'Disciplina' , 
		                'rules'  =>  'trim|required' 
		        	)		        
				); 

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');
						$this->session->set_flashdata('mensagem', $arr_mensagem);							
					}else{
							$data['id'] = NULL;
							$data['fk_disciplina'] = $this->input->post('disciplina');
							$data['fk_aluno'] = $this->input->post('aluno');
							
								$retorno = $this->auxiliar->inserir('aluno_disciplina',$data);
									if($retorno){
										$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Turma Atualizado com sucesso!');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}else {
										$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-warning','msg'=>'Turma não foi atualizado');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}
					}
					redirect('index.php/c_aluno/inserir_disiciplina');	
			} 
 
			//carregar infromaçãoes do usuario 
			$todosOsAlunos = $this->auxiliar->selectCampos('aluno','id,nome');
			$todosAsDisiciplinas = $this->auxiliar->selectCampos('disciplina','id,titulo'); 
			
			$camposSelect =array(
				array('aluno','Alunos'=>$this->criaArrayFormatado($todosOsAlunos,'nome')),
				array('disciplina','Disciplina'=>$this->criaArrayFormatado($todosAsDisiciplinas,'titulo'))
			);

			$componentes = array(
				'urlContoroller'=>'c_aluno/inserir_disiciplina',
				'mensagem_retorno'=>NULL,
				'camposSelect'=>$camposSelect
			);
			$paginasColecao['conteudo'] = $this->load->view('pages/v_cadastro',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
			/**/
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