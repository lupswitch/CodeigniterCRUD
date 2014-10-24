<?php
class Chat extends CI_Controller
{
	function index()
	{
		echo "ASDASDASD";
	}
	
	function getChat()
	{
		$s="Select * from chat_room ORDER BY chat_date DESC LIMIT 10";
		$this->load->library('iksdb_library');
		$d=$this->iksdb_library->QueryData($s);		
		foreach($d as $r)
		{
			$data=array(
					'usr'=>$r->chat_user,
					'v'=>$r->chat_value,
				);
		}
		
		echo json_encode($data);
	}
}
?>