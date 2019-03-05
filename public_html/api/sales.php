<?php
#With this file, a mysql query is executed. The data resulting from this query is formatted to JSON.
		error_reporting(E_ALL);
		$failed = 0;
		$link = mysqli_connect("mysql.liacs.leidenuniv.nl", "s2385937", "hig_liacssql_PW", "s2385937"); #enter your mysql usernames and passwords
		$statement = mysqli_prepare($link, "SELECT YEAR(saleDateTime) as year, DATE_FORMAT(saleDateTime, '%b') AS month, SUM(priceInEUR), SUM(coins), COUNT(SaleId), COUNT(DISTINCT accountName) FROM sales GROUP BY YEAR(saleDateTime), MONTH(saleDateTime) ORDER BY YEAR(saleDateTime), MONTH(saleDateTime)");

		if(mysqli_stmt_execute($statement)){
			mysqli_stmt_store_result($statement);
			mysqli_stmt_bind_result($statement, $year, $month, $themoney, $thecoins, $thecount, $thecustomers);
		} else {
			echo "The SQL Query has failed\n";
			$failed = 1;
		}

		$table = array();
		$dates = array();
		$money = array();
		$coins = array();
		$count = array();
		$timeFrames = array();
		$totalCoins = 0;
		$totalMoney = 0;
		$totalTransactions = 0;
		$avgCoins = 0;
		$avgMoney = 0;
		$avgTransactions = 0;
		$flag = true;

		while($failed == 0 and mysqli_stmt_fetch($statement)) {
			$timeFrames[] = "$month $year";
			$money[] = round($themoney, 2);
			$coins[] = $thecoins;
			$count[] = $thecount;
			$totalCoins += $thecoins;
			$totalMoney += $themoney;
			$totalTransactions += $thecount;
			$avgCoins += $thecoins / $thecustomers;
			$avgMoney += $themoney / $thecustomers;
			$avgTransactions += $thecount / $thecustomers;
		}

		$table['labels'] = $timeFrames;
		$table['money'] = $money;
		$table['coins'] = $coins;
		$table['count'] = $count;
		$table['totalCoins'] = number_format($totalCoins);
		$table['totalMoney'] = number_format($totalMoney, 2);
		$table['totalTransactions'] = number_format($totalTransactions);
		$table['avgMoney'] = number_format($avgMoney / sizeof($timeFrames), 2);
		$table['avgCoins'] = number_format($avgCoins / sizeof($timeFrames));
		$table['avgTransactions'] = number_format($avgTransactions / sizeof($timeFrames),1);
		$jsonTable = json_encode($table);
		echo $jsonTable;
?>

