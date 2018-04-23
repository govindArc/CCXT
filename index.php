<?php
	include 'header.php';



	if(isset($_POST["DATA"]) && $_POST["DATA"] == "AJAX"){
			$pair	 = "BTC/USDT";
			$html 	 = "<tr>
				         <th colspan='2'>Latest BTC/USDT Price Spreads</th>
				       </tr>";
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

					}

					/*	
					else if($i==5){
						$Tickers 		= $exmoObj->fetch_ticker($pair);	
						$currencySymbol = "exmo";
					}
					*/

					else{

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

					echo json_encode(array("higherExchange"=>$higherExchange,"higherCurrency"=>$higherCurrency,"lowerExchange"=>$lowerExchange,"lowerCurrency"=>$lowerCurrency,"highBidAsk"=>$highBidAsk,"highAskExchange"=>$highAskExchange,"html"=>$html));

					die;

	}



/*LTC BTC*/
	if(isset($_POST["DATA"]) && $_POST["DATA"] == "LTCBTC"){


		$exhageCurrency  = "LTC/BTC";
		$exchanegArrayA =  ["liqui","liqui","liqui","hitbtc"];
		$exchanegArrayB =  ["hitbtc","okax","binance","liqui"];
		

		$html =  "";	
		for($i=0;$i<count($exchanegArrayA);$i++){

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
						   <tr>";
			}
		 echo json_encode(array("LTCBTC"=>$html));
		 die;
	}
?>

<!--CSSSSS-->
<!DOCTYPE html>
<html>
<head>
	<title>CCXT CURRENCY EXCAHNGE</title>
	<script type="text/javascript" href="/css/bootstrap.css"></script>
	<script type="text/javascript" href="/css/bootstrap.min.css"></script>
	<link href='/css/core.css' media='screen' rel='stylesheet' type='text/css'>
    <link href='/css/fonts.css' media='screen' rel='stylesheet' type='text/css'>
    <link href='/css/responsive.css' media='screen' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='/css/jquery.dataTables.min.css' media='screen' rel='stylesheet' type='text/css'>
    <script src="/js/jquery-1.9.1.min.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap.min.js"></script>
    <script src="/js/app.js"></script>
	<script type="text/javascript" language="javascript">  
		$(window).load(function() {
			$('.userDate').innerHTML = Date();
			setInterval(function(){
				location.reload();
			 }, 120000);
		});  

		$(document).ready(function(){
			$("#higerUsdt").hide();
			$("#highPriceTable").hide();
			$("#highBidTable").hide();
			$.ajax({
			    type: 'POST',
			    dataType: "json",
			    url: "index.php",
			    data: "DATA=AJAX",
			    success: function (data) {
			         var myObj = data;
			         var higherExchange 	=  myObj.higherExchange;
			         var higherCurrency 	=  myObj.higherCurrency;
			         var lowerExchange		=  myObj.lowerExchange;
			         var lowerCurrency 		=  myObj.lowerCurrency;
			         var highBidAsk 		=  myObj.highBidAsk;
			         var highAskExchange 	=  myObj.highAskExchange;
					 var tableHtml 			=  myObj.html;
					
					 var currintDate  = new Date().toLocaleString();
					 $(".userDate").html("");	
					 $(".userDate").html(currintDate);


			        $("#higerUsdt > tbody").html("");
			        $("#higerUsdt > tbody").html(tableHtml);
			        $("#lowerExchangeCurrency").html("");	
			        $("#highExchangeCurrency").html("");	
			        $("#lowerExchangeCurrency").html(lowerCurrency);	
			        $("#highExchangeCurrency").html(higherCurrency);	
			        $("#higherBidCurrency").html("");	
			        $("#higherBidPrice").html("");
			        $("#higherBidCurrency").html(highAskExchange);	
			        $("#higherBidPrice").html(highBidAsk);
			        $("#higerUsdt").show();
					$("#highPriceTable").show();
					$("#highBidTable").show();
			    }
			});
		});



		$(window).load(function(){

		/*this is another*/	
			$.ajax({
			    type: 'POST',
			    dataType: "json",
			    url: "index.php",
			    data: "DATA=LTCBTC",
			    success: function (data) {
			         var myObj = data;

			         alert(myObj);

			    }
			});
		});
</script>  
</head>

