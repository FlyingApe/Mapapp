<?php
class DbHandler extends mysqli
{
	function __construct()
	{
		parent::__construct("localhost", "demo_dummy", "M3c8FYK8FKPqU2B5", "mapapp_nl_1");
	}
	
	public function select_Markers(){
		$holder = array();
		$query = "SELECT id, x, y, title FROM markers";
		$result = $this->query($query) or return_error("Query Error: $query");
		while ($row = $result->fetch_assoc()){
			$holder[$row['id']] = array('x' => $row['x'],
						    'y' => $row['y'],
						    'title' => $row['title']);
		}
		
		$result->free();
		return $holder;
	}
	
	public function select_MarkerContent($id){
		if (is_numeric($id)){
			$query = "SELECT title, content FROM markers WHERE id=".$id." LIMIT 1;";
			$result = $this->query($query) or return_error("Query Error: $query");
			$holder = $result->fetch_assoc();
			$result->free();
			return $holder;
		} else {
			return FALSE;
		}
	}
	
	public function insert_Marker($id, $x, $y){
		if (is_numeric($id) && is_numeric($x) && is_numeric($y)){
			$query = "INSERT INTO markers SET id=".$id.", x=".$x.", y=".$y." ON DUPLICATE KEY UPDATE x=".$x.", y=".$y.";";
			$result = $this->query($query) or return_error("Query Error: $query");
			return $result;
		} elseif($id == NULL && is_numeric($x) && is_numeric($y)){
			$query = "INSERT INTO markers SET x=".$x.", y=".$y.";";
			$result = $this->query($query) or return_error("Query Error: $query");
			return $result;			
		} else {
			return FALSE;
		}
	}
	
	public function update_MarkerContent($id, $title, $content){
		if (is_numeric($id)){
			$query = "UPDATE markers SET title='".$title."', content='".$content."' WHERE id=".$id.";";
			$result = $this->query($query) or return_error("Query Error: $query");
			return $result;
		} else {
			return FALSE;
		}
	}
	
	public function delete_Marker($id){
		if (is_numeric($id)){
			$query = "DELETE FROM markers WHERE id='".$id."' LIMIT 1;";
			$result = $this->query($query) or return_error("Query Error: $query");
			return $result;
		} else {
			return FALSE;
		}
	}
}
?>