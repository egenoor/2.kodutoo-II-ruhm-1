<?php
	
	require("functions.php");
	
	//kui kasutaja on juba sisse logitud siis 
	//suunan data lehele
	
		if (isset($_SESSION["userId"])) {
		
		//suunan sisselogimise lehele
		header("Location: data.php");
		exit();
	}
	
	 echo "<body style='background-color:lightblue'>";
	//<?php echo $m;? >
	//<?=$m;? >



	
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	//MUUTUJAD	
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupCommentError = "";
	$signupComment = "";
	$signupEmail = "";
	$signupGender = "";
	$signupWebsite = "";
	$signupAge = "";
	
	// kas e/post oli olemas
	if ( isset ( $_POST["signupEmail"] ) ) {
		
		if ( empty ( $_POST["signupEmail"] ) ) {
			
			// oli email, kuid see oli tühi
			$signupEmailError = "See väli on kohustuslik!";
			
		} else {
			
			//email olemas
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	}
	
	
	if ( isset ( $_POST["signupPassword"] ) ) {
		
		if ( empty ( $_POST["signupPassword"] ) ) {
			
			// oli password, kuid see oli tühi
			$signupPasswordError = "See väli on kohustuslik!";
			
		} else {
			
			// tean et parool on ja see ei olnud tühi
			// VÄHEMALT 8
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
				
			}
			
		}
		
		
	}
	
	if (isset ( $_POST["signupComment"] ) ) {
		
		if ( empty ( $_POST["signupComment"] ) ) {
			
			//kommentaar oli tühi
			$signupCommentError = "See väli on kohustuslik!" ;
		} else {
			
			$signupComment = $_POST["signupComment"];
		}
	
	}
	
	if ( isset ( $_POST["signupAge"] ) ) {
		
		if ( empty ( $_POST["signupAge"] ) ) {
			
		} else {
			
			$signupAge = $_POST["signupAge"];
			
		}
		
	}
	
	if ( isset ( $_POST["signupGender"] ) ) {
		
		if (!empty ( $_POST["signupGender"] ) ) {
			
			
			$signupGender = $_POST["signupGender"];
			
		}
		
	}
	
	if ( isset ( $_POST["signupWebsite"] ) ) {
		
		if (!empty ( $_POST["signupWebsite"] ) ) {
			
			
			$signupWebsite = $_POST["signupWebsite"];
			
		}
		
	}
	
	
	
	//peab olema email ja parool
	//ja ühtegi errorit
	
	if ( isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"]) &&
		isset($_POST["signupWebsite"]) &&
		isset($_POST["signupComment"]) &&
		isset($_POST["signupAge"]) &&
		$signupEmailError == "" &&
	     empty ($signupPasswordError)

		 
		 ) {
		 
		 //salvestame ab'i
		 echo "Salvestan...<br>";
		 
		 echo "email: ".$signupEmail."<br>";
		 echo "password: ".$_POST["signupPassword"]."<br>";
		 
		 $password = hash("sha512", $_POST["signupPassword"]);
		 
		 echo "password hashed: ".$password."<br>";		 
		 echo "website: ".$signupWebsite."<br>";		 
		 echo "comment: ".$signupComment."<br>";	 
		 echo "age: ".$signupAge."<br>";
		 
		 
		 //echo $serverUsername;
		 
		 //KASUTAN FUNKTSIOONI
		 $signupEmail = cleanInput($signupEmail);
		 $signupWebsite = cleanInput($signupWebsite);
		 
		 signUp($signupEmail, cleanInput($password), $signupWebsite, $signupComment, $signupAge);
		
		
		
	}
	
	$error ="";
	if (isset($_POST["loginEmail"]) && 
	isset($_POST["loginPassword"]) &&
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
		) {
			
			$error = login(cleanInput($_POST["loginEmail"]), cleanInput($_POST["loginPassword"]));
			
			
			
		}
	
	
	
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehekülg</title>
	</head>
	<body>

		<h1>Log in</h1>
		
		<form method="POST">
			
			 <p style="color:red;"><?=$error;?></p>
			
			<label>Email</label><br>
			<input name="loginEmail" type="text"> 
			
			<br><br>
			
			<input name="loginPassword" type="password" placeholder="Password">
			
			<br><br>
			
			<input type="submit" value="Log in">
			
		</form>
		
		<h1>Create account</h1>
		
		<form method="POST">
			
			<label>Email</label><br>
			<input name="signupEmail" type="text" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input name="signupPassword" type="password" placeholder="Password"> <?php echo $signupPasswordError; ?>
			
			<br><br>
			
			<label>Website</label><br>
			<input name="signupWebsite" type="text" value="<?=$signupWebsite;?>">
			
			<br><br>
			
			<label>Comment</label><br>
			<textarea name="signupComment" rows="5" cols="40"><?=$signupComment;?></textarea> <?php echo $signupCommentError; ?>
			
			<br><br>
			
			<label>Age</label><br>
			<input name="signupAge" type="age" value="<?=$signupAge;?>">
			
			<br><br>
			<label>Gender</label><br>
			
			<?php if($signupGender == "male") { ?>
			<input type="radio" name="signupGender" value="male" checked> Man<br>
			<?php }else { ?>
			
			<input type="radio" name="signupGender" value="male"> Man<br>
			<?php } ?>
		
			<?php if($signupGender == "female") { ?>
			<input type="radio" name="signupGender" value="female" checked> Female<br>
			<?php }else { ?>
			<input type="radio" name="signupGender" value="female"> Female<br>
			<?php } ?>
			
			
			<br><br>
			
			<input type="submit" value="Create account">
			
		</form>
		
		
	</body>
</html>