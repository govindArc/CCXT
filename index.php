
<?php
/*csss*/

/*$tickershuobi = $huobiObj->load_markets();   used to load all markets*/

include 'ccxt.php';
//echo json_encode((\ccxt\Exchange::$exchanges)); 

$huobiObj   	= new \ccxt\huobi(); // BTC/CNY , LTC/CNY
$okexObj   		= new \ccxt\okex(); // DASH/BTC ,LTC/BTC
$liquiObj   	= new \ccxt\liqui(); // 1ST/BTC 1ST/ETH LTC/BTC DASH/BTC STEEM/BTC
$hitbtcObj  	= new \ccxt\hitbtc(); // 1ST/BTC 1ST/ETH LTC/BTC DASH/BTC STEEM/BTC
$binanceObj   	= new \ccxt\binance(); // LTC/BTC STEEM/BTC DASH/BTC



 



/*
$huobiMarket 	=	 $huobiObj->load_markets();
$okexMarket 	=	 $okexObj->load_markets();
$liquiMarket 	=	 $liquiObj->load_markets();
$hitbtcMarket 	=	 $hitbtcObj->load_markets();
$binanceMarket 	=	 $binanceObj->load_markets();

$exchaneCurrency = ['huobi','okex','liqui','hitbtc','binance'];





foreach ($huobiMarket as $key => $value) {
		if (!in_array($key, $allSymbolArrys)){
				array_push($allSymbolArrys, $key);
		}
}

foreach ($okexMarket as $key => $value) {
		if (!in_array($key, $allSymbolArrys)){
				array_push($allSymbolArrys, $key);
		}
}
foreach ($liquiMarket as $key => $value) {
		if (!in_array($key, $allSymbolArrys)){
				array_push($allSymbolArrys, $key);
		}
}

foreach ($hitbtcMarket as $key => $value) {
		if (!in_array($key, $allSymbolArrys)){
				array_push($allSymbolArrys, $key);
		}
}


foreach ($binanceMarket as $key => $value) {
		if (!in_array($key, $allSymbolArrys)){
				array_push($allSymbolArrys, $key);
		}
}

///array_key_exists("BC/CNY",$huobiMarket)
/*
foreach ($huobiSymbol as $result) {
	 echo $result['symbol'];
}
*/
 

 


/*
print_r($huobiCurrency['BTC/CNY']);

echo $huobiCurrency['symbol'];


echo '<br>';

/*
echo json_encode($okexObj->load_markets());
echo '<br>';


echo json_encode($liquiObj->load_markets());
echo '<br>';

echo json_encode($hitbtcObj->load_markets());
echo '<br>';

echo json_encode($binanceObj->load_markets());
echo '<br>';
*/





/*

$dataArray = array('LTC/BTC','STEEM/BTC','SBD/BTC','DASH/BTC','DCT/BTC');
 
$tickersLiqui	= 	$liquiObj->fetch_ticker($dataArray[0]);
$tickersHitBtc	= 	$hitbtcObj->fetch_ticker($dataArray[0]);
//
$tickersLiquiSTEEM	= 	$liquiObj->fetch_ticker($dataArray[1]);
$tickersHitBtcSTEEM	= 	$hitbtcObj->fetch_ticker($dataArray[1]);
//
$tickersLiquiSBD	= 	$liquiObj->fetch_ticker($dataArray[2]);
$tickersHitBtcSBD	= 	$hitbtcObj->fetch_ticker($dataArray[2]);
//
$tickersLiquiDASH	= 	$liquiObj->fetch_ticker($dataArray[3]);
$tickersHitBtcDASH	= 	$hitbtcObj->fetch_ticker($dataArray[3]);
//
$tickersLiquiDCT	= 	$liquiObj->fetch_ticker($dataArray[4]);
$tickersHitBtcDCT	= 	$hitbtcObj->fetch_ticker($dataArray[4]);

*/


function getSpreadPercentage($exchnageAprice,$exchnageBprice){
		$spreaVolume	= ($exchnageAprice / 100 * ($exchnageAprice - $exchnageBprice));
		$spreaVolume = number_format($spreaVolume, 20, '.', '');
		return $spreaVolume; 
}



