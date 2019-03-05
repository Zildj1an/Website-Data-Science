<?php
#With this file, a mysql query is executed. The data resulting from this query is formatted to JSON.
#This JSON data can be gotten by HTML-files, by for example using jQuery (getJSON).
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		date_default_timezone_set("UTC");
		$link = mysqli_connect("mysql.liacs.leidenuniv.nl", "s2385937", "hig_liacssql_PW", "s2385937"); #enter your mysql usernames and passwords
		$fail = 0;
		$table = array();
		$totalTransactions = 0;
		$totalSpentMoney = 0;
		$totalLifespanInDays = 0;
		$totalUsers = 0;
		$flag = true;
		
		$statement = mysqli_prepare($link, "SELECT accountName, COUNT(saleId), SUM(priceInEUR) as spentMoney, MIN(saleDateTime), MAX(saleDateTime) FROM sales s GROUP BY accountName ORDER BY spentMoney DESC");
			if(mysqli_stmt_execute($statement)) {
				mysqli_stmt_store_result($statement);
				mysqli_stmt_bind_result($statement, $account, $count, $spentMoney, $minDate, $maxDate);
				while(mysqli_stmt_fetch($statement)){
							$totalUsers++;
							$totalTransactions += $count;
							$totalSpentMoney += $spentMoney;
							$lifespanSeconds = strtotime($maxDate) - strtotime($minDate);
							$lifespanDays = $lifespanSeconds / 86400;
							$totalLifespanInDays += $lifespanDays;
						  }
			} else {echo "The SQL subquerie failed\n";}

		$table['avgTransactions'] = number_format($totalTransactions / $totalUsers, 1);
		$table['avgSpentMoney'] = number_format($totalSpentMoney / $totalUsers, 2);
		$table['avgLifespan'] = number_format($totalLifespanInDays / $totalUsers, 1);
		$table['totalCustomers'] = number_format($totalUsers, 0);
		
		$jsonTable = json_encode($table);
		echo $jsonTable;
?>
