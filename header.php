
<?php
/*(\ccxt\Exchange::$exchanges); */
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
$zbObj   		= new \ccxt\zb();           // BTC/USDT



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

function getSingleUsdt($exchnage,$exchangePair){
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

				$finalData = $huobiObj->create_market_sell_order ($exchangePair, 1);


			}elseif($exchnage == 'okex'){

				$finalData = $okexObj->create_market_sell_order ($exchangePair, 1);


			}elseif($exchnage == 'liqui'){

				$finalData = $liquiObj->create_market_sell_order ($exchangePair, 1);


			}elseif($exchnage == 'hitbtc'){

				$finalData = $hitbtcObj->create_market_sell_order ($exchangePair, 1);


			}elseif($exchnage == 'binance'){

				$finalData = $binanceObj->create_market_sell_order ($exchangePair, 1);

			}elseif($exchnage == 'kucoin'){

				$finalData = $kucoinObj->create_market_sell_order ($exchangePair, 1);

			}elseif($exchnage == 'zb'){	
				$finalData = $zbObj->create_market_sell_order ($exchangePair, 1);


			}elseif($exchnage == 'gateio'){		

				$finalData = $gateioObj->create_market_sell_order ($exchangePair, 1);	

			}elseif($exchnage == 'tidex'){				
				$finalData = $tidexObj->create_market_sell_order ($exchangePair, 1);	

			}elseif($exchnage == 'cryptopia'){	

				$finalData = $cryptopiaObj->create_market_sell_order ($exchangePair, 1);

			}elseif($exchnage == 'exmo'){	

				$finalData = $exmoObj->create_market_sell_order ($exchangePair, 1);	

			}else{
				
				$finalData = $bittrexObj->create_market_sell_order ($exchangePair, 1);		
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




 