<?php
 //	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
 //	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
 //	$offset = ($page-1)*$rows;
 //	$result = array();
	include 'conn.php';
	
 //	$statement = $conn->query('select * from meal');
	
 //   foreach($statement as $row){
 //     $result["total"] = $row[0] ;
 //   }
     // $result = array();
	$main = intval($_REQUEST['main']);
	$sub = intval($_REQUEST['sub']);	
	$recomm = $_REQUEST['recommend'];
	$keyword = $_REQUEST['keyword'];
     		
	if ($recomm == "Y") {
		$recomm_YN = 1 ;
	} else {
		$recomm_YN = 0 ;
	} 

	$statement = $conn->query('select count(*) from meal');
    foreach($statement as $row){
     // $result["total"] = $row[0] ;
    }
	if ($recomm_YN) {		
	    $sql="select name,url,img,typeid,id from meal where typeid=".$main." and recomm=".$recomm_YN ;
        if 	($main < 0 )  $sql="select name,url,img,typeid,id from meal where recomm=".$recomm_YN ;
	} else {
	    $sql="select name,url,img,typeid,id from meal where typeid=".$main." and subid=".$sub." and recomm=".$recomm_YN ;	
	    if ($main > 0  and $sub < 0 ) $sql="select name,url,img,typeid,id from meal where typeid=".$main  ;	
	}	

    if ( strlen($keyword) > 0 ) $sql="select name,url,img,typeid,id from meal where name like '%".$keyword."%'"  ;
		
		
    /*	
	 echo $sql ;
	 exit() ;
   	*/
	
	$statement = $conn->query($sql);
	$items = array();
    foreach($statement as $row) {
       array_push($items, $row);
      // echo $row['name']." ".$row['url']."<br>";
    }
   $result = $items;
   header('Content-Type: application/json; charset=utf-8'); 
   echo json_encode($result);
 //	$result=array([{"name":"農林漁牧業普查家數","url":"http://127.0.0.1/data/AIH05.html","img":"china_100.png","typeid":"2","id":"221"},{"name":"農林漁牧業普查家數","url":"http://127.0.0.1/data/AIH05.html","img":"china_100.png","typeid":"2","id":"221"}]

 // echo json_encode(array(array("name" => "農林漁牧業普查家數" , "url" => "http://127.0.0.1/data/AIH05.html" , "img" => "china_100.png","typeid" => "2" ,"id" => "221")))    //如要驗證數字 ,最後右括號前加上 ", JSON_NUMERIC_CHECK"

 //	echo json_encode($result);
	
	//	echo json_encode($result);
	// $conn -> close() ;	
		
?>