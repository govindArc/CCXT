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

            }else if (($secondColumn1 < 0)){
                // if first value is negative
                $thirdValue = $firstValue1 / $price1;
            }else{
                $secondValue = $volume1 / $price1;
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


                 
            }else if (($firstValue1 < 0)){
                // if first value is negative
                $thirdValue = $firstValue1 / $price2;
            }else{
                $secondValue = $volume1 / $price1;
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
            $finalArray[$flagValue." ".$calualteAssets] = $responseArray;

           echo '<br>';
           echo "this is buying power of liqui";
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



?>