function getLastPriceOfExchage($exchange,$pair){
		
		global $huobiObj;
		global $okexObj;
		global $liquiObj;
		global $hitbtcObj;
		global $binanceObj;
		
		if($exchange == 'huobi'){
			$Tickers = $huobiObj->fetch_ticker($pair);

		}else if($exchange == 'okex'){
			$Tickers = $okexObj->fetch_ticker($pair);

		}else if($exchange == 'liqui'){
			$Tickers = $liquiObj->fetch_ticker($pair);

		}else if($exchange == 'hitbtc'){
			$Tickers = $hitbtcObj->fetch_ticker($pair);
		}else{
			$Tickers = $binanceObj->fetch_ticker($pair);
		}

		$lastPrice = number_format($Tickers['last'], 20, '.', '');
		return $lastPrice;
}
?>


<!--CSSSSS-->
<!DOCTYPE html>
<html>
<head>
	<title>CCXT CURRENCY EXCAHNGE</title>


	<script type="text/javascript" href="/css/bootstrap.css"> </script>
	<script type="text/javascript" href="/css/bootstrap.min.css"> </script>

	<link href='/css/core.css' media='screen' rel='stylesheet' type='text/css'>
    <link href='/css/fonts.css' media='screen' rel='stylesheet' type='text/css'>
    <link href='/css/responsive.css' media='screen' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/app.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<body>
		<div class="container">
				<h2 align="center">Token Spreads</h2>
				<h4 align="center">crypto Spread Monitoring And Alerts</h4>
			
			<div class="col-xs-12">	
				<h1><i class="material-icons">tune</i> Exchange Spreads</h1>
			</div>


		 	
				<table class="table responsive">

								<tr>       
									 <th><?php echo 'LTC/BTC';?></th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr>       
									 <th>Currency Pair</th> 
									 <th class="mobile-d-all">Exchage A</th> 
									 <th class="mobile-d-all">Exchage B</th> 
									 <th class="mobile-d-all">Last Price (exchage A)</th> 
									 <th class="mobile-d-all">Last Price (exchage B)</th> 
									 <th class="mobile-d-all">Spread %</th>
									 <th class="mobile-d-all">Spread Voloume%</th>
									 <th class="mobile-d-all">Assets</th>
								</tr>

