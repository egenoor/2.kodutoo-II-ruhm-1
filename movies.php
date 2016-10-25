<?php 
	
	require("functions.php");
	
	//MUUTUJAD
	$Username = "";
	$favActor = "";
	$favMov = "";
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login v�lja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui �he n�itame siis kustuta �ra, et p�rast refreshi ei n�itaks
		unset($_SESSION["message"]);
	}
		 
	if ( isset ( $_POST["Username"] ) ) {
		
		if (!empty ( $_POST["Username"] ) ) {
			
			
			$Username = $_POST["Username"];
			
		}
		
	}
	
		if ( isset ( $_POST["favActor"] ) ) {
		
		if (!empty ( $_POST["Username"] ) ) {
			
			
			$favActor = $_POST["favActor"];
			
		}
		
	}
	
		if ( isset ( $_POST["favMov"] ) ) {
		
		if (!empty ( $_POST["favMov"] ) ) {
			
			
			$favMov = $_POST["favMov"];
			
		}
		
	}
	
		if ( isset ( $_POST["movGenre"] ) ) {
		
		if (!empty ( $_POST["movGenre"] ) ) {
			
			
			$movGenre = $_POST["movGenre"];
			
		}
		
	}
			
			//salvestan andmebaasi			
		saveData($Username, $favActor, $favMov, $movGenre);
			
		
		
		
?>
	
	

<!DOCTYPE html>
<html>
	<body>
		<p><a href="data.php"> <button onclick="goBack()">Go Back</button></a></p> 
		<h1>Movies</h1>
		<?=$msg;?>
			<p>
			Welcome <?=$_SESSION["userEmail"];?>!
			<a href="?logout=1">Log out</a>
			</p>

		<h2> Add data </h2>
		
			<form method="POST">
		
				<label>Username:</label><br>
				<input name="Username" type="text" value="<?=$Username;?>">
			
				<br><br>
				
				<label>Favorite actor:</label><br>
				<input name="favActor" type="text" value="<?=$favActor;?>">
				
				<br><br>
				
				<label>Favorite movie:</label><br>
				<input name="favMov" type="text" value="<?=$favMov;?>">
				
				<br><br>
				
				<label>Movie genre:</label><br>
					<select name="movGenre">
						<option value="Action" <?php echo $result['genre'] == 'Action' ? 'selected' : ''?> >Action</option>
						<option value="Comedy" <?php echo $result['genre'] == 'Comedy' ? 'selected' : ''?>>Comedy</option>
						<option value="Crime" <?php echo $result['genre'] == 'Crime' ? 'selected' : ''?>>Crime</option>
						<option value="Adventure" <?php echo $result['genre'] == 'Adventure' ? 'selected' : ''?> >Adventure</option>
						<option value="War" <?php echo $result['genre'] == 'War' ? 'selected' : ''?>>War</option>
						<option value="Sci-Fi" <?php echo $result['genre'] == 'Sci-Fi' ? 'selected' : ''?>>Sci-Fi</option>
						<option value="Romance" <?php echo $result['genre'] == 'Romance' ? 'selected' : ''?>>Romance</option>
						<option value="Horror" <?php echo $result['genre'] == 'Horror' ? 'selected' : ''?> >Horror</option>
						<option value="Documentary" <?php echo $result['genre'] == 'Documentary' ? 'selected' : ''?>>Documentary</option>
						</select>
					
				<input type="submit" value="Submit">
				
			
		</form>
	</body>
</html>