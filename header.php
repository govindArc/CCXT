<?php
include 'ccxt.php';
$huobiObj   	= new \ccxt\huobi(); // BTC/CNY , LTC/CNY
$okexObj   		= new \ccxt\okex(); // DASH/BTC ,LTC/BTC
$liquiObj   	= new \ccxt\liqui(); // 1ST/BTC 1ST/ETH LTC/BTC DASH/BTC STEEM/BTC
$hitbtcObj  	= new \ccxt\hitbtc(); // 1ST/BTC 1ST/ETH LTC/BTC DASH/BTC STEEM/BTC
$binanceObj   	= new \ccxt\binance(); // LTC/BTC STEEM/BTC DASH/BTC
/*top spreads*/
//BTC/USD
//$poloniexObj   	= new \ccxt\poloniex();  not free
//$biboxObj   	= new \ccxt\bibox();   not free
$kucoinObj   	= new \ccxt\kucoin();   // BTC/USDT
$zbObj   		= new \ccxt\zb();           // BTC/USDTx
$gateioObj   	= new \ccxt\gateio();   // BTC/USDT  
$tidexObj   	= new \ccxt\tidex();    // BTC/USDT  
$cryptopiaObj 	= new \ccxt\cryptopia();  // BTC/USDT  
//$exmoObj   		= new \ccxt\exmo();    		// BTC/USDT  
$bittrexObj  	= new \ccxt\bittrex(); 	// BTC/USDT  
$higherExchange = 0;
$lowerExchange  = 999999999999;
$higherCurrency = '';
$lowerCurrency  = '';
$highBidAsk 	= 0; 
$highAskExchange = '';



function calculateUSDT($exchnageA,$exchnageB,$exchangePair){
		$orderBookAExchange =  getOrderBook($exchnageA,$exchangePair);
		$orderBookBExchange =  getOrderBook($exchnageB,$exchangePair);
		if(count($orderBookAExchange)>0 && count($orderBookBExchange)>0){
				

				$BuyArray = $orderBookAExchange['bids'];
				$SellArray = $orderBookBExchange['asks'];
				$buyerArray 	=   array();
				$sellerArray  	=   array();
			
			//	$BuyArray 	= 	[[0.01600002,0.4375],[0.016,0.38240984],[0.01599905,4.3753],[0.01599902,52.8948],[0.01599899,0.25238835]];
			//	$SellArray 	= [[0.01609,7],[0.0161,16.3],[0.01611,16.1],[0.01612,129.6],[0.01613,25.2]];
			//	echo 'buyer '.json_encode($BuyArray).'</br>';
			//	echo 'selller '.json_encode($SellArray);
				foreach ($BuyArray as $value) {
							array_push($buyerArray,($value[0] * $value[1]));
				} 

				foreach ($SellArray as $value) {
							array_push($sellerArray,($value[0] * $value[1]));
				} 
				//991  calculation
				$arraySpreadPercent = array();
				$USDTvalue = 0;

				for ($i=0;$i<5;$i++){
						if($i == 0){
							$USDTvalue = 1000;
						}else if($i == 1){
							$USDTvalue = 2000;
						}else if($i == 2){
							$USDTvalue = 3000;
						}else if($i == 3){
							$USDTvalue = 4000;
						}else if($i == 4){
							$USDTvalue = 5000;
						} 

						$USDTV1  =  $USDTvalue-$sellerArray[0];
						/// btc value price and volume pair
						$pair 	 =	$SellArray[0];
						$volume  = 	$pair[0]; // valume
						$pair[1]; // price
						$volume2 = $USDTV1/$SellArray[1][1]; // price [1]
						$sum 	 = $volume2 + $SellArray[0][0];
						//price after deduct taker fee
						$priceAfterTakerFee = $sum - 0.003;
						///sahi
						//	$priceAfterTakerFee - buy zero volume  // 0 for volume and 1 
						$secondBTC 	= $priceAfterTakerFee - $BuyArray[0][0];
						$thirdBTC 	= $secondBTC - $BuyArray[1][0];
						$USDTthree  = $thirdBTC * $BuyArray[2][1];
						$sumBuyer 	= $USDTthree+$buyerArray[0]+$buyerArray[1];
						//price after deduct taker fee
						$buyDeductFee = $sumBuyer * 0.003;
						$buyPriceAfterFee = $sumBuyer - $buyDeductFee;

						$finalPercent = ($buyPriceAfterFee / $USDTvalue)*100;
						array_push($arraySpreadPercent, $finalPercent);
				}

				return  $arraySpreadPercent;

				die;	
		}else{

				return  array();
		} 
		
}


