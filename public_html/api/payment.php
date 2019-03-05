<?php
#With this file, a mysql query is executed. The data resulting from this query is formatted to JSON.
#This JSON data can be gotten by HTML-files, by for example using jQuery (getJSON).
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		ini_set('max_execution_time', 240);
		ini_set('memory_limit', '1024M'); 
		$link = mysqli_connect("mysql.liacs.leidenuniv.nl", "s2385937", "hig_liacssql_PW", "s2385937"); #enter your mysql usernames and passwords
		$payMethods = array("GameCard", "BankTransfer", "CreditCard", "InstantBankTransfer", "LandlinePhone", "MobilePhoneCall", "MobilePhoneSMS", "Wallet");
		$allTimeFrames = array();
		$fail = 0;
		$fullData = array();
		$table = array();
		$flag = true;
		
		foreach ($payMethods as $payMethod) {
			$payMethodData = array();
			
			// Find all the dates for that specific method Name
			$statement = mysqli_prepare($link, "SELECT YEAR(saleDateTime) as year, QUARTER(saleDateTime) AS quarter, SUM(priceInEUR) FROM sales s WHERE s.methodId IN (SELECT DISTINCT m.methodId FROM methods m WHERE m.methodName LIKE '$payMethod%') GROUP BY YEAR(saleDateTime), QUARTER(saleDateTime) ORDER BY YEAR(saleDateTime), QUARTER(saleDateTime)");
			if(mysqli_stmt_execute($statement)) {
				mysqli_stmt_store_result($statement);
				mysqli_stmt_bind_result($statement, $year, $quarter, $count);
				while(mysqli_stmt_fetch($statement)){
							$timeFrame = "$year/Q$quarter";
							if (!in_array($timeFrame, $allTimeFrames)){
								$allTimeFrames[] = $timeFrame;
							}
							$payMethodData[$timeFrame] = round($count, 2);
						  }
			} else {echo "The SQL subquerie failed\n";}
			$fullData["$payMethod"] = $payMethodData ;
		}

		$table['labels'] = $allTimeFrames;
		foreach ($payMethods as $payMethod){
			$table["nameFor$payMethod"] = $payMethod;
			$amounts = array();
			foreach($allTimeFrames as $timeFrame){
				if (array_key_exists($timeFrame, $fullData[$payMethod])){
					$amounts[] = $fullData[$payMethod][$timeFrame];
				} else{
					$amounts[] = 0;
				}
			}
			$table["amountFor$payMethod"] = $amounts;
		}

		$jsonTable = json_encode($table);
		echo $jsonTable;
?>
