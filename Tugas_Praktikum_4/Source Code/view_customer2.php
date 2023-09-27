<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">Customers Data 2</div>
                <div class="card-body">
                    <br>
                    <a class="btn btn-primary" href="add_customer.php">+ Add Customer Data</a><br /><br />
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>

                        <?php
                            // include our login information
                            require_once('db_login.php');

                            // execute the query
                            // yang berbeda dengan sebelumnya yaitu pada view_customer untuk nama panggilan label pada fetch object harus sama dengan di database
                            // tetapi kalau view_customer2 pada pemanggilan querynya dirubah untuk tiap label sesuai dengan keinginan masing masing seperti dibawah
                            // dan pada fetch object menyesuaikan dengan pemanggilan query yang telah diubah
                            $query = " SELECT customerid AS ID, name AS Nama, address AS Alamat, city AS Kota FROM customers ORDER BY customerid ";
                            $result = $db->query($query);
                            if (!$result) {
                                die("Could not the query the database: <br />" . $db->error . "<br>Query: " . $query);
                            }

                            // fetch and display the results
                            $i = 1;
                            while ($row = $result->fetch_object()) {
                                echo '<tr>';
                                echo '<td>' . $i . '</td>';
                                echo '<td>' . $row->Nama . '</td>';
                                echo '<td>' . $row->Alamat . '</td>';
                                echo '<td>' . $row->Kota . '</td>';
                                echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id=' . $row->ID . '">Edit</a>&nbsp;&nbsp;
                                            <a class="btn btn-danger btn-sm" href="confirm_delete_customer.php?id=' . $row->ID . '">Delete</a>
                                            </td>';
                                echo '</tr>';
                                $i++;
                            }
                            echo '</table>';
                            echo '<br />';
                            echo 'Total Rows = ' . $result->num_rows;
                            $result->free();
                            $db->close();
                        ?>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </body>
</html>