function getOrderBook($exchnage,$exchangePair){

		$limit = '5';

		global  $huobiObj;    
		global  $okexObj;  	 
		global  $liquiObj;    
		global  $hitbtcObj; 	 
		global  $binanceObj;    
		global  $kucoinObj;    
		global  $zbObj;   	 
		global  $gateioObj;    
		global  $tidexObj;    
		global  $cryptopiaObj; 
		global  $exmoObj;   	 
		global  $bittrexObj; 


		if($exchnage == 'huobi'){
			$finalData = $huobiObj->fetch_order_book($exchangePair, $limit);
		}elseif($exchnage == 'okex'){
			$finalData = $okexObj->fetch_order_book($exchangePair, $limit);
		}elseif($exchnage == 'liqui'){
			$finalData = $liquiObj->fetch_order_book($exchangePair, $limit);
		}elseif($exchnage == 'hitbtc'){
			$finalData = $hitbtcObj->fetch_order_book($exchangePair, $limit);
		}elseif($exchnage == 'binance'){
			$finalData = $binanceObj->fetch_order_book($exchangePair, $limit);
		}elseif($exchnage == 'kucoin'){
			$finalData = $kucoinObj->fetch_order_book($exchangePair, $limit);
		}elseif($exchnage == 'zb'){	
			$finalData = $zbObj->fetch_order_book($exchangePair, $limit);
		}elseif($exchnage == 'gateio'){		
			$finalData = $gateioObj->fetch_order_book($exchangePair, $limit);
		}elseif($exchnage == 'tidex'){		
			$finalData = $tidexObj->fetch_order_book($exchangePair, $limit);
		}elseif($exchnage == 'cryptopia'){	
			$finalData = $cryptopiaObj->fetch_order_book($exchangePair, $limit);
		}


		/*
		elseif($exchnage == 'exmo'){	
			$finalData = $bittrexObj->fetch_order_book($exchangePair, $limit);	
		}*/

		else{
			$finalData = $bittrexObj->fetch_order_book($exchangePair, $limit);
		}

		return $finalData;
} 





function setHigherLower($Tickers,$currency){
		global $higherExchange;
		global $lowerExchange;
		global $higherCurrency;
		global $lowerCurrency;

		global $highBidAsk;
		global $highAskExchange;
			 
		$askRate = number_format($Tickers['ask'], 10, '.', '');
		$Tickers = number_format($Tickers['last'], 10, '.', '');

		if($higherExchange < $Tickers){
			$higherExchange = $Tickers; 
			$higherCurrency = $currency;
		}
		if($lowerExchange > $Tickers){
			$lowerExchange 	= $Tickers; 
			$lowerCurrency 	= $currency;
		}

		if($highBidAsk < $askRate){
			$highBidAsk = $askRate; 
			$highAskExchange = $currency;
		}
}



function getSpreadPercentage($ExchangeOne,$ExchangeTwo){
		$assets      = 10000;
		$totalCoins  =  ($assets / $ExchangeOne)-0.003;
		$totalCoinsB = ($totalCoins * $ExchangeTwo)-0.003;
		$profit 	 =	 $totalCoinsB - $assets;
		return ($profit /  $assets);
} 