<body>
		<div class="container">
				<h2 align="center">Token Spreads</h2>
				<h4 align="center">crypto Spread Monitoring And Alerts</h4>
		
		<div class="col-xs-12">	
				<h1><i class="material-icons">Top</i>Top Spreads</h1>
		</div>

		<div class="col-md-12">	
				<div class="col-md-4">
				    <table id="higerUsdt" class="table table-striped table-bordered">
				       	<tbody>
  						</tbody>
				    </table>
				  </div>

				  <div class="col-md-4">
				  			<table id="highPriceTable" class="table table-striped table-bordered" >
						        <tr>
						          <th colspan="2">High Price Spread</th>
						        </tr>
						        <tr>
						          <th colspan="2"><p id="userDate" class="userDate"></p></th>
						      	</tr>
						      		<tr>      
						      			<td class="latest-feature data-price-max"> 
						      				<span class="latest-exchange">
						      					Low Exchange: <strong id="lowerExchangeCurrency"></strong>
						      				<br>High Exchange: <strong id="highExchangeCurrency"></strong></span>      
						      			</td>
						      		</tr>
						    </table>

				  </div>




				  <div class="col-md-4">

				  			<table id="highBidTable" class="table table-striped table-bordered" >
						        <tr>
						          <th>High Bid Ask Spread</th>
						        </tr>

						        <tr>
						          <th><p id="userDate" class="userDate"></p></th>
						      	</tr>
						      	<tr>      
						      		
						      			<td  class="latest-feature data-price-max"> 
						      				<span class="latest-exchange">
						      				High Exchange: <strong id="higherBidCurrency"></strong>
						      				<br>
						      				High Exchange Bid Ask: <strong id="higherBidPrice"></strong>
						      				</span>      
						      	</td>

						      		</tr>
						    </table>
				  </div>
		</div>
			<div class="col-xs-12">	
				<h1><i class="material-icons">tune</i> Exchange Spreads</h1>
			</div>
		 	
				<table id="datatables" class="table table-striped table-bordered" >

								<tr>       
									 <th><?php echo 'LTC/BTC';?></th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th> 
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr> 
										<th colspan="11"><p id="userDate" class="userDate" style="text-align: center;"></p></th>
								</tr>

								<tr>       
									 <th>Currency Pair</th> 
									 <th class="mobile-d-all">Exchange A</th> 
									 <th class="mobile-d-all">Exchange B</th> 
									 <th class="mobile-d-all">Last Price (Exchange A)</th> 
									 <th class="mobile-d-all">Last Price (Exchange B)</th> 
									 <th class="mobile-d-all">Spread %</th>
									 <th class="mobile-d-all">Spread(1000 USDT)</th>
									 <th class="mobile-d-all">Spread(2000 USDT)</th>
									 <th class="mobile-d-all">Spread(3000 USDT)</th>
									 <th class="mobile-d-all">Spread(4000 USDT)</th>
									 <th class="mobile-d-all">Spread(5000 USDT)</th>
								</tr>
<!--liqui-->

								 <tr>
				          			 <td>LTC/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','LTC/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','LTC/BTC');?></td> 
									 <td>
									 	<?php 
									 		echo getSpreadPercentage(getLastPriceOfExchage('liqui','LTC/BTC'),getLastPriceOfExchage('hitbtc','LTC/BTC'));
									 	?>
									 </td> 

									 <?php
									 	$LIQUILTC1 = calculateUSDT('liqui','hitbtc','LTC/BTC');
									 ?>
									 <td><?php
									 		if(count($LIQUILTC1)>0){
									 			echo $LIQUILTC1[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC1)>0){
									 			echo $LIQUILTC1[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC1)>0){
									 			echo $LIQUILTC1[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC1)>0){
									 			echo $LIQUILTC1[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC1)>0){
									 			echo $LIQUILTC1[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 
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
									  

									 <?php
									 	$LIQUILTC2 = calculateUSDT('liqui','okax','LTC/BTC');
									 ?>

									 <td><?php
									 		if(count($LIQUILTC2)>0){
									 			echo $LIQUILTC2[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC2)>0){
									 			echo $LIQUILTC2[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC2)>0){
									 			echo $LIQUILTC2[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC2)>0){
									 			echo $LIQUILTC2[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC2)>0){
									 			echo $LIQUILTC2[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>


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
									 
									 <?php
									 	$LIQUILTC3 = calculateUSDT('liqui','binance','LTC/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC3)>0){
									 			echo $LIQUILTC3[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC3)>0){
									 			echo $LIQUILTC3[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC3)>0){
									 			echo $LIQUILTC3[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC3)>0){
									 			echo $LIQUILTC3[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC3)>0){
									 			echo $LIQUILTC3[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>


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
									 
									 
									 
									<?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('hitbtc','liqui','LTC/BTC');
									?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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
 

									 <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('hitbtc','binance','LTC/BTC');
									?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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
									
									 <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('hitbtc','okax','LTC/BTC');
									?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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

									


									 <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('okax','liqui','LTC/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

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

									

									 
									 <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('okax','binance','LTC/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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

									

									<?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('okax','hitbtc','LTC/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr> 
										<th colspan="11"><p id="userDate" class="userDate" style="text-align: center;"></p></th>
								</tr>


								<tr>       
									 <th>Currency Pair</th> 
									 <th class="mobile-d-all">Exchage A</th> 
									 <th class="mobile-d-all">Exchage B</th> 
									 <th class="mobile-d-all">Last Price (exchage A)</th> 
									 <th class="mobile-d-all">Last Price (exchage B)</th> 
									 <th class="mobile-d-all">Spread %</th>
									 <th class="mobile-d-all">Spread(1000 USDT)</th>
									 <th class="mobile-d-all">Spread(2000 USDT)</th>
									 <th class="mobile-d-all">Spread(3000 USDT)</th>
									 <th class="mobile-d-all">Spread(4000 USDT)</th>
									 <th class="mobile-d-all">Spread(5000 USDT)</th>
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

									 

									 <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('liqui','hitbtc','DASH/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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

									 	

										  <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('liqui','okax','DASH/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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
									
									 <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('liqui','binance','DASH/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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
									
									

									 <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('hitbtc','liqui','DASH/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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

									 <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('hitbtc','binance','DASH/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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
									 
									 <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('hitbtc','okax','DASH/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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

									 
									 
									  <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('okax','liqui','DASH/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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
									
									 
									  <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('okax','binance','DASH/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
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

									 
									   <?php
									  	$LIQUILTC4 = array();
									 	$LIQUILTC4 = calculateUSDT('okax','hitbtc','DASH/BTC');
									 ?>
									 
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[0];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[1];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>

									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[2];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[3];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
									 <td><?php
									 		if(count($LIQUILTC4)>0){
									 			echo $LIQUILTC4[4];
									 		}else{
									 			echo 'not found';
									 		}
									 ?></td>
								</tr>



<!--STEEM/BTC-->
				</table>
		</div>
</body>

</html>







 