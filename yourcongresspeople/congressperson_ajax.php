<?php
require_once('../db_conn.php');
require_once('../login_required.php');

$db = DbUtil::create();
$cur = 'name';
if(isset($_GET['order_column'])){
	$cur = $_GET['order_column'];
	$order_column = $_GET['order_column'];
	if($order_column == 'name'){
		$sql = "SELECT member_id, type, name, party, state, district FROM CongresspersonNameState WHERE lower(name) LIKE ?";
	} else{
		$sql = "SELECT member_id, type, name, party, state, district FROM CongresspersonNameState WHERE lower(state) LIKE ?";
	} 
}else{
	$sql = "SELECT member_id, type, name, party, state, district FROM CongresspersonNameState WHERE lower(name) LIKE ?";
}

$stmt = $db->prepare($sql);

if(!$stmt){
	echo $db->error;
	exit();
}



if( isset($_GET['query'] )){
	if($cur=='name'){
		$query_string = '';
		$temp = $_GET['query'];
		$names = explode(' ',  $temp); 
		foreach($names as $nsearch){
			$query_string = $query_string.'%' . strtolower($nsearch) . '%';
		}
	} else{
		$query_string = strtolower($_GET['query']) . '%';
	}
} else{
	$query_string = '%';
}
$stmt->bind_param("s", $query_string);
if(!$stmt->execute()){
	echo $stmt->error;
	exit();
}

$html_text = '';
$html_text = $html_text . '<table class="table table-striped">';
$html_text = $html_text . '<thead><tr><th>Type</th><th>Name</th><th>Party</th><th>State</th><th>District</th></tr></thead>';
$html_text = $html_text . '<tbody>';

$stmt -> bind_result($id, $type, $name, $party, $state, $district);
$stmt -> store_result();

$count = 0;

while($stmt->fetch()){
	$count = $count + 1;
	$html_text = $html_text . '<tr>';
	if($type == 'senate'){
		$html_text = $html_text . '<td>Senate</td>';
	}else{
		$html_text = $html_text . '<td>House</td>';
	}
	$acap = array('À','Á','Â','Ã', 'Ä');
	$a = array('à','á', 'â', 'ã', 'ä');
	$ecap = array('È', 'É', 'Ê', 'Ë');
	$e = array('è', 'é', 'ê', 'ë');
	$icap = array('Ì', 'Í', 'Î', 'Ï');
	$i = array('ì', 'í', 'î', 'ï');
	$ocap = array('Ò', 'Ó', 'Ô', 'Õ');
	$o = array('ò', 'ó', 'ô', 'õ', 'ö');
	$ucap = array('Ù', 'Ú', 'Û', 'Ü');
	$u = array('ù', 'ú', 'û', 'ü');
	$ycap = array('Ý', 'Ÿ');
	$y = array('ÿ', 'ý');      		
	$name = str_replace($acap, 'A', $name);
	$name = str_replace($a, 'a', $name);
	$name = str_replace($ecap, 'E', $name);
	$name = str_replace($e, 'e', $name);
	$name = str_replace($icap, 'I', $name);
	$name = str_replace($i, 'i', $name);
	$name = str_replace($ocap, 'O', $name);
	$name = str_replace($o, 'o', $name);
	$name = str_replace($ucap, 'U', $name);
	$name = str_replace($u, 'u', $name);
	$name = str_replace($ycap, 'Y', $name);
	$name = str_replace($y, 'y', $name);
	$name = str_replace('Ñ', 'N', $name);
	$name = str_replace('ñ', 'n', $name);
	$html_text = $html_text . "<td><a href='view_congressperson.php?id={$id}'>" . $name . "</a></td>";
	$html_text = $html_text . '<td>' . $party . '</td>';
	$html_text = $html_text . '<td>' . $state . '</td>';
	if($district == -1){
		$html_text = $html_text . '<td>N/A</td>';
	} else{
		$html_text = $html_text . '<td>' . $district . '</td>';
	}
	$html_text = $html_text . '</tr>';
}
$html_text = $html_text . '</tbody>';
$html_text = $html_text . '</table>';


$return_dict = array('html' => $html_text, 'length' => $count);
echo json_encode($return_dict);
?>
