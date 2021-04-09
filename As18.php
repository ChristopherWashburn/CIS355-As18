<?php

main();

function main () {
	
	$apiCall = 'https://api.covid19api.com/summary';
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);
	
	$arr1 = Array();
	$arr2 = Array();
	
	foreach($obj->Countries as $i)
	{
		array_push($arr1, $i->Country );
		array_push($arr2, $i->TotalDeaths );
	}
	
	array_multisort($arr2, SORT_DESC, $arr1);
	
?>
	<html>
		<head>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<h1>Country Death rates in Descending Order</h1><br/>
			<a target='_blank' href='https://github.com/ChristopherWashburn/CIS355-As18'>GitHub Repo</a>
		</head>
		<body>
			<table class = "table table-striped" style="width:50%;">
				<thead class="thead-dark">
					<tr>
						<th>Country</th>
						<th>Total Deaths</th>
					</tr>
				</thead>
				<?php
					for($i = 0; $i < 10; $i++)
					{
						echo "<tr><td>" . $arr1[$i]. "</td><td>" . $arr2[$i] ."</td></tr>";
					}
				?>
			</table>
		</body>
	</html>

<?php	
}

function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>
