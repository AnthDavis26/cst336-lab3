<!DOCTYPE html>
<html>
	<head>
		<title> Sign Up Page </title>
	</head>
	<body>
	
		<h1> Sign Up </h1>
		
			First Name:	<input type="text" name="fName"><br />
			Last Name:	<input type="text" name="lName"><br />
			Gender: 	<input type="radio" name="gender" value="m"> Male
						<input type="radio" name="gender" value="f"> Female <br /><br />
			
			Zip Code: 	<input type="text" name="zip" id="zip"><br />
			City:		<span id="city"></span><br />
			Latitude: 	<br />
			Longitude: 	<br /><br />
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
			
	</body>
</html>