<?php
date_default_timezone_set('UTC');
include 'ccxt.php';
define("huobi","huobi");
define("okex","okex");
define("liqui","liqui");
define("hitbtc","hitbtc");
define("binance","binance");
define("zb","zb");
define("kucoin","kucoin");
define("gateio","gateio");
define("tidex","tidex");
define("cryptopia","cryptopia");
define("bittrex","bittrex");
$accodendeAssetsUSDT    =     ["1000","2000","3000","4000","5000"]; 
$accodendeAssetsBTC     =     ["0.1","0.2","0.3","0.4","0.5"]; 
$accodendeAssetsETH     =     ["10","20","30","40","50"]; 
$huobiObj   	= new \ccxt\huobi(); // BTC/CNY , LTC/CNY
$okexObj   		= new \ccxt\okex(); // DASH/BTC ,LTC/BTC   // ETH/USDT ETH/USD
$liquiObj   	= new \ccxt\liqui(); // 1ST/BTC 1ST/ETH LTC/BTC DASH/BTC STEEM/BTC
									//	BTC/USDT, //ETH/USDT,ETH/BTC
$hitbtcObj  	= new \ccxt\hitbtc(); // 1ST/BTC 1ST/ETH LTC/BTC DASH/BTC STEEM/BTC ETH/BTC,ETH/USDT
$binanceObj   	= new \ccxt\binance(); // LTC/BTC STEEM/BTC DASH/btc //ETH/BTC  ETH/USDT 
/*top spreads*/ //BTC/USD 
//$poloniexObj  = new \ccxt\poloniex();  not free
//$biboxObj   	= new \ccxt\bibox();   not free
$zbObj   		= new \ccxt\zb();           // BTC/USDTx
				// BTC/USDT,BTC/QC // ETH/BTC,ETH/QC,ETH/USDT // USDT/QC
$kucoinObj   	= new \ccxt\kucoin();   	// BTC/USDT
				//BTC/USDT, ETH/USDT, ETH/BTC
$gateioObj   	= new \ccxt\gateio();  		// BTC/USDT  
				//BTC/USDT,ETH/BTC,ETH/USDT
$tidexObj   	= new \ccxt\tidex();     // BTC/USDT  
				//BTC/USDT,BTC/WEUR,BTC/WUSD,ETH/BTC,ETH/USDT,ETH/WAVES,ETH/WEUR,ETH/WUSD
$cryptopiaObj 	= new \ccxt\cryptopia();  // BTC/USDT  
				//	BTC/USDT,BTC/NZDT  ETH/BTC,ETH/USDT,ETH/DOGE,ETH/LTC,ETH/NZDT
$exmoObj   		= new \ccxt\exmo();  // BTC/USDT  
$bittrexObj  	= new \ccxt\bittrex(); 	// BTC/USDT  
 
//$liquiObj,$binanceObj;
// ETH/BTC
$ExchangeA = constant("liqui");
$ExchangeB = constant("binance"); 


//$binanceObj->

