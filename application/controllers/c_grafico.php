<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
	class C_Grafico extends CI_Controller {
		function __construct(){
			parent::__construct();
			if($this->session->userdata('logado') != TRUE):
				redirect('index.php/c_login/sair','refresh');
			endif;
			$this->load->helper('form');
			$this->load->model('auxiliar');
		}

		function index() {
			$this->grafico();
			//echo "achou!";
		}

		function grafico(){
			$this->load->model('graficos');
			$conteudo = $this->graficos->ListarAlunosDisciplina();
			exit;
		}

		
		function listar_jsonEncode(){
			$this->load->model('aluno_m');
			$conteudo = $this->aluno_m->ListarAlunosComImagem();
			
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
		
	}
?>