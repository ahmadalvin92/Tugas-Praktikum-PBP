<?php include('./header.html') ?>
	<br>
	<div class="card">
		<div class="card-header">Confirm Delete Customers Data</div>
		<div class="card-body">
			<br>
			<?php
			$id = $_GET['id'];
			// Include our login information
			require_once('./db_login.php');
			$query = " SELECT * FROM customers WHERE customerid=" . $id;
			$result = $db->query($query);
			if (!$result) {
				die("Could not query the database: <br />" . $db->error);
			} else {
				while ($row = $result->fetch_object()) {
					echo '<table class="table">';
					echo '<tr><td>Name</td> <td>:</td> <td>' . $row->name . '</td></tr>';
					echo '<tr><td>Address</td> <td>:</td> <td>' . $row->address . '</td></tr>';
					echo '<tr><td>City</td> <td>:</td> <td>' . $row->city . '</td></tr>';
					echo '<table>';
					echo '';
					echo 'Are you sure want to delete this item?<br><a class="btn btn-danger" href="delete_customer.php?id=' . $id . '">Yes</a>&nbsp;<a class="btn btn-primary" href="view_customer.php">No</a> &nbsp; &nbsp;';
				}
			}
			?>
		</div>
	</div>
<?php include('./footer.html') ?>