$pair = "ETH/BTC";
echo "<h2 align='center'>[TYPE A TO A CALCULATION ]</h2>";
echo '<br>';
echo "<h2 align='center'>Exchange A Is [liqui hence we get to use buy object] and exchange b is [tidex use ask sell object] </h2>";
echo '<br>';
echo '<br>';
echo "liqui last price";
echo getLastPriceOfExchage(constant("liqui"),$pair);
echo "<br>";
echo "<br>";
echo "binance last price";
echo getLastPriceOfExchage(constant("tidex"),$pair);
echo "<br>";
echo "<br>";
echo "here order book liqui IN ACTUAL ORDER ";
echo json_encode(getOrderBook(constant("liqui"),$pair,"exchangeB"));
echo "<br>";
echo "<br>";
echo "here order book liqui IN REVERSE FOR BUYING POWER ";
echo json_encode(getOrderBook(constant("liqui"),$pair,"exchangeA"));
echo "<br>";
echo "<br>";
echo "here order book tidex";
echo json_encode(getOrderBook(constant("tidex"),$pair,"exchangeB"));
echo "<br>";
echo "<br>";
//
GetTypeAExchangeBUY(getOrderBook(constant("liqui"),$pair,"exchangeA"),"ETH");
//exchange A sell exchange b buy 
/// data array price/value  type // USDT,ETH,BTC //  
function GetTypeAExchangeSELLbyAssets($dataArray,$calulationFor,$finalBuyValue,$i){
    $firstValue1 = 0;
    $firstValue2 = 0;
    $firstValue3 = 0;
    $firstValue4 = 0;
    $firstValue5 = 0;
    $secondValue = 0;
    $thirdValue  = 0;
    $finalValue  = 0;
    $secondColumn1 = 0;
    $secondColumn2 = 0;
    $secondColumn3 = 0;
    $secondColumn4 = 0;
    $secondColumn5 = 0;
    $spreadMarginPercent = 0;
	global $accodendeAssetsUSDT,$accodendeAssetsETH,$accodendeAssetsBTC;
	
    $flagValue = "BTC";
        if($calulationFor == "USDT"){
            $accodendeAssets =   $accodendeAssetsUSDT;
            $flagValue = "USDT";
        }else if ($calulationFor == "ETH"){
            $accodendeAssets =   $accodendeAssetsETH;
            $flagValue = "ETH";
        }else{
            $accodendeAssets =   $accodendeAssetsBTC;
        }
        // get five price volume pair
        $priceVolumePair1 = $dataArray[0];
        $priceVolumePair2 = $dataArray[1];
        $priceVolumePair3 = $dataArray[2];
        $priceVolumePair4 = $dataArray[3];
        $priceVolumePair5 = $dataArray[4];
        //excel yellow 
        $price1           = $priceVolumePair1[0];
        $price2           = $priceVolumePair2[0];
        $price3           = $priceVolumePair3[0];
        $price4           = $priceVolumePair4[0];
        $price5           = $priceVolumePair5[0];
        //excel green 
        $volume1           = $priceVolumePair1[1];
        $volume2           = $priceVolumePair2[1];
        $volume3           = $priceVolumePair3[1];
        $volume4          = $priceVolumePair4[1];
        $volume5          = $priceVolumePair5[1];
        $responseArray = [];
        /// loop
      //  for ($i=0; $i < 5; $i++) {
            $secondValue    = 0;
            $thirdValue     = 0;
            $calualteAssets =    $accodendeAssets[$i];
            
            /// all calculation of first value
            $firstValue1 = $volume1 / $price1;
            $firstValue2 = $volume2 / $price2;
            $firstValue3 = $volume3 / $price3;
            $firstValue4 = $volume4 / $price4;
            $firstValue5 = $volume5 / $price5;
            
            $secondColumn1 = $finalBuyValue - $firstValue1;
            $secondColumn2 = $secondColumn1 - $firstValue2;
            $secondColumn3 = $secondColumn2 - $firstValue3;
            $secondColumn4 = $secondColumn3 - $firstValue4;
            $secondColumn5 = $secondColumn4 - $firstValue5;
            ///  check positive buying power 
            if(($secondColumn1 > 0  && $secondColumn2 > 0 && $secondColumn3 > 0 && $secondColumn4 > 0 && $secondColumn5 > 0) || ($secondColumn1 < 0  && $secondColumn2 < 0 && $secondColumn3 < 0 && $secondColumn4 < 0 && $secondColumn5 < 0)){
                 /// all positive and all negative
                 $secondValue = $finalBuyValue / $price1;
            }else{
                $secondValue = $volume1 / $price1;
			}
			

			if (($secondColumn1 < 0)){
                // if first value is negative
                $thirdValue = $firstValue1 / $price1;
            }
            
            
            $finalValue  = $secondValue + $thirdValue;
            // ACCORDANCE ASSET * 100
            $spreadMarginPercent =  (($finalValue - $calualteAssets)/$calualteAssets * 100);
            $responseArray["fvalue1"] = $firstValue1;
            $responseArray["fvalue2"] = $firstValue2;
            $responseArray["fvalue3"] = $firstValue3;
            $responseArray["fvalue4"] = $firstValue4;
            $responseArray["fvalue5"] = $firstValue5;
            $responseArray["svalue1"] = $secondColumn1;
            $responseArray["svalue2"] = $secondColumn2;
            $responseArray["svalue3"] = $secondColumn3;
            $responseArray["svalue4"] = $secondColumn4;
            $responseArray["svalue5"] = $secondColumn5;
            $responseArray["secondValue"] = $secondValue;
            $responseArray["thirdValue"] = $thirdValue;
            $responseArray["finalValue"] = $finalValue;
            $responseArray["spreadMarginPercent"] = $spreadMarginPercent;
            $finalArray[$flagValue." ".$calualteAssets] = $responseArray;
      //  }
        echo "this is it sell power tidex result set </br>";
        echo json_encode($finalArray);
}




