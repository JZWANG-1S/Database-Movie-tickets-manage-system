<html>
	<head>
		<title>
		Check tickets
		</title>
	</head>
	<body>
	<a href='home_admin.php'><img width="50" height="50" src="home.jpg"></a><br>

		<?php
		session_start();
		if ($_SESSION['log_in']==0) {
			$_SESSION['log_in'] = 0;
			header('Location: login_admin.php');
		}
			$cinema = $_POST["cinema_name"];
			$Date = $_POST["Date"];
			$time = $_POST["period"];
			
			// Generate sql
			$sql = "select ticket.id, customer_id from ticket, date where cinema_id=$cinema and time_id=$time and ticket.date_id=date.id and date.date='".$Date."'";

			// Create connection
			$servername = "localhost";
			$username = "root";
			$password = "mysql";
			$database = "project";
			$conn = new mysqli($servername, $username, $password, $database);

			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";
         
			// Run sql
			$result = $conn->query($sql);
			
			if ($result)
			{
				echo "Tickets for this movie:";
				echo "<table border=1px>";
				while($row = $result->fetch_assoc())
				{
					echo "<tr>";
					foreach($row as $key=>$value)
					{
						echo "<td>$value</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}
			echo "<br>";
			
			// Close connection
			mysqli_close($conn);
		?>
	</body>
</html>