<?php 
	
	require("functions.php");
	
	//MUUTUJAD
	$Username = "";
	$favActor = "";
	$favMov = "";
	//$movGenre = "";
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
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
	
		if(isset($_POST["Username"]) &&
		isset($_POST["favActor"]) &&
		isset($_POST["favMov"]) &&
		isset($_POST["movGenre"]) &&
		!empty($_POST["Username"]) &&
		!empty($_POST["favActor"]) &&
		!empty($_POST["favMov"])
		) {
			
		saveData($_POST["Username"], $_POST["favActor"], $_POST["favMov"], $_POST["movGenre"]);
		
			
		}
			
			//saan filmi andmed
			$saveData = getMovieData();
		
		
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

<?php
	
		$html = "<table>";

		
		$html .= "<tr>";
				$html .="<th>id</th>";
				$html .="<th>username</th>";
				$html .="<th>actor</th>";
				$html .="<th>movie</th>";
				$html .="<th>genre</th>";
		$html .= "</tr>";
		
		foreach($saveData as $i){
			
		$html .= "<tr>";
				$html .= "<td>".$i->id."</td>";
				$html .= "<td>".$i->Username."</td>";
				$html .= "<td>".$i->favActor."</td>";
				$html .= "<td>".$i->favMov."</td>";
				$html .= "<td>".$i->movGenre."</td>";
		$html .= "</tr>";

		}
			
		$html .= "</table>";	
		
	
	
?>