function GetTypeAExchangeSELL($dataArray,$calulationFor,$finalBuyValue){
    $firstValue1 = 0;
    $firstValue2 = 0;
    $firstValue3 = 0;
    $firstValue4 = 0;
    $firstValue5 = 0;
    $secondValue = 0;
    $thirdValue  = 0;
    $finalValue  = 0;
    $secondColumn1 = 0;
    $secondColumn2 = 0;
    $secondColumn3 = 0;
    $secondColumn4 = 0;
    $secondColumn5 = 0;
    $spreadMarginPercent = 0;
    global $accodendeAssetsUSDT,$accodendeAssetsETH,$accodendeAssetsBTC;
    $flagValue = "BTC";
        if($calulationFor == "USDT"){
            $accodendeAssets =   $accodendeAssetsUSDT;
            $flagValue = "USDT";
        }else if ($calulationFor == "ETH"){
            $accodendeAssets =   $accodendeAssetsETH;
            $flagValue = "ETH";
        }else{
            $accodendeAssets =   $accodendeAssetsBTC;
        }
        // get five price volume pair
        $priceVolumePair1 = $dataArray[0];
        $priceVolumePair2 = $dataArray[1];
        $priceVolumePair3 = $dataArray[2];
        $priceVolumePair4 = $dataArray[3];
        $priceVolumePair5 = $dataArray[4];
        //excel yellow 
        $price1           = $priceVolumePair1[0];
        $price2           = $priceVolumePair2[0];
        $price3           = $priceVolumePair3[0];
        $price4           = $priceVolumePair4[0];
        $price5           = $priceVolumePair5[0];
        //excel green 
        $volume1           = $priceVolumePair1[1];
        $volume2           = $priceVolumePair2[1];
        $volume3           = $priceVolumePair3[1];
        $volume4          = $priceVolumePair4[1];
        $volume5          = $priceVolumePair5[1];
        $responseArray = [];
        /// loop
        for ($i=0; $i < 5; $i++) {
            $secondValue    = 0;
            $thirdValue     = 0;
            $calualteAssets =    $accodendeAssets[$i];
            
            /// all calculation of first value
            $firstValue1 = $volume1 / $price1;
            $firstValue2 = $volume2 / $price2;
            $firstValue3 = $volume3 / $price3;
            $firstValue4 = $volume4 / $price4;
            $firstValue5 = $volume5 / $price5;
            $secondColumn1 = $finalBuyValue - $firstValue1;
            $secondColumn2 = $secondColumn1 - $firstValue2;
            $secondColumn3 = $secondColumn2 - $firstValue3;
            $secondColumn4 = $secondColumn3 - $firstValue4;
            $secondColumn5 = $secondColumn4 - $firstValue5;
            ///  check positive buying power 
            if(($secondColumn1 > 0  && $secondColumn2 > 0 && $secondColumn3 > 0 && $secondColumn4 > 0 && $secondColumn5 > 0) || ($secondColumn1 < 0  && $secondColumn2 < 0 && $secondColumn3 < 0 && $secondColumn4 < 0 && $secondColumn5 < 0)){
                 /// all positive and all negative
                 $secondValue = $finalBuyValue / $price1;
            }else if (($secondColumn1 < 0)){
                // if first value is negative
                $thirdValue = $firstValue1 / $price1;
            }else{
                $secondValue = $volume1 / $price1;
            } 
            $finalValue  = $secondValue + $thirdValue;
            // ACCORDANCE ASSET * 100
            $spreadMarginPercent =  (($finalValue - $calualteAssets)/$calualteAssets * 100);
          
            $responseArray["secondValue"] = $secondValue;
            $responseArray["thirdValue"] = $thirdValue;
            $responseArray["finalValue"] = $finalValue;
            $responseArray["spreadMarginPercent"] = $spreadMarginPercent;
            $finalArray[$flagValue." ".$calualteAssets] = $responseArray;
        
        }
        echo '<br>';
        echo "this is it sell power tidex result set </br>";
        echo json_encode($finalArray);
        echo '<br>';
} 
function GetTypeAExchangeBUY($dataArray,$calulationFor){
    $firstValue1 = 0;
    $firstValue2 = 0;
    $firstValue3 = 0;
    $firstValue4 = 0;
    $firstValue5 = 0;
    $secondValue = 0;
    $thirdValue  = 0;
    $finalValue  = 0;
    global $accodendeAssetsUSDT,$accodendeAssetsETH,$accodendeAssetsBTC;
    $flagValue = "BTC";
        if($calulationFor == "USDT"){
            $accodendeAssets =   $accodendeAssetsUSDT;
            $flagValue = "USDT";
        }else if ($calulationFor == "ETH"){
            $accodendeAssets =   $accodendeAssetsETH;
            $flagValue = "ETH";
        }else{
            $accodendeAssets =   $accodendeAssetsBTC;
        }
        // $assets1              =   $accodendeAssets[0];
        // $assets2              =   $accodendeAssets[1];
        // $assets3              =   $accodendeAssets[2];
        // $assets4              =   $accodendeAssets[3];
        // $assets5              =   $accodendeAssets[4];
      
        // get five price volume pair
        $priceVolumePair1 = $dataArray[0];
        $priceVolumePair2 = $dataArray[1];
        $priceVolumePair3 = $dataArray[2];
        $priceVolumePair4 = $dataArray[3];
        $priceVolumePair5 = $dataArray[4];
        //excel yellow 
        $price1           = $priceVolumePair1[0];
        $price2           = $priceVolumePair2[0];
        $price3           = $priceVolumePair3[0];
        $price4           = $priceVolumePair4[0];
        $price5           = $priceVolumePair5[0];
        //excel green 
        $volume1           = $priceVolumePair1[1];
        $volume2           = $priceVolumePair2[1];
        $volume3           = $priceVolumePair3[1];
        $volume4          = $priceVolumePair4[1];
        $volume5          = $priceVolumePair5[1];
        $responseArray = [];
        
        for ($i=0; $i < 5; $i++) { 
            $secondValue    = 0;
            $thirdValue     = 0;
            $calualteAssets =    $accodendeAssets[$i];
            
            $firstValue1 = $calualteAssets - $volume1;
            $firstValue2 = $firstValue1 - $volume2;
            $firstValue3 = $firstValue2 - $volume3;
            $firstValue4 = $firstValue3 - $volume4;
            $firstValue5 = $firstValue4 - $volume5;
            ///  check positive buying power 
            if(($firstValue1 > 0  && $firstValue2 > 0 && $firstValue3 > 0 && $firstValue4 > 0 && $firstValue5 > 0) || ($firstValue1 < 0  && $firstValue2 < 0 && $firstValue3 < 0 && $firstValue4 < 0 && $firstValue5 < 0)){
                 /// all positive and all negative
                 $secondValue = $calualteAssets * $price1;
            }else{
                $secondValue = $volume1 / $price1;
			} 
			
			if (($firstValue1 < 0)){
                // if first value is negative
                $thirdValue = $firstValue1 / $price2;
            }
            
            $finalValue = $thirdValue + $secondValue;
            $responseArray["fvalue1"] = $firstValue1;
            $responseArray["fvalue2"] = $firstValue2;
            $responseArray["fvalue3"] = $firstValue3;
            $responseArray["fvalue4"] = $firstValue4;
            $responseArray["fvalue5"] = $firstValue5;
            $responseArray["secondValue"] = $secondValue;
            $responseArray["thirdValue"] = $thirdValue;
			$responseArray["finalValue"] = $finalValue;
           $finalArray["data"] = $responseArray;
           echo '<br>';
           echo "this is buying power of liqui  ".$flagValue." ".$calualteAssets;
           echo json_encode($finalArray);
           echo '<br>';
           $pair = "ETH/BTC";
           
           GetTypeAExchangeSELLbyAssets(getOrderBook(constant("tidex"),$pair,"exchangeB"),"ETH",$finalValue,$i);
           echo '<br>'; 
        }
       // echo "this is it buying power liqui result set </br>";
      //  echo json_encode($finalArray);
       
        
 
     
}
// function typeAExchangeBuy($dataArray,$calulationFor){
   
