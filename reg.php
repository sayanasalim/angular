<?php
include("header.php");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: PUT,GET,POST");
header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept");
  $postdata=file_get_contents("php://input");//json data is assigned tp potdata
  if(isset($postdata) && !empty($postdata))
{
  $request=json_decode($postdata);//to decode the data from json
  $name=mysqli_real_escape_string($conn,trim($request->data->name));//name is the field name from the student class
  $email=mysqli_real_escape_string($conn,trim($request->data->email));
  $password=mysqli_real_escape_string($conn,trim($request->data->password));
      
       
	
	$query="insert into tbl_reg(name,email,password)values('$name','$email','$password')";
        if(mysqli_query($conn,$query))
{
	http_response_code(201);
	//in case of select
	$student=[
		'name'=>$name,
	'email'=>$email,
	'password'=>$password,
	'id'=>mysqli_insert_id($conn)
	];
	echo json_encode(['data'=>$student]);
}
    else
{
      http_response_code(422);   
}
}
?>