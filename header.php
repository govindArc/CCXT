
<?php
/*(\ccxt\Exchange::$exchanges); */

ini_set('max_execution_time', 300);

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
$exmoObj   		= new \ccxt\exmo();    		// BTC/USDT  
$bittrexObj  	= new \ccxt\bittrex(); 	// BTC/USDT  
$higherExchange = 0;
$lowerExchange  = 999999999999;
$higherCurrency = '';
$lowerCurrency  = '';
$highBidAsk 	= 0; 
$highAskExchange = '';
 //$binanceObj->



function calculateUSDT($exchnageA,$exchnageB,$exchangePair){
		$orderBookAExchange =  getOrderBook($exchnageA,$exchangePair);
		$orderBookBExchange =  getOrderBook($exchnageB,$exchangePair);
		if(count($orderBookAExchange)>0 && count($orderBookBExchange)>0){
				$BuyArray = $orderBookAExchange['bids'];
				$SellArray = $orderBookBExchange['asks'];
				$buyerArray 	=   array();
				$sellerArray  	=   array();

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
		}elseif($exchnage == 'exmo'){	
			$finalData = $exmoObj->fetch_order_book($exchangePair, $limit);
		}else{
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
		else if($exchange == 'exmo'){
			$Tickers = $exmoObj->fetch_ticker($pair);
			setHigherLower($Tickers,'exmo');
		}
		else{
			$Tickers = $binanceObj->fetch_ticker($pair);
		}






		$lastPrice = number_format($Tickers['last'], 10, '.', '');



		return $lastPrice;
}

 

?>




 