//     global $accodendeAssetsUSDT,$accodendeAssetsETH,$accodendeAssetsBTC;
//     if($calulationFor == "USDT"){
//         $accodendeAssets =   $accodendeAssetsUSDT;
//     }else if ($calulationFor == "ETH"){
//         $accodendeAssets =   $accodendeAssetsETH;
//     }else{
//         $accodendeAssets =   $accodendeAssetsBTC;
//     } 
//     $cnt = 1;
//     $fvalue1 = "";
//     $fvalue2 = "";
//     $fvalue3 = "";
//     $fvalue4 = "";
//     $fvalue5 = "";
//     $secondValue = 0;
//     $thirdValue = 0;
//     $finalValue = 0;
//     //SECOND VALUE
//     $flagNegative =  false;
//     $Price1       = "";
//     $Price2       = "";
//     $data = [];
//     for ($j=0; $j < count($accodendeAssest); $j++) { 
//         // accodendeAssets value 
//             for ($i=0; $i < 5; $i++) { 
//                 $priceVolumePair =  $dataArray[$i];
//                 $price      = $priceVolumePair[0];
//                 $volume     = $priceVolumePair[1];
        
//                 if($cnt  == 1){
//                     $fvalue1  = $accodendeAssets[$j] - $volume; 
//                     $Price1   = $price;
//                     //$flagNegative
        
