<?php 
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	session_start();
	if( $_SESSION['login'] != '1' ){
		header('Location:http://www.bule007.cn', true);
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>insert message</title>
</head>
<body>
	bike number:<input id="bikeNumber" type="text" placeholder="bike number">
	<br>
	password:<input id="password" type="text" placeholder="password">
	<br>
	<input type="button" value="submit" onclick="if_repeat()">
	<br>
	<div id="verify" style="display: none;">
		bikeNumber has existed, do you want to update?
		<br>
		bike number : <span id="verifyBikeNumber"></span>
		<br>
		password: <span id="verifyPassword"></span>
		<br>
		<input type="button" value="certain submit" onclick="submit()">
		<input type="button" value="cancel" onclick="cancel()">
	</div>
	You can submit the bike number and the homologous password. 
	<br>
	And if the bike number you submit has existed, then the password will be updated to the new one, so when submit, Be Careful!!
</body>
</html>
<script>
	function if_repeat(){
		var xhr = new XMLHttpRequest();
		xhr.open( 'POST', 'ifrepeatPHP.php', true );
		xhr.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
		xhr.onreadystatechange = function(){
			if( xhr.readyState == 4 && xhr.status == 200){
				var response = xhr.responseText
				console.log(response)
				if( response == 1 ){
					verify()
				}
				if( response == 2 ){
					submit()
				}
				if( response != 1 && response !=2 ){
					alert(response)
				}
			}
		}
		var bikeNumber = document.getElementById('bikeNumber').value
		xhr.send('bikeNumber='+bikeNumber)
	}
	function verify(){
		document.getElementById('verify').style.display = 'block'
		var bikeNumber = document.getElementById('bikeNumber').value
		var password = document.getElementById('password').value
		document.getElementById('verifyBikeNumber').innerHTML = bikeNumber
		document.getElementById('verifyPassword').innerHTML = password
	}
	function cancel(){
		document.getElementById('verify').style.display = 'none'
	}
	function submit(){
		var bikeNumber = document.getElementById('bikeNumber').value
		var password = document.getElementById('password').value
		var xhr = new XMLHttpRequest();
		xhr.open( 'POST', 'informationPHP.php', true );
		xhr.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
		xhr.onreadystatechange = function(){
			if( xhr.readyState == 4 && xhr.status == 200){
				var response = xhr.responseText
				if( response == 1 ){
					alert('submit success!')
				}
				if( response == 2 ){
					alert('update password success!')
				}
				if( response != 1 && response != 2 ){
					alert(response)
				}
			}
		}
		xhr.send('bikeNumber='+bikeNumber+'&password='+password)
	}
</script>