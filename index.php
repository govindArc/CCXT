
<?php
/*csss*/

include 'ccxt.php';
$liquiObj   = new \ccxt\liqui();
$hitbtcObj   = new \ccxt\hitbtc();
$dataArray = array('LTC/BTC','STEEM/BTC','SBD/BTC','DASH/BTC','ANS/BTC','DCT/BTC');
/*get filker */
$tickersLiqui	= 	$liquiObj->fetch_ticker($dataArray[0]);
$tickersHitBtc	= 	$liquiObj->fetch_ticker($dataArray[0]);



//
$tickersLiquiSTEEM	= 	$liquiObj->fetch_ticker($dataArray[1]);
$tickersHitBtcSTEEM	= 	$liquiObj->fetch_ticker($dataArray[1]);


//
$tickersLiquiSBD	= 	$liquiObj->fetch_ticker($dataArray[2]);
$tickersHitBtcSBD	= 	$liquiObj->fetch_ticker($dataArray[2]);


//
$tickersLiquiDASH	= 	$liquiObj->fetch_ticker($dataArray[3]);
$tickersHitBtcDASH	= 	$liquiObj->fetch_ticker($dataArray[3]);


//
$tickersLiquiANS	= 	$liquiObj->fetch_ticker($dataArray[4]);
$tickersHitBtcANS	= 	$liquiObj->fetch_ticker($dataArray[4]);


$tickersLiquiDCT	= 	$liquiObj->fetch_ticker($dataArray[5]);
$tickersHitBtcDCT	= 	$liquiObj->fetch_ticker($dataArray[5]);


//echo json_encode($tickersLiqui);
//print_r($tickersLiqui);
//print_r($tickersHitBtc);
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
				<h4 align="left">Exchange for liqui currency</h4>
				
			<div class="col-xs-12">	
				<h1><i class="material-icons">tune</i> Exchange Spreads</h1>
			</div>
				<table class="table responsive">
				          <thead>     
						      	<tr>       
									 <th>Exchange A</th> 
									 <th class="mobile-d-all">Exchage B</th> 
									 <th class="mobile-d-all">Spread %</th>
									 <th class="mobile-d-all">Spread Voloume%</th>
									 <th class="mobile-d-all">Assets</th>
									 
								</tr>
				          </thead>          
				          <tbody>
				          		<tr>       
									 <th>LTC/BTC</th> 
									 <th class="mobile-d-all">&nbsp;</th> 
									 <th class="mobile-d-all">&nbsp;</th> 
									 <th class="mobile-d-all">&nbsp;</th> 
									 <th class="mobile-d-all">&nbsp;</th> 
								</tr>
					  			<tr>       
										 <th>liqui</th> 
										 <th class="mobile-d-all">Hitbc</th> 
										 <th class="mobile-d-all"><?php echo  ($tickersLiqui['last'] / 100)-($tickersLiqui['last']-$tickersHitBtc['last']); ?></th>
										 <th class="mobile-d-all"></th>
										 <th class="mobile-d-all">1000 USDT</th>
									 
									</tr>

									<tr>       
										 <th>STEEM/BTC</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 
									</tr>
									<tr>       
										 <th>liqui</th> 
										 <th class="mobile-d-all">Hitbc</th> 
										 <th class="mobile-d-all"><?php echo  ($tickersLiquiSTEEM['last'] / 100)-($tickersLiquiSTEEM['last']-$tickersHitBtcSTEEM['last']); ?></th>
										 <th class="mobile-d-all"></th>
										 <th class="mobile-d-all">1000 USDT</th>
									 
									</tr>


									<tr>       
										 <th>SBD/BTC</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 
									</tr>
									<tr>       
										 <th>liqui</th> 
										 <th class="mobile-d-all">Hitbc</th> 
										 <th class="mobile-d-all"><?php echo  ($tickersLiquiSBD['last'] / 100)-($tickersLiquiSBD['last']-$tickersHitBtcSBD['last']); ?></th>
										 <th class="mobile-d-all"></th>
										 <th class="mobile-d-all">1000 USDT</th>
									 
									</tr>


									<tr>       
										 <th>DASH/BTC</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 
									</tr>
									<tr>       
										 <th>liqui</th> 
										 <th class="mobile-d-all">Hitbc</th> 
										 <th class="mobile-d-all"><?php echo  ($tickersLiquiDASH['last'] / 100)-($tickersLiquiDASH['last']-$tickersHitBtcDASH['last']); ?></th>
										 <th class="mobile-d-all"></th>
										 <th class="mobile-d-all">1000 USDT</th>
									 
									</tr>



									<tr>       
										 <th>ANS/BTC</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 
									</tr>
									<tr>       
										 <th>liqui</th> 
										 <th class="mobile-d-all">Hitbc</th> 
										 <th class="mobile-d-all"><?php echo  ($tickersLiquiANS['last'] / 100)-($tickersLiquiANS['last']-$tickersHitBtcANS['last']); ?></th>
										 <th class="mobile-d-all"></th>
										 <th class="mobile-d-all">1000 USDT</th>
									 
									</tr>


										<tr>       
										 <th>ANS/BTC</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 <th class="mobile-d-all">&nbsp;</th> 
										 
									</tr>
									<tr>       
										 <th>liqui</th> 
										 <th class="mobile-d-all">Hitbc</th> 
										 <th class="mobile-d-all"><?php echo  ($tickersLiquiDCT['last'] / 100)-($tickersLiquiDCT['last']-$tickersHitBtcDCT['last']); ?></th>
										 <th class="mobile-d-all"></th>
										 <th class="mobile-d-all">1000 USDT</th>
									 
									</tr>





									


				          </tbody>
				</table>

		</div>
</body>
</html>



 