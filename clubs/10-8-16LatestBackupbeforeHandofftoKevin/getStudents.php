<?php
	$servername = "localhost";
	$username = "clubs_u3er";
	$password = "tCpw6uTKZj3faqPT";
	$dbname = "clubs";

	$con=mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (mysqli_connect_errno())
 	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}

	$clubid = $_COOKIE['clubid'];

  	$sql = "SELECT `userid` FROM `memberships` WHERE `clubid` = $clubid AND `isDeleted` = 0";
	$result=mysqli_query($con,$sql);
	
	$rows = array();

	if (mysqli_num_rows($result) > 0) {
    	while($row = mysqli_fetch_assoc($result)) {
    		$studentid = $row["userid"];
    		$sql2 = "SELECT `firstname`,`lastname`,`email`,`grade` FROM `users` WHERE `id` = $studentid";
    		$result2 = mysqli_query($con,$sql2);
			if (mysqli_num_rows($result2) > 0) {
    			while($row2 = mysqli_fetch_assoc($result2)) {
    				$firstname = $row2["firstname"];
    				$lastname = $row2["lastname"];
    				$grade = $row2["grade"];
    				$array = array('firstname'=>$firstname, 'lastname'=>$lastname, 'grade'=>$grade);
    				$rows[] = $array;
    				//$text = $text. "firstName:". $row2["firstname"]. ",lastName:". $row2["lastname"]. ",email:". $row2["email"]. ",grade:". $row2["grade"]. ",";
    			}
    		}
    	}
    } else {
    	echo "0 results";
	}
	
	//print_r($rows);
    echo json_encode($rows);

	$con->close();
	
?>