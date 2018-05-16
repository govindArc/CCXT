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
		$exchanegArrayA =  ["liqui","liqui","liqui","hitbtc","hitbtc","hitbtc","okax","okax","okax"];
		$exchanegArrayB =  ["hitbtc","okax","binance","liqui","binance","okax","liqui","binance","hitbtc"];
 		
 		getResultSet($exchanegArrayA,$exchanegArrayB,$exhageCurrency,"LTCBTC");
		die;
	}





	if(isset($_POST["DATA"]) && $_POST["DATA"] == "DASHBTC"){

		$exhageCurrency  = "DASH/BTC";
		$exchanegArrayA =  ["liqui","liqui","liqui","hitbtc","hitbtc","hitbtc","okax","okax","okax"];
		$exchanegArrayB =  ["hitbtc","okax","binance","liqui","binance","okax","liqui","binance","hitbtc"];


		 
		getResultSet($exchanegArrayA,$exchanegArrayB,$exhageCurrency,"DASHBTC");
		die;

	}






//bittrexObj,cryptopiaObj,tidexObj,gateioObj,kucoinObj,zbObj,binanceObj,hitbtcObj,liquiObj,okexObj[ETH/USDT],

if(isset($_POST["DATA"]) && $_POST["DATA"] == "ETH"){
	//ETH/BTC	
	$exhageCurrency  = "ETH/BTC";
	$exchanegArrayA = ["kucoin","gateio","tidex","cryptopia","bittrex"]; 
	$exchanegArrayB = ["gateio","kucoin","kucoin","kucoin","kucoin"]; 
	getResultSet($exchanegArrayA,$exchanegArrayB,$exhageCurrency,"ETH");
	die;
}	 



if(isset($_POST["DATA"]) && $_POST["DATA"] == "BTCUSDT"){
	   // BTC/USDT kucoin gateio tidex  bittrex cryptopia
		$exhageCurrency  = "BTC/USDT";

		$exchanegArrayA =  ["kucoin","kucoin","gateio","gateio","tidex","tidex","bittrex","bittrex","cryptopia","cryptopia"];
		$exchanegArrayB =  ["bittrex","cryptopia","bittrex","cryptopia","bittrex","cryptopia","tidex","cryptopia","tidex","bittrex"];
		getResultSet($exchanegArrayA,$exchanegArrayB,$exhageCurrency,"BTCUSDT");
		die;
}







	

