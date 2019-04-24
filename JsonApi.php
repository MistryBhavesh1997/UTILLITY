<?php

function getIjson($query)
{
	$obj=new DB_Connect;
	if($obj->mysqlQuery($query))
	{
		return "valid";
	}
	else{
		return "Invalid";
	}
}


function checkDataExistOrNot($query)
{
	$obj=new DB_Connect;
	$result=$obj->mysqlQuery($query);
	$fields_num = mysqli_num_rows($result);	
	return $fields_num;
}

function mysql_Result($query)
{
	$obj=new DB_Connect;
	$result=$obj->mysqlQuery($query);	
	return $result;
}
function getDjson($query)
{
	$response['data']=array();
	$data = array();
	$obj=new DB_Connect;
	
	// mysqli_set_charset($obj->$con1,"utf8");
	$result=$obj->mysqlQuery($query);
	$fields_num = mysqli_num_fields($result);
	while($row=mysqli_fetch_array($result))
	{
		for($i=0;$i<$fields_num;$i++){
			$data[mysqli_field_name($result,$i)]= htmlspecialchars(str_replace("*","'",$row[$i]));		
		}
		array_push($response['data'], $data);
	}
	return $response;
}

function getjson($query)
{
		// echo $query;
	$response=array();
	$product = array();
	$response["data"]= array();
	$obj=new DB_Connect;
		// mysqli_set_charset($obj->$con1,"utf8");
	$result=$obj->mysqlQuery($query);
	$fields_num = mysqli_num_fields($result);
	while($row=mysqli_fetch_array($result))
	{
		for($i=0;$i<$fields_num;$i++)
		{
			$product[mysqli_field_name($result,$i)]= htmlspecialchars(str_replace("*","'",$row[$i]));
		}

		array_push($response["data"], $product);
	}


	echo str_replace('\/','/',json_encode($response));
}

function mysqli_field_name($result, $field_offset)
{
	$properties = mysqli_fetch_field_direct($result, $field_offset);
	return is_object($properties) ? $properties->name : null;
}

function getinsertjson($query)
{
	$response["data"]= array();
	$data= array();
	$obj=new DB_Connect;
	if($obj->mysqlQuery($query))
	{
		$data["value"]="valid";	  
		array_push($response["data"], $data);
	}
	else{
		$data["value"]="ivalid";	  
		array_push($response["data"], $data);
	}
	echo str_replace('\/','/',json_encode($response));
}


?>