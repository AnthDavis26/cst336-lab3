<!DOCTYPE html>
<html>
	<head>
		<title> Sign Up Page </title>
		<link  href="css/styles.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
	
		<h1> Sign Up </h1>
		<form id="signupForm" method="post" action="welcome.php">
			First Name:	<input type="text" name="fName"><br />
			Last Name:	<input type="text" name="lName"><br />
			Gender: 	<input type="radio" name="gender" value="m"> Male
						<input type="radio" name="gender" value="f"> Female <br /><br />
			
			Zip Code: 	<input type="text" name="zip" id="zip"><br />
						<span id="errorZip"></span><br />
			City:		<span id="city"></span><br />
			Latitude: 	<span id="latitude"></span><br />
			Longitude: 	<span id="longitude"></span><br /><br />
			State:
			<select id="state" name="state">
				<option value="">Select One</option>
			</select><br />
			
			Select a County: <select id="county"></select><br /><br />
			
			Desired Username:<input type="text"		id="username"	name="username"></br />
							 <span id="usernameError"></span><br />
			Password: 		 <input type="password"	id="password"	name="password"></br />
			Password Again:  <input type="password"	id="passwordAgain"></br />
							 <span id="passwordAgainError"></span><br /><br />
			
			<input type="submit" value="Sign up!">
		</form>
		
		<script>
			
			// Variables
			var usernameAvailable = false;
			var validZipCode = false;
			
			
			window.onload = function () {
				
				// Populate states list upon page load
				$.ajax ({
					method: "GET",
					url: "https://cst336.herokuapp.com/projects/api/state_abbrAPI.php",
					dataType: "json",
					
					success: function(result, status) {
						
						for (let i=0; i < result.length; i++){
							$("#state").append("<option value='" + result[i].usps + "'>" + result[i].state + "</option>");
						}
					}
				});
			};
			
		
			// Displaying City from API after typing a zip code
			$("#zip").on("change",function(){
				//alert($("#zip").val());
				
				$.ajax({
					method: "GET",
					url: "https://cst336.herokuapp.com/projects/api/cityInfoAPI.php",
					dataType: "json",
					data: { "zip" : $("#zip").val() },

					success: function(result,status) {
						//alert(result.city);
						
						if (result.zip != null){
							$("#errorZip").empty();
							$("#city").html(result.city);
							$("#latitude").html(result.latitude);
							$("#longitude").html(result.longitude);
							validZipCode = true;
						}
						else {
							//alert("test invalid zip code");
							$("#city").empty();
							$("#latitude").empty();
							$("#longitude").empty();
							$("#errorZip").html("Invalid zip code.");
							$("#errorZip").css("color", "red");
							validZipCode = false;
						}
					}
				}); // ajax
				
			}); // zip
			
			
			// STATE
			$("#state").on("change",function(){
				//alert($("#state").val());
				
				$.ajax({
					method: "GET",
					url: "https://cst336.herokuapp.com/projects/api/countyListAPI.php",
					dataType: "json",
					data: { "state" : $("#state").val() },

					success: function(result,status) {
						$("#county").html("<option> Select One </option>");
						for (let i=0; i < result.length; i++){
							$("#county").append("<option>" + result[i].county + "</option>");
						}
					}
				}); // ajax
			}); // state
			
			
			// USERNAME
			$("#username").change(function() {
				//alert($("#username").val());
				
				$.ajax({
					method: "GET",
					url: "https://cst336.herokuapp.com/projects/api/usernamesAPI.php",
					dataType: "json",
					data: { "username" : $("#username").val() },
					success: function(result, status) {
						
						if (result.available){
							usernameAvailable = true;
							$("#usernameError").html("Username is available!");
							$("#usernameError").css("color", "green");
						}
						else {
							usernameAvailable = false;
							$("#usernameError").html("Username unavailable");
							$("#usernameError").css("color", "red");
						}
					}
					
				}); // ajax
			}); // username
			
			
			// Check the form for errors upon submission
			$("#signupForm").on("submit", function() {
				//alert("Submitting form...");
				
				if (!isFormValid()){
					event.preventDefault();
				}
			});
			
			function isFormValid() {
				var isValid = true;
				
				if (!usernameAvailable){
					isValid = false;
				}
				
				if ($("#username").val().length == 0) {
					$("#usernameError").html("Username is required");
					$("#usernameError").css("color", "red");
					isValid = false;
				}
				
				if ($("#password").val() != $("#passwordAgain").val()){
					$("#passwordAgainError").html("Passwords do not match.");
					isValid = false;
				}
				
				if ($("#password").val().length < 6) {
					$("#passwordAgainError").html("Your password must contain at least 6 characters.");
					isValid = false;
				}
				
				if (!validZipCode){
					//alert("test");
					isValid = false;
				}
				
				return isValid;
			}
			
			
			
		</script>
	</body>
</html>