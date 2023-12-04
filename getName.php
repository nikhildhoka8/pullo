<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      
	
	//if this is a page that requires login always perform this session verification
	//require_once "inc/sessionVerify.php";



	require_once "dbconnect.php";




// Fill up array with names

$stmt = $con->prepare("select distinct lName from USER_TABLE");
$stmt->execute();

// get the q parameter from URL
$q=$_REQUEST["q"]; 

$hint="";

// lookup all hints from array if $q is different from "" 
if ($q !== "")
{ 	
	$q=strtolower($q); 
	$len=strlen($q);

	
	while($res = $stmt->fetch(PDO::FETCH_ASSOC)) {

		if (stristr($q, substr($res['lName'],0,$len))) //test if $q matches with the first few characters of the same length in the lastname
      		{ 
			if ($hint==="")
       		{ 
				$hint = "<option>". $res['lName']."</option>";
 			}
        		else
        		{ 	
					$hint .= "<option>". $res['lName']."</option>";
				}
      		}
    	}
}


print $hint;
?>