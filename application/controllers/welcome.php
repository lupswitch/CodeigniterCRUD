<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('crud_library');
		$this->crud_library->set_output("auto");
		$this->crud_library->set_table('obat');
		$search=array(
			'pabrik'=>"Air Mancur",
			);
		$this->crud_library->set_activerecord($search);
		$att=array(
			'class'=>'form-control',
			'border'=>'1',
			);
		$this->crud_library->table_style($att);
		echo $this->crud_library->generate();
	}
	
	function query()
	{
		$this->load->library('crud_library');
		$sql="Select * from obat";
		$this->crud_library->set_output("query");
		$this->crud_library->set_query($sql);
		$att=array(
			'class'=>'form-control',
			'border'=>'1',
			);
		$this->crud_library->table_style($att);
		echo $this->crud_library->generate();
	}
	
	function action()
	{
		$this->load->library('crud_library');
		$sql="Select * from obat";
		$this->crud_library->set_output("query");
		$this->crud_library->set_query($sql);
		$att=array(
			'class'=>'form-control',
			'border'=>'1',
			);
		$act=array(
			'Delete'=>'<a href="$1">Delete</a>',			
			);
		$this->crud_library->hidden_column('kode_obat');
		$this->crud_library->action_column($act);
		$this->crud_library->table_style($att);
		echo $this->crud_library->generate();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */