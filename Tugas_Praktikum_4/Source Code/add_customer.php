<?php
// File        : add_customer.php
// Deskripsi   : menampilkan form add data customer dan mengupdate data ke database

   require_once('./db_login.php');

   session_start(); //inisialisasi session
   if (!isset($_SESSION['username'])) {
      header('Location: login.php');
   }
   //mengecek apakah user sudah menekan tombol submit
   if (isset($_POST['submit'])) {
      $valid = TRUE; //flag validasi
      $name = test_input($_POST['name']);
      if ($name == '') {
         $error_name = "Name is required!";
         $valid = FALSE;
      } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
         $error_name = "Only letters and white space allowed!";
         $valid = FALSE;
      }

      $address = test_input($_POST['address']);
      if ($address == '') {
         $error_address = "Address is required!";
         $valid = FALSE;
      }

      $city = $_POST['city'];
      if ($city == '' || $city == "none") {
         $error_city = "City is required!";
         $valid = FALSE;
      }

      if ($valid) {
         $address = $db->real_escape_string($address);
         $query = "INSERT INTO customers (name, address, city) VALUES(\"" . $name . "\", \"" . $address . "\", \"" . $city . "\")";

         $result = $db->query($query);
         if (!$result) {
            die("Could not query the database: <br />" . $db->error . "<br>Query:" . $query);
         } else {
            $db->close();
            header('Location: view_customer.php');
         }
      }
   }
?>

<?php include('./header.html'); ?>
   <br>
   <div class="card">
      <div class="card-header">Add Customer Data</div>
         <div class="card-body">
            <form method="POST" autocomplete="on" action="">
               <div class="form-group">
                  <label for="name">Nama:</label>
                  <input type="text" class="form-control" name="name" id="name" value="<?php if (isset($name)) echo $name; ?>">
                  <div class="error"><?php if (isset($error_name)) echo $error_name; ?></div>
               </div>
               <div class="form-group">
                  <label for="address">Address:</label>
                  <textarea class="form-control" name="address" id="address" rows="5"><?php if (isset($address)) echo $address; ?></textarea>
                  <div class="error"><?php if (isset($error_address)) echo $error_address; ?></div>
               </div>
               <div class="form-group">
                  <label for="city">City:</label>
                  <select class="form-control" name="city" id="city" required>
                     <option value="none" <?php if (!isset($city)) echo 'selected="true"'; ?> disabled>--Select a city--</option>
                     <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected="true"'; ?>>Airport West</option>
                     <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected="true"'; ?>>Box Hill</option>
                     <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected="true"'; ?>>Yarraville</option>
                  </select>
                  <div class="error"><?php if (isset($error_city)) echo $error_city; ?></div>
               </div>
               <br />
               <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
               <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
            </form>
         </div>
   </div>
<?php include('./footer.html'); $db->close(); ?>