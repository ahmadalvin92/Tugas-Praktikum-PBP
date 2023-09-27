 <?php
	$id = $_GET['id'];
	// Include our login information
	require_once('./db_login.php');
	//Asign a query
	$query = " DELETE FROM customers WHERE customerid=" . $id . " ";
	// Execute the query
	$result = $db->query($query);
	if (!$result) {
		die("Could not query the database: <br />" . $db->error);
	} else {
		$db->close();
		header('Location: view_customer.php');
	}
	//close db connection
	$db->close();
?>
