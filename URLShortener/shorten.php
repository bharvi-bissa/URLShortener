<?php 
//Url to shorten
/*$longUrl = 'http://www.facebook.com'; */
@$shortened_url="";
@$longUrl="";
@$url_to_shorten="";
@$longUrl=$_POST['url_to_shorten'];
$apiKey = 'AIzaSyDueADEYpZ3XWHoqFgCOSIhKJUdukr3fZc'; 

 
// *** No need to modify any of the code line below. *** 
if((isset($_POST['url_to_shorten'])))
{

		if(empty($_POST['url_to_shorten']))
		{
			$message = "Field cannot be left empty";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else{
		$postData = array('longUrl' => $longUrl, 'key' => $apiKey);
		$jsonData = json_encode($postData);
		$curlObj = curl_init();
		curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$apiKey);
		curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObj, CURLOPT_HEADER, 0);
		curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		curl_setopt($curlObj, CURLOPT_POST, 1);
		curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
		$response = curl_exec($curlObj);
		$json = json_decode($response);
		 
		curl_close($curlObj);
		//echo 'Shortened URL ->'.$json->id;
		$shortened_url= $json->id;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>URL Shortener</title>
	<link href="https://fonts.googleapis.com/css?family=|Delius+Unicase|Titillium+Web" rel="stylesheet">
</head>
<body>
	<h2>URL Shortener</h2>
	<div class="form_box">

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label>Enter URL :</label> <br>
			<input type="text" name="url_to_shorten" autocomplete="off">
			<button>Submit</button>
		</form>

		<h3>Shortened URL : <a href="<?php echo $shortened_url; ?>" target="_blank"><?php echo $shortened_url; ?></a></h3>
	</div>

	<!--footer-->
	<div class="footer">
		<h5>© Bharvi Bissa. All rights reserved | Designed and Developed by <a href="" style="text-decoration: none;color:#0073e6 ">Bharvi Bissa</a></h5>
	</div>
</body>
</html> 


<style type="text/css">

	h2{
		text-align: center;
		font-family: 'Delius Unicase', cursive;
	}

	button{
		background-color: #0073e6;
		color: #fff;
		border: 2px solid #0073e6; 
		border-radius: 5px;
		font-family: 'Titillium Web', sans-serif;
	}

	button:hover{
		background-color: #fff;
		color: #000;
		border: 1.5px solid #0073e6; 
		border-radius: 5px;
		transition: all 0.5s;
		font-family: 'Titillium Web', sans-serif;
	}

	.form_box{
		background-color: #e0e0d1;
	    border-radius: 5px;
	    text-align: center;
	    width: 50%;
	    height: 200px;
	    padding-top: 6%;
	    margin-left: 26%;
	    font-family: 'Titillium Web', sans-serif;
	}

	.footer{
		text-align: center;
		margin-top: 18%;
		font-family: 'Titillium Web', sans-serif;
	}

	label{
		margin-right: 20%;
	}



</style>