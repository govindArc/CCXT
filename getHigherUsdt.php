<?php
include 'ccxt.php';
 
/*top spreads*/
//BTC/USD
//$poloniexObj   	= new \ccxt\poloniex();  not free
//$biboxObj   	= new \ccxt\bibox();   not free
$kucoinObj   	= new \ccxt\kucoin();   // BTC/USDT
$zbObj   		= new \ccxt\zb();           // BTC/USDTx
$gateioObj   	= new \ccxt\gateio();   // BTC/USDT  
$tidexObj   	= new \ccxt\tidex();    // BTC/USDT  
$cryptopiaObj 	= new \ccxt\cryptopia();  // BTC/USDT  
$exmoObj   		= new \ccxt\exmo();    		// BTC/USDT  
$bittrexObj  	= new \ccxt\bittrex(); 	// BTC/USDT  

	//if($_POST){
			$pair	 = "BTC/USDT";
			$html 	 = "";
			$allPiceArray = array();	
			for($i=0;$i<7;$i++){

					$content = "";
					
					if($i==0){
						$Tickers 		= $kucoinObj->fetch_ticker($pair);	
						$currencySymbol = "kucoin";
					}else if($i==1){

						$Tickers 		= $zbObj->fetch_ticker($pair);	
						$currencySymbol = "zb";	

					}else if($i==2){

						$Tickers 		= $gateioObj->fetch_ticker($pair);	
						$currencySymbol = "gateio";	

					}else if($i==3){
						$Tickers 		= $tidexObj->fetch_ticker($pair);	
						$currencySymbol = "tidex";	

					}else if($i==4){
						$Tickers 		= $cryptopiaObj->fetch_ticker($pair);	
						$currencySymbol = "cryptopia";	

					}else if($i==5){
					//	$Tickers 		= $exmoObj->fetch_ticker($pair);	
						$Tickers 		= $cryptopiaObj->fetch_ticker($pair);	
						$currencySymbol = "exmo";
					}else{

						$Tickers 		= $bittrexObj->fetch_ticker($pair);	
						$currencySymbol = "bittrex";
					}


					$askRate 	= number_format($Tickers['ask'], 10, '.', '');
					$lastRate	= number_format($Tickers['last'], 10, '.', '');
					$fineArray 	=	 [$currencySymbol,$askRate,$lastRate];


					array_push($allPiceArray, $fineArray);

					$content = "<tr>
				            		<td>".$currencySymbol."</td>
				            		<td>".$lastRate."</td>
				       			</tr>";

					$html = $html.$content;
			}

					

					$cnt = 0;

					$higherExchange = 0;
					$lowerExchange  = 999999999999;
					$higherCurrency = '';
					$lowerCurrency  = '';
					$highBidAsk 	= 0; 
					$highAskExchange = '';


					foreach ($allPiceArray as $result) {
							$currency = $result[0];
							$ask 	  = $result[1];
							$last 	  = $result[2];



							if($higherExchange < $last){
								$higherExchange = $last; 
								$higherCurrency = $currency;
							}

							if($lowerExchange > $last){
								$lowerExchange 	= $last; 
								$lowerCurrency 	= $currency;
							}

							if($highBidAsk < $ask){
								$highBidAsk = $ask; 
								$highAskExchange = $currency;
							}
					}




					echo json_encode(array("higherExchange"=>$higherExchange,"higherExchange"=>$higherCurrency,"lowerExchange"=>$lowerExchange,"lowerCurrency"=>$lowerCurrency,"highBidAsk"=>$highBidAsk,"highAskExchange"=>$highAskExchange,"html"=>$html))


			 




			















			
		 






//	}else{
//		echo "Not founds";	
//	}

?>




 