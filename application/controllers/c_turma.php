<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
	class C_Turma extends CI_Controller {
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
				'Turma'  => array(
					'type'  => 'text',
                    'name'  => 'turma',
                    'class' => 'form-control'
				),
				'Turno'  => array(
					'type'  => 'text',
                    'name'  => 'turno',
                    'class' => 'form-control'
				)											
			);
			$componentes = array(
				'urlContoroller'=>'c_turma/cadastrar',
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos
			);

			if($this->input->post()){
				/*verificar modo de validar para textarea*/
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'turma' , 
		                'label'  =>  'Turma' , 
		                'rules'  =>  'trim|required' 
		        ),
		        array ( 
		                'field'  =>  'turno' , 
		                'label'  =>  'Turno' , 
		                'rules'  =>  'trim|required' 
		        )		        		         		         
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');							
					}else{
						
						$dados['id'] = null;
						$dados['turma'] = $this->input->post('turma');
						$dados['turno'] = $this->input->post('turno');


						$retorno = $this->auxiliar->inserir('turma',$dados);
							if($retorno){
								$componentes['mensagem_retorno'] = array('tipo'=>'alert-info','msg'=>'Turma cadastrado com sucesso');
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
				redirect('index.php/c_turma/gerenciar');
			}
			//carregar infromaçãoes do usuario 
			$registroDisciplina = $this->auxiliar->selectClausulaLinha('turma','turma,turno',array('id'=>$id));
			$campos = array(
				'Turma'  => array(
					'type'  => 'text',
                    'name'  => 'turma',
                    'class' => 'form-control',
                    'value' => $registroDisciplina->turma
				),
				'Turno'  => array(
					'type'  => 'text',
                    'name'  => 'turno',
                    'class' => 'form-control',
                    'value' => $registroDisciplina->turno
				)							
			);

			$hidden = array('id' => $id);
			$componentes = array(
				'urlContoroller'=>'c_turma/editar/'.$id,
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos,
				'hidden'=>$hidden
			);
			

			if($this->input->post()) {
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'turma' , 
		                'label'  =>  'Turma' , 
		                'rules'  =>  'trim|required' 
		        ),
		        array ( 
		                'field'  =>  'turno' , 
		                'label'  =>  'Turno' , 
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
							
							$data['turma'] = $this->input->post('turma');
							$data['turno'] = $this->input->post('turno');
							
								$retorno = $this->auxiliar->atualizar('turma',$data,$where);
									if($retorno){
										$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'turma Atualizado com sucesso!');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}else {
										$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-warning','msg'=>'Turma não foi atualizado');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}
					}
					redirect('index.php/c_turma/gerenciar');	
			} 

			$paginasColecao['conteudo'] = $this->load->view('pages/v_editar',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
			/**/
		}

		function gerenciar() {
			$arr['urlCadastro'] = "c_turma/cadastrar";
				$paginasColecao['conteudo'] = $this->load->view('pages/v_gerenciar',$arr,TRUE);
					$this->load->view('v_conteiner',$paginasColecao);
		}

		function deletar($id) {
			if(empty($id) || !intval($id)){
				redirect('index.php/c_turma/gerenciar');
			}
			//deletar professor
			$retorno = $this->auxiliar->excluir('turma','id='.$id);
				if($retorno){
					$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-info','msg'=>'Registro excluido com sucesso!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}else {
					$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro ao deletar o registro!');
					$this->session->set_flashdata('mensagem', $arr_mensagem);
				}

			redirect('index.php/c_turma/gerenciar');		
		}

		function listar_jsonEncode(){
			$conteudo = $this->auxiliar->selectCampos('turma','id,turma');
				$data = array('data'=>$conteudo);
					echo json_encode($data);
		}

		function inserir_aluno() {
			if($this->input->post()) {
				$validarCampos = array( 
		        	array ( 
		                'field'  =>  'aluno' , 
		                'label'  =>  'Aluno' , 
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
							$data['fk_turma'] = $this->input->post('turma');
							$data['fk_aluno'] = $this->input->post('aluno');
							
								$retorno = $this->auxiliar->inserir('aluno_turma',$data);
									if($retorno){
										$arr_mensagem['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Turma Atualizado com sucesso!');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}else {
										$arr_mensagem['mensagem_retorno']=array('tipo'=>'alert-warning','msg'=>'Turma não foi atualizado');
										$this->session->set_flashdata('mensagem', $arr_mensagem);
									}
					}
					redirect('index.php/c_turma/inserir_aluno');	
			} 
 
			//carregar infromaçãoes do usuario 
			$todosOsAlunos = $this->auxiliar->selectCampos('aluno','id,nome');
			$todosAsTurmas = $this->auxiliar->selectCampos('turma','id,turma'); 
			
			$camposSelect =array(
				array('aluno','Alunos'=>$this->criaArrayFormatado($todosOsAlunos,'nome')),
				array('turma','Turma'=>$this->criaArrayFormatado($todosAsTurmas,'turma'))
			);

			$componentes = array(
				'urlContoroller'=>'c_turma/inserir_aluno',
				'mensagem_retorno'=>NULL,
				'camposSelect'=>$camposSelect
			);
			$paginasColecao['conteudo'] = $this->load->view('pages/v_cadastro',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
			/**/
		}

		//auxiliares
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