/*here we get the ltcbtc pair */
function getpairsOfLTCBTC($exchanegArrayA,$exchanegArrayB,$exhageCurrency){
		
		$exhageCurrency  = "LTC/BTC";
		$exchanegArrayA =  ["liqui","liqui","liqui","hitbtc"];
		$exchanegArrayB =  ["hitbtc","okax","binance","liqui"];
		 
		$html =  "";	
		for($i=0;$i>count($exchanegArrayA);$i++){

			$lastExchangeA =  getLastPriceOfExchage($exchanegArrayA[$i],$exhageCurrency);
			$lastExchangeB = getLastPriceOfExchage($exchanegArrayB[$i],$exhageCurrency);
			
			$spreadPercentage = getSpreadPercentage($lastExchangeA,$lastExchangeB);

			$USDTArray = calculateUSDT($exchanegArrayA[$i],$exchanegArrayB[$i],$exhageCurrency);


			$USDT_1000 = "not found";
			$USDT_2000 = "not found";
			$USDT_3000 = "not found";	
			$USDT_4000 = "not found";
			$USDT_5000 = "not found";

			if(isset($USDTArray[0])){
				$USDT_1000 = $USDTArray[0];
			}
			if(isset($USDTArray[1])){
				$USDT_2000 = $USDTArray[1];
			}
			if(isset($USDTArray[2])){
				$USDT_3000 = $USDTArray[2];
			}
			if(isset($USDTArray[3])){
				$USDT_4000 = $USDTArray[3];
			}
			if(isset($USDTArray[4])){
				$USDT_5000 = $USDTArray[5];
			}


			$html = $html."<tr>
								<td>".$exhageCurrency."</td>
								<td>".$exchanegArrayA[$i]."</td>
								<td>".$exchanegArrayB[$i]."</td>
								<td>".$lastExchangeA."</td>	
								<td>".$lastExchangeB."</td>
								<td>".$spreadPercentage."</td>
								<td>".$USDT_1000."</td>
								<td>".$USDT_2000."</td>
								<td>".$USDT_3000."</td>
								<td>".$USDT_4000."</td>
								<td>".$USDT_5000."</td>
						   <tr>"

		} 


		echo json_encode($html);

		


}






 

function getLastPriceOfExchage($exchange,$pair){
		global $huobiObj;
		global $okexObj;
		global $liquiObj;
		global $hitbtcObj;
		global $binanceObj;
		global $bitmexObj;
		//highest pair USDT
		global $kucoinObj;
		global $bittrexObj;
		global $gateioObj;
		global $tidexObj;
		global $cryptopiaObj;
		global $zbObj;
		global $exmoObj;

		if($exchange == 'huobi'){
			$Tickers = $huobiObj->fetch_ticker($pair);

		}else if($exchange == 'okex'){

			$Tickers = $okexObj->fetch_ticker($pair);

		}else if($exchange == 'liqui'){

			$Tickers = $liquiObj->fetch_ticker($pair);

		}else if($exchange == 'hitbtc'){

			$Tickers = $hitbtcObj->fetch_ticker($pair);

		}else if($exchange == 'bitmex'){
			
			$Tickers = $bitmexObj->fetch_ticker($pair);
		}



		else if($exchange == 'kucoin'){
			$Tickers = $kucoinObj->fetch_ticker($pair);
			setHigherLower($Tickers,'kucoin');
			


		}else if($exchange == 'bittrex'){
			$Tickers = $bittrexObj->fetch_ticker($pair);
			setHigherLower($Tickers,'bittrex');


		}else if($exchange == 'gateio'){
			$Tickers = $gateioObj->fetch_ticker($pair);
			setHigherLower($Tickers,'gateio');


		}else if($exchange == 'tidex'){
			$Tickers = $tidexObj->fetch_ticker($pair);
			setHigherLower($Tickers,'tidex');


		}else if($exchange == 'cryptopia'){
			$Tickers = $cryptopiaObj->fetch_ticker($pair);
			setHigherLower($Tickers,'cryptopia');

		}else if($exchange == 'zb'){
			$Tickers = $zbObj->fetch_ticker($pair);
			setHigherLower($Tickers,'zb');
		}
		
		/*
		else if($exchange == 'exmo'){
			$Tickers = $exmoObj->fetch_ticker($pair);
			setHigherLower($Tickers,'exmo');
		}
		*/

		else{
			$Tickers = $binanceObj->fetch_ticker($pair);
		}

		$lastPrice = number_format($Tickers['last'], 10, '.', '');
		return $lastPrice;
}

 

?>




 