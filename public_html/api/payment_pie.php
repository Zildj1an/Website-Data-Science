<?php
#With this file, a mysql query is executed. The data resulting from this query is formatted to JSON.

		$failed  = 0;
		$count   = 0;
		$data    = array();
		$methods = array("GameCard", "BankTransfer", "CreditCard", "InstantBankTransfer", "LandlinePhone", "MobilePhoneCall", "MobilePhoneSMS", "Wallet");
		$link    = mysqli_connect("mysql.liacs.leidenuniv.nl", "s2385937", "hig_liacssql_PW", "s2385937"); #enter your mysql usernames and passwords

		for($x = 0; $x < sizeof($methods) ; $x++){
			$method = $methods[$x];
			$statement = mysqli_prepare($link, "SELECT COUNT(*) FROM methods m NATURAL JOIN sales s WHERE m.methodName LIKE '$method%' ");

			if(mysqli_stmt_execute($statement)){
	                        mysqli_stmt_store_result($statement);
        	                mysqli_stmt_bind_result($statement, $theCount);
                	} else {
                        	echo "The SQL Query has failed\n";
                        	$failed = 1;
                	}

			if($failed == 0 and mysqli_stmt_fetch($statement)) {
                	        $count = $theCount;
		        }

			$data[$x]["value"] = $count;
			$data[$x]["name"] = $method;
		}

		$table = array();
		$flag = true;

		$table['labels'] = $methods;
		$table['data'] = $data;

		$jsonTable = json_encode($table);
		echo $jsonTable;
?>