//                     if($fvalue1 < 0){
//                         $flagNegative = true; 
//                     }
        
//                 }else if($cnt == 2){
//                     $fvalue2 =  $fvalue1 - $volume;
//                     $Price2  = $price;
        
//                 }else if ($cnt == 3){
//                     $fvalue3 =  $fvalue2 - $volume;
//                 }else if ($cnt == 4){
//                     $fvalue4 =  $fvalue3 - $volume;
//                 }else if($cnt == 5){
//                     $fvalue5 =  $fvalue4 - $volume;
//                 }
//                 $cnt++;
//             }
        
//             if($flagNegative == false){
//                 /// checks all positive and all negative 
//                 if(($fvalue1 > 0 && $fvalue2 > 0 && $fvalue3  > 0 && $fvalue4  > 0 && $fvalue5  > 0) || ($fvalue1 < 0 && $fvalue2 < 0 && $fvalue3  < 0 && $fvalue4  < 0 && $fvalue5  < 0)){
//                     $secondValue = $accodendeAssets[0] * $Price1;
//                 } 
//             }else{
        
//                 $thirdValue  =  $fvalue1/$Price2;
//                 $finalValue  = $secondValue+$thirdValue;
        
//             }
//     }
// }
function getTypeACalculation($dataArray,$calulationFor){
    global $accodendeAssetsUSDT,$accodendeAssetsETH,$accodendeAssetsBTC;
    if($calulationFor == "USDT"){
        $accodendeAssets =   $accodendeAssetsUSDT;
    }else if ($calulationFor == "ETH"){
        $accodendeAssets =   $accodendeAssetsETH;
    }else{
        $accodendeAssets =   $accodendeAssetsBTC;
    } 
    
    $cnt = 1;
    $fvalue1 = "";
    $fvalue2 = "";
    $fvalue3 = "";
    $fvalue4 = "";
    $fvalue5 = "";
    $secondValue = 0;
    $thirdValue = 0;
    $finalValue = 0;
    //SECOND VALUE
    $flagNegative =  false;
    $Price1       = "";
    $Price2       = "";
    for ($i=0; $i < 5; $i++) { 
        $priceVolumePair =  $dataArray[$i];
        $price      = $priceVolumePair[0];
        $volume     = $priceVolumePair[1];
        if($cnt  == 1){
            $fvalue1  = $accodendeAssets[0] - $volume; 
            $Price1   = $price;
            //$flagNegative
            if($fvalue1 < 0){
                $flagNegative = true; 
            }
        }else if($cnt == 2){
            $fvalue2 =  $fvalue1 - $volume;
            $Price2  = $price;
        }else if ($cnt == 3){
            $fvalue3 =  $fvalue2 - $volume;
        }else if ($cnt == 4){
            $fvalue4 =  $fvalue3 - $volume;
        }else if($cnt == 5){
            $fvalue5 =  $fvalue4 - $volume;
        }
        $cnt++;
    }
    if($flagNegative == false){
         /// checks all positive and all negative 
        if(($fvalue1 > 0 && $fvalue2 > 0 && $fvalue3  > 0 && $fvalue4  > 0 && $fvalue5  > 0) || ($fvalue1 < 0 && $fvalue2 < 0 && $fvalue3  < 0 && $fvalue4  < 0 && $fvalue5  < 0)){
            $secondValue = $accodendeAssets[0] * $Price1;
        } 
    }else{
        $thirdValue  =  $fvalue1/$Price2;
        $finalValue  = $secondValue+$thirdValue;
    }
    
    echo "fvalue one ".$fvalue1."</br>";
    echo "fvalue two ".$fvalue2."</br>";
    echo "fvalue three ".$fvalue3."</br>";
    echo "fvalue four ".$fvalue4."</br>";
    echo "fvalue five ".$fvalue5."</br>";
    die;
}
// function typeAcalculation($dataArray,$type,$conversioType){
//     $finalArray = [];
//     // volume price  calculation
//     $accodendeAssets = "";
//     if($type == "USDT"){
//        $accodendeAssets =   $accodendeAssetsUSDT;
//     }else if ($type == "ETH"){
//         $accodendeAssets =   $accodendeAssetsETH;
//     }else{
//         $accodendeAssets =   $accodendeAssetsBTC;
//     }
//     // here we check conversion type 
//     if($conversioType = "TYPEA"){
//             for ($i=0; $i < $accodendeAssets.count; $i++) { 
//                 echo $accodendeAssets[$i];
               
