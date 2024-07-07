<?php 
header("Access-Control-Allow-Origin:*");
if($_SERVER['REQUEST_METHOD']=="POST")
{
	
	$ip=$_SERVER['REMOTE_ADDR'];
	$_POST['ip']=$ip;
	$_POST['datetime']=date("Y-m-d H:i:s A");
	$input[$_POST['email']]=$_POST;
	$fname="portfolio_visits.json";
	$file_array=@file_get_contents($fname);
	if($file_array)
	{
	$file=(array)json_decode($file_array);
	$file[$_POST['email']]=$_POST;
	file_put_contents($fname,json_encode($file,JSON_PRETTY_PRINT));
	http_response_code(200);
	}
	else
		http_response_code(404);
	
	
}
else
{
	http_response_code(400);
	echo "Invalid Request Method";
	
}
?>