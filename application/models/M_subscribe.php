<?php
class M_subscribe extends M_db
{
	public function __construct()
	{
		parent::__construct();
		
		$this->_table = "vs_subscribe";
	}
	
	function items($info=NULL, $active=NULL, $limit=NULL, $offset=NULL)
	{
		$sql = "SELECT * FROM {$this->_table} WHERE 1 = 1";
		if (!is_null($info)) {
			if (!empty($info->email)) {
				$sql .= " AND email = '{$info->email}'";
			}
			if (!empty($info->fromdate)) {
				$sql .= " AND DATE(created_date) >= '{$info->fromdate}'";
			} 
			if (!empty($info->today)) {
				$sql .= " AND DATE(created_date) <= '{$info->today}'";
			}
		}
		if (!is_null($active)) {
			$sql .= " AND active = '{$active}'";
		}
		if (!is_null($limit)) {
			$sql .= " LIMIT {$limit}";
		}
		if (!is_null($offset)) {
			$sql .= " OFFSET {$offset}";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function export_csv($filename,$info){
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$delimiter = ",";
		$newline = "\r\n";
		$filename .= '.csv';
		$arr = array();
		$sql = "SELECT DISTINCT email as Email FROM {$this->_table} WHERE 1";
		if (!is_null($info)) {
			foreach ($info as $key => $value) {
				if ($key == 'fromdate') {
					$sql .= " AND DATE(created_date) >= '{$value}'";
				} elseif ($key == 'todate') {
					$sql .= " AND DATE(created_date) <= '{$value}'";
				}
			}
		}
		$sql .= " AND active = '1'";
		$result = $this->db->query($sql);
		$data = $this->dbutil->csv_from_result($result,$delimiter,$newline);
		force_download($filename, $data);
	}
}
?>