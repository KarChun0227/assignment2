<html>
	<head>
		<title>XSS get data</title>
	</head>
	<body>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
			Enter City:
			<input type="text" name="place"><br>
			<input type ="submit">
			</p>
		</form>
		<?php
      if(isset($_POST['place']))
      {
      try
      {
          $data_source_name = 'mysql:host=localhost;dbname=population';
          $username = 'root';
          $password = 'toor';
          
          $conn = new PDO($data_source_name, $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
          $query = "SELECT * FROM population WHERE place = '".$_POST['place']."'";
 
          $result = $conn->query($query);
       
          echo '<table border=1 cellpadding=1 cellspacing=1>';
          echo '<tr><td><b>Place</b></td><td><b>Population</b></td></tr>';
          foreach($result as $row) 
          {
              $place = $row[0];
              $population = $row[1];
              echo '<tr><td>'.$place.'</td><td>'.$population.'</td></tr>';
          }   
          echo '</table>';
      }
      catch(PDOException $e) 
      {
          echo 'ERROR: ' . $e->getMessage();
      }
      
      $conn = null;
      
      }  // end if
      ?>
	</body>
</html>