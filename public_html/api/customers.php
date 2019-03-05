<?php
#With this file, a mysql query is executed. The data resulting from this query is formatted to JSON.
#This JSON data can be gotten by HTML-files, by for example using jQuery (getJSON).
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		$link = mysqli_connect("mysql.liacs.leidenuniv.nl", "s2385937", "hig_liacssql_PW", "s2385937"); #enter your mysql usernames and passwords
		$fail = 0;
		$table = array();
		$timeFrames = array();
		$data = array();
		$flag = true;
		
		$statement = mysqli_prepare($link, "SELECT YEAR(saleDateTime) as year, DATE_FORMAT(saleDateTime, '%b') AS month, COUNT(DISTINCT accountName) FROM sales s GROUP BY YEAR(saleDateTime), MONTH(saleDateTime) ORDER BY YEAR(saleDateTime), MONTH(saleDateTime)");
			if(mysqli_stmt_execute($statement)) {
				mysqli_stmt_store_result($statement);
				mysqli_stmt_bind_result($statement, $year, $month, $customers);
				while(mysqli_stmt_fetch($statement)){
							$timeFrames[] = "$month $year";
							$data[] = $customers;
						  }
			} else {echo "The SQL subquerie failed\n";}

		$table['labels'] = $timeFrames;
		$table['data'] = $data;
		$jsonTable = json_encode($table);
		echo $jsonTable;
?>
