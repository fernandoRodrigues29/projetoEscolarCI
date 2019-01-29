<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
	class C_Professor extends CI_Controller {
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
				'nome'  => array(
					'type'  => 'text',
                    'name'  => 'nome',
                    'class' => 'form-control'
				)			
			);
			//carregar infromaçãoes do usuario 
			$todosAsDisciplinas = $this->auxiliar->selectCampos('disciplina','id,titulo'); 
			$camposSelect =array(
				array('disciplina','Disciplina'=>$this->criaArrayFormatado($todosAsDisciplinas,'titulo'))
			);			
			
			$componentes = array(
				'urlContoroller'=>'c_professor/cadastrar',
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
		        ) 
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');							
					}else{
						$dados['id'] = null;
						$dados['nome'] = $this->input->post('nome');
						$dados['fk_disciplina'] = $this->input->post('disciplina');

						$retorno = $this->auxiliar->inserir('professor',$dados);
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
				redirect('index.php/c_professor/gerenciar');
			}
			//carregar infromaçãoes do usuario 
			$registroProfessor = $this->auxiliar->selectClausulaLinha('professor','nome,fk_disciplina',array('id'=>$id));
			$campos = array(
				'nome'  => array(
					'type'  => 'text',
                    'name'  => 'nome',
                    'class' => 'form-control',
                    'value' => $registroProfessor->nome
				)			
			);
			//carregar infromaçãoes do usuario 
			$todosAsDisciplinas = $this->auxiliar->selectCampos('disciplina','id,titulo'); 
			$camposSelect =array(
				array('disciplina',$registroProfessor->fk_disciplina,'Disciplina'=>$this->criaArrayFormatado($todosAsDisciplinas,'titulo'))
			);			
			$hidden = array('id' => $id);
			
			$componentes = array(
				'urlContoroller'=>'c_professor/editar/'.$id,
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos,
				'camposSelect'=>$camposSelect,
				'hidden'=>$hidden
			);
			

			if($this->input->post()) {
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'nome' , 
		                'label'  =>  'Nome' , 
		                'rules'  =>  'trim|required' 
		        ) 
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');
						$this->session->set_flashdata('mensagem', $arr_mensagem);							
					}else{
						$id = $this->input->post('id');
						$where = " id = ".$id;
							$data['nome'] = $this->input->post('nome');
							$data['fk_disciplina'] = $this->input->post('disciplina');

								$retorno = $this->auxiliar->atualizar('professor',$data,$where);
								
									if($retorno){
										$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Usuario Atualizado com sucesso!');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}else {
										$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-warning','msg'=>'Usuário não foi atualizado');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}
					}
					redirect('index.php/c_professor/gerenciar');	
			} 

			$paginasColecao['conteudo'] = $this->load->view('pages/v_editar',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
			/**/
		}

		function gerenciar() {
			$arr['urlCadastro'] = "c_professor/cadastrar";
				$paginasColecao['conteudo'] = $this->load->view('pages/v_gerenciar',$arr,TRUE);
					$this->load->view('v_conteiner',$paginasColecao);
		}

		function deletar($id) {
			if(empty($id) || !intval($id)){
				redirect('index.php/c_professor/gerenciar');
			}
			//deletar professor
			$retorno = $this->auxiliar->excluir('professor','id='.$id);
				if($retorno){
					$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-info','msg'=>'Rgistro excluido com sucesso!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}else {
					$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro ao deletar o registro!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}

			redirect('index.php/c_professor/gerenciar');		
		}

		function listar_jsonEncode(){
			$conteudo = $this->auxiliar->selectCampos('professor','id,nome');
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
		//inserir turmas
		function inserir_turma() {
			if($this->input->post()) {
				$validarCampos = array( 
		        	array ( 
		                'field'  =>  'professor' , 
		                'label'  =>  'Professor' , 
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
					$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');
						$this->session->set_flashdata('mensagem', $arr_mensagem);							
					}else{
							$data['id'] = NULL;
							$data['fk_professor'] = $this->input->post('professor');
							$data['fk_turma'] = $this->input->post('turma');
							
								$retorno = $this->auxiliar->inserir('professor_turma',$data);
									if($retorno){
										$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Turma Atualizado com sucesso!');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}else {
										$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-warning','msg'=>'Turma não foi atualizado');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}
					}
					redirect('index.php/c_professor/inserir_turma');	
			} 
 
			//carregar infromaçãoes do usuario 
			$todosAsProfessores = $this->auxiliar->selectCampos('professor','id,nome');
			$todosAsTurmas = $this->auxiliar->selectCampos('turma','id,turma'); 
			
			$camposSelect =array(
				array('professor','Professores'=>$this->criaArrayFormatado($todosAsProfessores,'nome')),
				array('turma','Turmas'=>$this->criaArrayFormatado($todosAsTurmas,'turma'))
			);

			$componentes = array(
				'urlContoroller'=>'c_professor/inserir_turma',
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