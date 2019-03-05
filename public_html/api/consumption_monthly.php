<?php
#With this file, a mysql query is executed. The data resulting from this query is formatted to JSON.
#This JSON data can be gotten by HTML-files, by for example using jQuery (getJSON).
		error_reporting(E_ALL);
		$link = mysqli_connect("mysql.liacs.leidenuniv.nl", "s2385937", "hig_liacssql_PW", "s2385937"); #enter your mysql usernames and passwords
		$statement = mysqli_prepare($link, "SELECT DATE_FORMAT(saleDateTime, '%b'), COUNT(SaleId) FROM sales GROUP BY MONTH(saleDateTime) ASC");
		$fail = 0;

		if(mysqli_stmt_execute($statement)){
			mysqli_stmt_store_result($statement);
			mysqli_stmt_bind_result($statement, $day, $count);
		}
		else {
			echo "The SQL Query has failed!\n";
			$fail = 1;
		}

		$table = array();
		$labels = array();
		$data = array();
		$flag = true;

		while($fail == 0 and mysqli_stmt_fetch($statement)) {
			$labels[] = $day;
			$data[] = $count;
		}

		$table['labels'] = $labels;
		$table['data'] = $data;
		$jsonTable = json_encode($table);
		echo $jsonTable;
?>