<!--liqui-->

								 <tr>
				          			 <td>LTC/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','LTC/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','LTC/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','LTC/BTC'),getLastPriceOfExchage('hitbtc','LTC/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>



								 <tr>
				          			 <td>LTC/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>OKAX</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','LTC/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('okax','LTC/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','LTC/BTC'),getLastPriceOfExchage('okax','LTC/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>





								 <tr>
				          			 <td>LTC/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>BINANCE</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','LTC/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('binance','LTC/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','LTC/BTC'),getLastPriceOfExchage('binance','LTC/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>

<!--HITBTC-->
								
								 <tr>
				          			 <td>LTC/BTC</td> 	
				          			 <td>HITBTC</td> 
									 <td>LIQUI</td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','LTC/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('liqui','LTC/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','LTC/BTC'),getLastPriceOfExchage('liqui','LTC/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>LTC/BTC</td> 	
				          			 <td>HITBTC</td> 
									 <td>BINANCE</td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','LTC/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('binance','LTC/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','LTC/BTC'),getLastPriceOfExchage('binance','LTC/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>LTC/BTC</td> 	
				          			 <td>HITBTC</td> 
									 <td>OKAX</td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','LTC/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('okax','LTC/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','LTC/BTC'),getLastPriceOfExchage('okax','LTC/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>



<!--okax-->

								
								 <tr>
				          			 <td>LTC/BTC</td> 	
				          			 <td>OKAX</td> 
									 <td>LIQUI</td> 
									 <td><?php echo  getLastPriceOfExchage('okax','LTC/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('liqui','LTC/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('okax','LTC/BTC'),getLastPriceOfExchage('liqui','LTC/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>LTC/BTC</td> 	
				          			 <td>OKAX</td> 
									 <td>BINANCE</td> 
									 <td><?php echo  getLastPriceOfExchage('okax','LTC/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('binance','LTC/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('okax','LTC/BTC'),getLastPriceOfExchage('binance','LTC/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>LTC/BTC</td> 	
				          			 
									 <td>OKAX</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('okax','LTC/BTC');?></td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','LTC/BTC');?></td>
									 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('okax','LTC/BTC'),getLastPriceOfExchage('hitbtc','LTC/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


<!--dash btc-->

								<tr>       
									 <th><?php echo 'DASH/BTC';?></th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr>       
									 <th>Currency Pair</th> 
									 <th class="mobile-d-all">Exchage A</th> 
									 <th class="mobile-d-all">Exchage B</th> 
									 <th class="mobile-d-all">Last Price (exchage A)</th> 
									 <th class="mobile-d-all">Last Price (exchage B)</th> 
									 <th class="mobile-d-all">Spread %</th>
									 <th class="mobile-d-all">Spread Voloume%</th>
									 <th class="mobile-d-all">Assets</th>
								</tr>	


								<tr>
				          			 <td>DASH/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','DASH/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','DASH/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','DASH/BTC'),getLastPriceOfExchage('hitbtc','DASH/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>



								 <tr>
				          			 <td>DASH/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>OKAX</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','DASH/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('okax','DASH/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','DASH/BTC'),getLastPriceOfExchage('okax','DASH/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>





								 <tr>
				          			 <td>DASH/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>BINANCE</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','DASH/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('binance','DASH/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','DASH/BTC'),getLastPriceOfExchage('binance','DASH/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>

<!--HITBTC-->
								
								 <tr>
				          			 <td>DASH/BTC</td> 	
				          			 <td>HITBTC</td> 
									 <td>LIQUI</td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','DASH/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('liqui','DASH/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','DASH/BTC'),getLastPriceOfExchage('liqui','DASH/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>DASH/BTC</td> 	
				          			 <td>HITBTC</td> 
									 <td>BINANCE</td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','DASH/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('binance','DASH/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','DASH/BTC'),getLastPriceOfExchage('binance','DASH/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>DASH/BTC</td> 	
				          			 <td>HITBTC</td> 
									 <td>OKAX</td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','DASH/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('okax','DASH/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','DASH/BTC'),getLastPriceOfExchage('okax','DASH/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>



<!--okax-->

								
								 <tr>
				          			 <td>DASH/BTC</td> 	
				          			 <td>OKAX</td> 
									 <td>LIQUI</td> 
									 <td><?php echo  getLastPriceOfExchage('okax','DASH/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('liqui','DASH/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('okax','DASH/BTC'),getLastPriceOfExchage('liqui','DASH/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>DASH/BTC</td> 	
				          			 <td>OKAX</td> 
									 <td>BINANCE</td> 
									 <td><?php echo  getLastPriceOfExchage('okax','DASH/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('binance','DASH/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('okax','DASH/BTC'),getLastPriceOfExchage('binance','DASH/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>DASH/BTC</td> 	
				          			 
									 <td>OKAX</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('okax','DASH/BTC');?></td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','DASH/BTC');?></td>
									 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('okax','DASH/BTC'),getLastPriceOfExchage('hitbtc','DASH/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


<!--dash btc-->





				        		<tr>       
									 <th><?php echo '1ST/BTC';?></th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr>       
									 <th>Currency Pair</th> 
									 <th class="mobile-d-all">Exchage A</th> 
									 <th class="mobile-d-all">Exchage B</th> 
									 <th class="mobile-d-all">Last Price (exchage A)</th> 
									 <th class="mobile-d-all">Last Price (exchage B)</th> 
									 <th class="mobile-d-all">Spread %</th>
									 <th class="mobile-d-all">Spread Voloume%</th>
									 <th class="mobile-d-all">Assets</th>
								</tr>



								 <tr>
				          			 <td>1ST/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','1ST/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','1ST/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','1ST/BTC'),getLastPriceOfExchage('hitbtc','1ST/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>



								 <tr>
				          			 <td>1ST/BTC</td> 	
				          			 <td>HITBTC</td> 
				          			 <td>LIQUI</td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','1ST/BTC');?></td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','1ST/BTC');?></td>
									 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','1ST/BTC'),getLastPriceOfExchage('liqui','1ST/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>



								<tr>       
									 <th><?php echo '1ST/ETH';?></th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr>       
									 <th>Currency Pair</th> 
									 <th class="mobile-d-all">Exchage A</th> 
									 <th class="mobile-d-all">Exchage B</th> 
									 <th class="mobile-d-all">Last Price (exchage A)</th> 
									 <th class="mobile-d-all">Last Price (exchage B)</th> 
									 <th class="mobile-d-all">Spread %</th>
									 <th class="mobile-d-all">Spread Voloume%</th>
									 <th class="mobile-d-all">Assets</th>
								</tr>	


								<tr>
				          			 <td>1ST/ETH</td> 	
				          			 <td>LIQUI</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','1ST/ETH');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','1ST/ETH');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','1ST/ETH'),getLastPriceOfExchage('hitbtc','1ST/ETH')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>1ST/ETH</td> 	
				          			 <td>HITBTC</td>
				          			 <td>LIQUI</td> 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','1ST/ETH');?></td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','1ST/ETH');?></td>
									 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','1ST/ETH'),getLastPriceOfExchage('liqui','1ST/ETH')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


<!--STEEM/BTC-->
								<tr>       
									 <th><?php echo 'STEEM/BTC';?></th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr>       
									 <th>Currency Pair</th> 
									 <th class="mobile-d-all">Exchage A</th> 
									 <th class="mobile-d-all">Exchage B</th> 
									 <th class="mobile-d-all">Last Price (exchage A)</th> 
									 <th class="mobile-d-all">Last Price (exchage B)</th> 
									 <th class="mobile-d-all">Spread %</th>
									 <th class="mobile-d-all">Spread Voloume%</th>
									 <th class="mobile-d-all">Assets</th>
								</tr>

								<tr>
				          			 <td>STEEM/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','STEEM/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','STEEM/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','STEEM/BTC'),getLastPriceOfExchage('hitbtc','STEEM/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>

								<tr>
				          			 <td>STEEM/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>BINANCE</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','STEEM/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('binance','STEEM/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','STEEM/BTC'),getLastPriceOfExchage('binance','STEEM/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>



								<tr>
				          			 <td>STEEM/BTC</td> 	
				          			 <td>HITBTC</td>
				          			 <td>LIQUI</td> 
									 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','STEEM/BTC');?></td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','STEEM/BTC');?></td>

									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','STEEM/BTC'),getLastPriceOfExchage('liqui','STEEM/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>

								<tr>
				          			 <td>STEEM/BTC</td> 	
				          			 <td>HITBTC</td>
				          			 <td>BINANCE</td> 
									 
									 <td><?php echo  getLastPriceOfExchage('hitbtc','STEEM/BTC');?></td> 
									 <td><?php echo  getLastPriceOfExchage('binance','STEEM/BTC');?></td>

									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('hitbtc','STEEM/BTC'),getLastPriceOfExchage('binance','STEEM/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>


								<tr>
				          			 <td>STEEM/BTC</td> 	
				          			 <td>BINANCE</td> 
				          			 <td>LIQUI</td> 
									 
									 <td><?php echo  getLastPriceOfExchage('binance','STEEM/BTC');?></td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','STEEM/BTC');?></td>

									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('binance','STEEM/BTC'),getLastPriceOfExchage('liqui','STEEM/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>

								<tr>
				          			 <td>STEEM/BTC</td> 	
				          			 <td>BINANCE</td>
				          			 <td>HITBTC</td>
									 
									  
									 <td><?php echo  getLastPriceOfExchage('binance','STEEM/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','STEEM/BTC');?></td>

									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('binance','STEEM/BTC'),getLastPriceOfExchage('hitbtc','STEEM/BTC')); ?>
									 </td> 
									 <td>Currency Pair</td> 
									 <td>Currency Pair</td> 
								</tr>









<!--STEEM/BTC-->
								


				</table>
			

		</div>
</body>
</html>



 