//             }
//     }else if ($conversioType = "TYPEB"){
//     }else if ($conversioType = "TYPEC"){
//     }else{
//            // TYPE D
//     }
// }
// here 
function getValuePair($dataArray,$accodendeAssest){
}
function getSpreadPercentage($ExchangeOne,$ExchangeTwo) {
	return (($ExchangeOne-$ExchangeTwo)/$ExchangeOne)*100;
} 
function getOrderBook($exchnage,$exchangePair,$type){
    $limit = 5;
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
    if($exchnage == constant("huobi")){
        $finalData = $huobiObj->fetch_order_book($exchangePair, $limit);
    }elseif($exchnage == constant("okex")){
        $finalData = $okexObj->fetch_order_book($exchangePair, $limit);
    }elseif($exchnage == constant("liqui")){
        $finalData = $liquiObj->fetch_order_book($exchangePair, $limit);
    }elseif($exchnage == constant("hitbtc")){
        $finalData = $hitbtcObj->fetch_order_book($exchangePair, $limit);
    }elseif($exchnage == constant("binance")){
        $finalData = $binanceObj->fetch_order_book($exchangePair, $limit);
    }elseif($exchnage == constant("kucoin")){
        $finalData = $kucoinObj->fetch_order_book($exchangePair, $limit);
    }elseif($exchnage == constant("zb")){	
        $finalData = $zbObj->fetch_order_book($exchangePair, $limit);
    }elseif($exchnage == constant("gateio")){		
        $finalData = $gateioObj->fetch_order_book($exchangePair, $limit);
    }elseif($exchnage == constant("tidex")){		
        $finalData = $tidexObj->fetch_order_book($exchangePair, $limit);
    }elseif($exchnage == constant("cryptopia")){	
        $finalData = $cryptopiaObj->fetch_order_book($exchangePair, $limit);
    }
    else if($exchnage == constant("bittrex")){
        $finalData = $bittrexObj->fetch_order_book($exchangePair, $limit);
    } 
    $priceVolumePair = "";
    if($type  == "exchangeA"){
        $priceVolumePair = array_reverse($finalData["bids"]);
    }else{
        $priceVolumePair =  $finalData["asks"];
    }
    return $priceVolumePair ;
     
}
function getLastPriceOfExchage($exchnage,$pair){
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
    if($exchnage == constant("huobi")){
        $finalData = $huobiObj->fetch_ticker($pair);
    }elseif($exchnage == constant("okex")){
        $finalData = $okexObj->fetch_ticker($pair);
    }elseif($exchnage == constant("liqui")){
        $finalData = $liquiObj->fetch_ticker($pair);
    }elseif($exchnage == constant("hitbtc")){
        $finalData = $hitbtcObj->fetch_ticker($pair);
    }elseif($exchnage == constant("binance")){
        $finalData = $binanceObj->fetch_ticker($pair);
    }elseif($exchnage == constant("kucoin")){
        $finalData = $kucoinObj->fetch_ticker($pair);
    }elseif($exchnage == constant("zb")){	
        $finalData = $zbObj->fetch_ticker($pair);
    }elseif($exchnage == constant("gateio")){		
        $finalData = $gateioObj->fetch_ticker($pair);
    }elseif($exchnage == constant("tidex")){		
        $finalData = $tidexObj->fetch_ticker($pair);
    }elseif($exchnage == constant("cryptopia")){	
        $finalData = $cryptopiaObj->fetch_ticker($pair);
    }
    else if($exchnage == constant("bittrex")){
        $finalData = $bittrexObj->fetch_ticker($pair);
    } 
    $lastPrice = number_format($finalData['last'], 10, '.', '');
    return $lastPrice;
}
 
