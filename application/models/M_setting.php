<?php
class M_setting extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_setting";
	}
	
	function items()
	{
		$sql   = "SELECT * FROM {$this->_table}";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>