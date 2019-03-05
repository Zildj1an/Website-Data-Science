<?php
#With this file, a mysql query is executed. The data resulting from this query is formatted to JSON.

		error_reporting(E_ALL);
		$countries = array();
		$failed = 0;
		$min = 0;
		$max = 0;
		$table = array();
		$data = array();
		$link      = mysqli_connect("mysql.liacs.leidenuniv.nl", "s2385937", "hig_liacssql_PW", "s2385937"); #enter your mysql usernames and passwords
		$statement = mysqli_prepare($link, "SELECT ipCountry, name, COUNT(DISTINCT accountName) as count FROM sales a JOIN countries b ON a.ipCountry = b.id COLLATE utf8_general_ci GROUP BY ipCountry ORDER BY count DESC");
		if(mysqli_stmt_execute($statement)){
                                mysqli_stmt_store_result($statement);
                                mysqli_stmt_bind_result($statement, $countryCode, $countryName, $count);
                } else {
                                echo "The SQL Query has failed\n";
                                $failed = 1;
                }

                while($failed == 0 and mysqli_stmt_fetch($statement)) {
					if ($count < $min  || $min == 0){
						$min = $count;
					}
					if ($count > $max){
						$max = $count;
					}
					$countryInfo = array();
					$countryInfo["name"] = $countryName;
					$countryInfo["value"] = $count;
					$data[] = $countryInfo;
				}
		$table['label'] = "Distinct customers for countries";
		$table['max']   = $max;
		$table['min']   = $min;
		$table['data']  = $data;
		$jsonTable = json_encode($table);
		echo $jsonTable;
?>
