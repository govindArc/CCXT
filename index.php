<?php
	include 'header.php';
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
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="/js/app.js"></script>
	<script type="text/javascript" language="javascript">  
		

		$(window).load(function() {

			document.getElementById("userDate").innerHTML = Date();
			setInterval(function(){
				location.reload();
			 }, 15000);
		});  	

		/*
		$(window).load(function() {
		 // executes when complete page is fully loaded, including all frames, objects and images
		  $.ajax({  
	             type:"POST",
	             data: {requiest: "success",},  
	             url:"higherexchange.php",  
	             success:function(data){  
	                alert(data);  
	             }  
     		});
		});
		 $(window).load(function(){
		 	$.ajax({  
		             type:"POST",  
		             data: {requiest: "success",},  
		             url:"higherexchange.php",  
		             success:function(data){  
		              	var finaldata = $.parseJSON(data);	

		              	alert('lowerExchange Data '+finaldata.lowerExchange);

		                
		             }  
		     });
		 });  
*/
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
				    <table id="latest-btc">
				       <tr>
				         <th colspan="2">Latest BTC/USDT Price Spreads</th>
				         
				       </tr>

				       <tr>
				         <th colspan="2"><p id="userDate"></p></th>
				       </tr>

				       
				       <tr>
				            <td>kucoin</td>
				            <td><?php echo getLastPriceOfExchage('kucoin','BTC/USDT');?></td>
				       </tr>
				       <tr>          
				      		<td>bittrex</td> 
				      		<td><?php echo getLastPriceOfExchage('bittrex','BTC/USDT');?></td>
				       </tr>
				       <tr> 
				      		<td>gateio</td>  
				      		<td><?php echo getLastPriceOfExchage('gateio','BTC/USDT');?></td>
				       </tr>
				       <tr>          
				      		<td>tidex</td>
				      		<td><?php echo getLastPriceOfExchage('tidex','BTC/USDT');?></td>
				       </tr>
				       <tr>  <td>cryptopia</td>
				             <td><?php echo getLastPriceOfExchage('cryptopia','BTC/USDT');?></td>
				        </tr>
				        <tr>  
				        	  <td>zb</td>
				        	  <td><?php echo getLastPriceOfExchage('zb','BTC/USDT');?></td>
				        </tr>
				        <tr>   
				        		<td>exmo</td>
				        		<td><?php echo getLastPriceOfExchage('exmo','BTC/USDT');?></td>
				        </tr>
				    </table>
				  </div>

				  <div class="col-md-4">
				  			<table id="latest-spread-price">
						        <tr>
						          <th colspan="2">High Price Spread</th>
						        </tr>
						        <tr>
						          <th colspan="2"><p id="userDate"></p></th>
						      	</tr>
						      		<tr>      
						      			<td class="latest-feature data-price-max"> 
						      				<span class="latest-exchange">Low Exchange: <strong><?php echo $lowerCurrency;?></strong>
						      				<br>High Exchange: <strong><?php echo $higherCurrency; ?></strong></span>      
						      			</td>
						      		</tr>
						    </table>

				  </div>


				  <div class="col-md-4">

				  			<table id="latest-spread-price">
						        <tr>
						          <th colspan="2">High Bid Ask Spread</th>
						        </tr>

						        <tr>
						          <th colspan="2"><p id="userDate"></p></th>
						      	</tr>
						      		<tr>      
						      			<td class="latest-feature data-price-max"> 
						      				<span class="latest-exchange">
						      				High Exchange: <strong><?php echo $highAskExchange; ?></strong>
						      				</span>      
						      			</td>

						      		</tr>
						    </table>

				  </div>




				  


		</div>


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
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>

								</tr>
								<tr> 
										<th colspan="10"><p id="userDate" style="text-align: center;"></p></th>
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
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','LTC/BTC'),getLastPriceOfExchage('hitbtc','LTC/BTC')); ?>
									 </td> 

									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 
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
									  <td>Spread(1000 USDT)</td> 
									 <td>Spread(2000 USDT)</td> 
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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
									  <td>Spread(1000 USDT)</td> 
									 <td>Spread(2000 USDT)</td> 
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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

									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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
								</tr>
								<tr> 
										<th colspan="10"><p id="userDate" style="text-align: center;"></p></th>
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

									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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
									 	<td>&nbsp;</td> 
										 <td>&nbsp;</td> 
										 <td>&nbsp;</td> 
										 <td>&nbsp;</td> 
										 <td>&nbsp;</td>  
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									  <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									  <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									  <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									  <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr> 
										<th colspan="10"><p id="userDate" style="text-align: center;"></p></th>
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
				          			 <td>1ST/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','1ST/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','1ST/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','1ST/BTC'),getLastPriceOfExchage('hitbtc','1ST/BTC')); ?>
									 </td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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
									  	<td>&nbsp;</td> 
										<td>&nbsp;</td> 
										<td>&nbsp;</td> 
										<td>&nbsp;</td> 
										<td>&nbsp;</td>  
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
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr> 
										<th colspan="10"><p id="userDate" style="text-align: center;"></p></th>
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
				          			 <td>1ST/ETH</td> 	
				          			 <td>LIQUI</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','1ST/ETH');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','1ST/ETH');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','1ST/ETH'),getLastPriceOfExchage('hitbtc','1ST/ETH')); ?>
									 </td>

									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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

									<td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
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
									 <th>&nbsp;</th>
									 <th>&nbsp;</th>
								</tr>
								<tr> 
										<th colspan="10"><p id="userDate" style="text-align: center;"></p></th>
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
				          			 <td>STEEM/BTC</td> 	
				          			 <td>LIQUI</td> 
									 <td>HITBTC</td> 
									 <td><?php echo  getLastPriceOfExchage('liqui','STEEM/BTC');?></td>
									 <td><?php echo  getLastPriceOfExchage('hitbtc','STEEM/BTC');?></td> 
									 <td>
									 	<?php echo getSpreadPercentage(getLastPriceOfExchage('liqui','STEEM/BTC'),getLastPriceOfExchage('hitbtc','STEEM/BTC')); ?>
									 </td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									<td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									<td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
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
									  <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td> 
									 <td>&nbsp;</td>  
								</tr>
<!--STEEM/BTC-->
				</table>
		</div>
</body>

</html>







 