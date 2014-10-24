<?php
class Crud_library {
	
	protected $ci;
	protected $output_type='auto';
	protected $data=array();
	protected $kolom=array();
	protected $data_count;
	protected $query;
	protected $table;
	protected $table_style;
	protected $add_column;
	protected $hidden=array();
		
	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
	
	public function set_output($type)
	{
		$this->output_type=$type;
	}
	
	function get_output()
	{
		return $this->output_type;
	}
	
	//LIST QUERY
	public function set_query($sql)
	{
		$this->query=$sql;
	}
	function get_query()
	{
		return $this->query;
	}
	
	function get_query_data()
	{
		$sql=$this->ci->db->query($this->query);
		if($sql->num_rows()>0)
		{
			$data=$sql->result();
			return $data;	
		}else{
			return null;			
		}
		
	}
	
	
	//LIST ACTIVE RECORD
	
	public function set_table($tbl_name)
	{
		$this->table=$tbl_name;
	}
	
	function get_table()
	{
		return $this->table;
	}
	
	public function set_activerecord($searchQuery='',$orderBy='',$groupBy='',$limit='')
	{
		if(!empty($searchQuery))
			{
				$this->ci->db->where($searchQuery);
			}
			if(!empty($limit))
			{
				$this->ci->db->limit($limit);
			}
			
			if(!empty($orderBy))
			{
				$this->ci->db->order_by($orderBy);
			}
			
			if(!empty($groupBy))
			{
				$this->ci->db->group_by($groupBy);
			}
			
			$result=$this->ci->db->get($this->table);
			if($result->num_rows()>0)
			{
				foreach($result->result() as $row)
				{
					$data[]=$row;
				}
				$this->data=$data;
			}else{
				return null;
			}
	}
	
	// LIST KOLOM
	function get_columns()
	{
		$ko=array();
		if($this->output_type=="auto")
		{
			$fields = $this->ci->db->list_fields($this->table);
			foreach ($fields as $field)
			{
			   $ko[]=$field;
			} 
		}elseif($this->get_output()=="query"){
			$sql=$this->query;
			$query = $this->ci->db->query($sql);
			
			foreach ($query->list_fields() as $field)
			{
			   $ko[]=$field;
			} 
			
		}else{
			return null;
		}
			$this->kolom=$ko;
		
			return $this->kolom;
		
	}
	
	function render_kolom()
	{
		$this->get_output();
		if($this->get_output()=="auto")
		{
			$this->get_table();
		}elseif($this->get_output()=="query"){
			$this->get_query();
		}else{
			die("Tipe Output tidak diset");
		}
				
		return $this->get_columns();
	}
	
	function render_data()
	{
		$this->get_output();
		$dt=array();
		if($this->get_output()=="auto")
		{
			$dt=$this->data;
		}elseif($this->get_output()=="query"){
			$dt=$this->get_query_data();
		}else{
			die("Tipe Output tidak diset");
		}
		
		return $dt;
	}
	
	public function table_style($att)
	{
		foreach ($att as $key => $value)  {

            $this->table_style= $key.'="'.$value.'"';
        }
	}
	
	public function action_column($arrColum)
	{
		foreach ($arrColum as $key => $value)  {

            $this->add_column=$value;
        }
	}
	
	public function hidden_column($column)
	{
		return $this->hidden=$column;
	}
	
	
	public function generate()
	{		
		$kolom_render=$this->render_kolom();
		$datanya=$this->render_data();
		
		$p2='';
		$p='';
		$p.='<table '.$this->table_style.'>';
		$p.='<thead>';		
		foreach($kolom_render as $v_kolom)
		{			
			$p.='<th>'.$v_kolom.'</th>';			
		}
		if(!empty($this->add_column))
		{
			$p.='<th>Action</th>';
		}
		
		$p.='</thead>';
		$p.='<tbody>';
				
			
			foreach($datanya as $v_data)
			{
				$p.='<tr>';	
				foreach($kolom_render as $v_kolom2)
				{
					
							$p.='<td>'.$v_data->$v_kolom2.'</td>';
												
				}
				if(!empty($this->add_column))
				{
					$p.='<td>'.$this->add_column.'</td>';
				}
				$p.='</tr>';
			}	
					
		
				
		
		$p.='</tbody>';
		
		
		$p.='</table>';
		
		return $p;
		
	}
	
	
	    
}
?>