<!DOCTYPE html>
<html>
	<head>
		<title> Sign Up Page </title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
	
		<h1> Sign Up </h1>
		
			First Name:	<input type="text" name="fName"><br />
			Last Name:	<input type="text" name="lName"><br />
			Gender: 	<input type="radio" name="gender" value="m"> Male
						<input type="radio" name="gender" value="f"> Female <br /><br />
			
			Zip Code: 	<input type="text" name="zip" id="zip"><br />
			City:		<span id="city"></span><br />
			Latitude: 	<span id="latitude"></span><br />
			Longitude: 	<span id="longitude"></span><br /><br />
			State:
			<select id="state" name="state">
				<option value="">Select One</option>
				<option value="ca">California</option>
				<option value="ny">New York</option>
				<option value="tx">Texas</option>
			</select><br />
			
			Select a County: <select id="county"></select><br /><br />
			
			Desired Username:<input type="text"		id="username"	name="username"></br />
			Password: 		 <input type="password"	id="password"	name="password"></br />
			Password Again:  <input type="password"	id="passwordAgain"></br />
			
			<input type="submit" value="Sign up!">
			
			<script>
				// Displaying City from API after typing a zip code
				$("#zip").on("change",function(){
					//alert($("#zip").val());
				
					$.ajax({
						method: "GET",
						url: "https://cst336.herokuapp.com/projects/api/cityInfoAPI.php",
						dataType: "json",
						data: { "zip" : $("#zip").val() },

						success: function(result,status) {
							alert(result);
						}
					}); //ajax
					
			</script>
	</body>
</html>