/*	include 'header.php';
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
					//  
					// else if($i==5){
					// 	$Tickers 		= $exmoObj->fetch_ticker($pair);	
					// 	$currencySymbol = "exmo";
					// }
					//  
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
//LTC BTC
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
	 
	// so for BTC all the accordance asset is 0.1 BTC, 0.2 BTC, 0.3 BTC
	// and for ETH: 1ETH, 2 ETH, 3 ETH
	// and for USDT: 1000 USDT, 2000USDT, 3000USDT
	
	$defaultAssest1 = "1000 USDT";
	$defaultAssest2 = "2000 USDT";
	$defaultAssest3 = "3000 USDT";
	$defaultAssest4 = "4000 USDT";
	$defaultAssest5 = "5000 USDT";
	
	if($key == "ETH"){
		$defaultAssest1 = "1 ETH";
		$defaultAssest2 = "2 ETH";
		$defaultAssest3 = "3 ETH";
		$defaultAssest4 = "4 ETH";
		$defaultAssest5 = "5 ETH";
	
	}else if ($key ==  "BTCUSDT"){
		$defaultAssest1 = "0.1 BTC";
		$defaultAssest2 = "0.2 BTC";
		$defaultAssest3 = "0.3 BTC";
		$defaultAssest4 = "0.4 BTC";
		$defaultAssest5 = "0.5 BTC";
	} 
	
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
					 <th class='mobile-d-all'>Spread(".$defaultAssest1.")</th>
					 <th class='mobile-d-all'>Spread(".$defaultAssest2.")</th>
					 <th class='mobile-d-all'>Spread(".$defaultAssest3.")</th>
					 <th class='mobile-d-all'>Spread(".$defaultAssest4.")</th>
					 <th class='mobile-d-all'>Spread(".$defaultAssest5.")</th>
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
			    border: 16px solid #f3f3f3; 
			    border-top: 16px solid #3498db;  
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
	$("#ETH").hide();
	$("#BTCUSDT").show();
	document.getElementById("btn-btc").classList.add('activeBtn');
	document.getElementById("btn-btc").classList.remove('customBtn');
}
$(document).ready(function(){
		 // default active button
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
		// this is LTC BTC
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
				<div class="col-xs-12" style="margin-bottom: 15px;">	
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
*/
?>