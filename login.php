<?php

	$inData = getRequestInfo();

	$UserId = 0;
	$firstName = "";
	$lastName = "";

  $dbServerName =  "";
  $dbUserName =  "";
	$dbPassword =  "";
	$dbName =  "";

	$dbconn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$sql = "SELECT ID,FirstName,LastName FROM Users where Login='" . $inData["login"] . "' and Password='" . $inData["password"] . "'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$firstName = $row["FirstName"];
			$lastName = $row["LastName"];
			$UserId = $row["$UserId"];

			$conn->close();

			returnWithInfo($firstName, $lastName, $UserId );
		}
		else
		{
			$conn->close();

			returnWithError( "No Records Found" );
		}
	}

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}

	function returnWithError( $err )
	{
		$retValue = '{"id":0,"FirstName":"","LastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}

	function returnWithInfo( $firstName, $lastName, $id )
	{
		$retValue = '{"id":' . $id . ',"FirstName":"' . $firstName . '","LastName":"' . $lastName . '","error":""}';
		sendResultInfoAsJson( $retValue );
	}

?>
