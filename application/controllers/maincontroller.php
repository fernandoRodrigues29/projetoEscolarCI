<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Maincontroller extends CI_Controller {
	private $nomeUsuario;
	private $emailUsuario;
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logado') != TRUE):
			redirect('index.php/c_login/sair','refresh');
		endif;
		$this->load->library('Pessoa');
	}

	public function index() {
		$dadosUsuario = $this->session->userdata('usuario');
			$pessoa = new Pessoa();
			$pessoa->setNome($dadosUsuario['nome']);
			$pessoa->setContato($dadosUsuario['email']);
				$this->load->view('v_conteiner');		
	}
}
?>