function getResultSet($exchanegArrayA,$exchanegArrayB,$exhageCurrency,$key){

	$html =  "<tr>       
					 <th>".$exhageCurrency."</th> 
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
						<th colspan='11'><p class='timedate'></p></th>
				</tr>
				<tr>       
					 <th>Currency Pair</th> 
					 <th class='mobile-d-all'>Exchange A</th> 
					 <th class='mobile-d-all'>Exchange B</th> 
					 <th class='mobile-d-all'>Last Price (Exchange A)</th> 
					 <th class='mobile-d-all'>Last Price (Exchange B)</th> 
					 <th class='mobile-d-all'>Spread %</th>
					 <th class='mobile-d-all'>Spread(1000 USDT)</th>
					 <th class='mobile-d-all'>Spread(2000 USDT)</th>
					 <th class='mobile-d-all'>Spread(3000 USDT)</th>
					 <th class='mobile-d-all'>Spread(4000 USDT)</th>
					 <th class='mobile-d-all'>Spread(5000 USDT)</th>
				</tr>";	



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

		 echo json_encode(array($key=>$html));
		 
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

    <style type="text/css">
			.loader {
			    border: 16px solid #f3f3f3; /* Light grey */
			    border-top: 16px solid #3498db; /* Blue */
			    border-radius: 50%;
			    width: 60px;
			    height: 60px;
			    animation: spin 2s linear infinite;
			    margin-left: auto;
				margin-right: auto;
			}
			@keyframes spin {
			    0% { transform: rotate(0deg); }
			    100% { transform: rotate(360deg); }
			}


			.customBtn {
				width: 80%;
				color: #fff;
				background-color: #5bc0de;
				border-color: #46b8da;
				display: inline-block;
				padding: 6px 12px;
				margin-bottom: 0;
				font-size: 14px;
				font-weight: 400;
				line-height: 1.42857143;
				text-align: center;
				white-space: nowrap;
				vertical-align: middle;
				-ms-touch-action: manipulation;
				touch-action: manipulation;
				cursor: pointer;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				background-image: none;
				border: 1px solid transparent;
				border-radius: 4px;
			}


			.activeBtn {
				width: 80%;
				color: #fff;
				background-color: #337ab7;
				border-color: #2e6da4;
				display: inline-block;
				padding: 6px 12px;
				margin-bottom: 0;
				font-size: 14px;
				font-weight: 400;
				line-height: 1.42857143;
				text-align: center;
				white-space: nowrap;
				vertical-align: middle;
				-ms-touch-action: manipulation;
				touch-action: manipulation;
				cursor: pointer;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				background-image: none;
				border: 1px solid transparent;
				border-radius: 4px;

			}	
    </style>
    <script type="text/javascript">
		//	btn-usdt,btn-etc,btn-etc
    </script>
<script type="text/javascript" language="javascript">  



 

function onClickBtn(btn_id){
	if(btn_id == "btn-usdt"){
		$("#USDT").show();
		$("#ETH").hide();
		$("#BTCUSDT").hide();
		document.getElementById("btn-btc").classList.remove('activeBtn');
		document.getElementById("btn-btc").classList.add('customBtn');
		document.getElementById("btn-eth").classList.remove('activeBtn');
		document.getElementById("btn-eth").classList.add('customBtn');

	}else if(btn_id == "btn-eth"){
		$("#USDT").hide();
		$("#BTCUSDT").hide();
		$("#ETH").show();
		document.getElementById("btn-btc").classList.remove('activeBtn');
		document.getElementById("btn-btc").classList.add('customBtn');
		document.getElementById("btn-usdt").classList.remove('activeBtn');
		document.getElementById("btn-usdt").classList.add('customBtn');

	}else {
		// btn-btc
		$("#USDT").hide();
		$("#ETH").hide();
		$("#BTCUSDT").show();
		document.getElementById("btn-eth").classList.remove('activeBtn');
		document.getElementById("btn-eth").classList.add('customBtn');
		document.getElementById("btn-usdt").classList.remove('activeBtn');
		document.getElementById("btn-usdt").classList.add('customBtn');
	}

	document.getElementById(btn_id).classList.add('activeBtn');
	document.getElementById(btn_id).classList.remove('customBtn');
}




function activeBtnBtc(){
	$("#USDT").hide();
	$("#BTCUSDT").hide();
	$("#ETH").show();
	document.getElementById("btn-btc").classList.add('activeBtn');
	document.getElementById("btn-btc").classList.remove('customBtn');
}





$(document).ready(function(){
	
	activeBtnBtc();

		var loader = "<tr><th colspan='11'><div class='loader'></div></th></tr>";
			$("#DASHBTC > tbody").html(loader);
			$("#LTCBTC > tbody").html(loader);
			$("#BTCUSDT > tbody").html(loader);
			$("#ETH > tbody").html(loader);
			

			

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



			/*this is LTC BTC*/


			$.ajax({
			    type: 'POST',
			    dataType: "json",
			    url: "index.php",
			    data: "DATA=LTCBTC",
			    success: function (data) {
			         var myObj 		= data;
			         var LTCBTC 	= myObj.LTCBTC;

			         $("#LTCBTC > tbody").html("");
			         $("#LTCBTC > tbody").html(LTCBTC);
			         
			         var currintDate  = new Date().toLocaleString();
			         $(".timedate").html("");	
					 $(".timedate").html(currintDate); 	
			    }
			});


			$.ajax({
			    type: 'POST',
			    dataType: "json",
			    url: "index.php",
			    data: "DATA=DASHBTC",
			    success: function (data) {
			         var myObj 		= data;
			         var DASHBTC 	= myObj.DASHBTC;
			         $("#DASHBTC > tbody").html("");
			         $("#DASHBTC > tbody").html(DASHBTC);
			         var currintDate  = new Date().toLocaleString();
			         $(".timedate").html("");	
					 $(".timedate").html(currintDate); 	
			    }
			});


			$.ajax({
			    type: 'POST',
			    dataType: "json",
			    url: "index.php",
			    data: "DATA=BTCUSDT",
			    success: function (data) {
			         var myObj 		= data;
			         var BTCUSDT 	= myObj.BTCUSDT;
			         
			         $("#BTCUSDT > tbody").html("");
			         $("#BTCUSDT > tbody").html(BTCUSDT);
			         var currintDate  = new Date().toLocaleString();
			         $(".timedate").html("");	
					 $(".timedate").html(currintDate); 	
			    }
			});


			$.ajax({
			    type: 'POST',
			    dataType: "json",
			    url: "index.php",
			    data: "DATA=ETH",
			    success: function (data) {
			         var myObj 	= data;
			         var ETH 	= myObj.ETH;
			        
			         $("#ETH > tbody").html("");
			         $("#ETH > tbody").html(ETH);
			         var currintDate  = new Date().toLocaleString();
			         $(".timedate").html("");	
					 $(".timedate").html(currintDate); 	
			    }
			});




		//ETH


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
				<div class="col-xs-12">	
						<div class="col-xs-6" style="float: right">	
							<div class="row">
									
								<div class="col-xs-4">
										<button onclick="onClickBtn(this.id)" class="btn customBtn" id="btn-btc">BTC</button>
								</div>	
								<div class="col-xs-4">
										<button class="btn customBtn" onclick="onClickBtn(this.id)" id="btn-eth">ETH</button>
								</div>

								<div class="col-xs-4">
										<button class="btn customBtn" onclick="onClickBtn(this.id)" id="btn-usdt">USDT</button>
								</div>

							</div>	
							 	
						</div>
				</div>

 				<table id="USDT" class="table table-striped table-bordered table-responsive" >
						<tbody></tbody>
				</table>	
				 
				<table id="ETH" class="table table-striped table-bordered table-responsive" >
					<tbody></tbody>
				</table>	
				 
				<table id="BTCUSDT" class="table table-striped table-bordered table-responsive">
					<tbody></tbody>
				</table>	
				 
				<table id="LTCBTC" class="table table-striped table-bordered table-responsive" >
					<tbody></tbody>
				</table>

				<table id="DASHBTC" class="table table-striped table-bordered table-responsive" >
						<tbody></tbody>
				</table>
				 
		</div>
</body>
</html>







 