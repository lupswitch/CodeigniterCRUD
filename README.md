CodeigniterCRUD
===============

Installation & Usage :
1. Include crud_library.php to your libraries Folder
2. Usage : 

A. For Active Record Codeigniter
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
		
B. For Custom Query
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
		
	C. Generate with Column Add
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
