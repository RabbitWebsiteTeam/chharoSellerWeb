<?php
include_once('config.php') ;

 //print_r($_SESSION); // exit;
 $sessionId = $_SESSION['SessionChharo']; 
 $customerId = $_SESSION['customerId']; 
 $storeId = $_POST['storeId']; 
 $price = $_POST['price'];
 $productId = $_POST['productId']; 
 $qty = $_POST['qty'];

//exit; 
//$_SESSION['status'] = $_POST['status'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => domain."chharohttp/checkout/addtoCart",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"sessionId\"\r\n\r\n".$sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"productId\"\r\n\r\n".$productId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"qty\"\r\n\r\n".$qty."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"price\"\r\n\r\n".$price."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
   
  ),
));

$tmpfname = 'cookie.txt';
curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);

$response1 = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
  
   $ResData = array('status'=>0,'message'=>$err,'err'=>'addtoCart'); 
   echo json_encode($ResData);

} else {
  //echo $response1; 
  //exit;
   $responseData1 = json_decode($response1);
   // check session
   if(isset($responseData1->error)){
      if($responseData1->error == 5){

        $curUrl = $_SERVER['REQUEST_URI'];
        $redirPath = checkSessionId($curUrl);
      header('Location: '.$redirPath);
      die;

    }
  }
      
  if($responseData1->error == 0){

    // call getsteponentwoData / 1 and 2 data
   
       $cart_item_id = $responseData1->cart_item_id;
       //,'cart_item_id'=>
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => domain."chharohttp/checkout/getsteponentwoData",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
          name=\"sessionId\"\r\n\r\n".$sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
          name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
          name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
          ),
        ));
        $tmpfname = 'cookie.txt';
        curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);
        $response12 = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        //  echo "cURL Error #:" . $err;
           $ResData = array('status'=>0,'message'=>$err,'steperr'=>'12'); 
           echo json_encode($ResData); 
        } else {
          //echo $response12;
           //$address = $response12.address;
           $response12 = json_decode($response12);
           if($response12->success ==1){
            // call 34 
            $address = $response12->address[0];           
            $addressId = $address->id;
            $value = $address->value; //address
            $address1 = array();
            $address1['addressId'] = $addressId;
            $address1['same_as_shipping'] = 0;
            $address1['newAddress'] = 0;
           // print_r($address1);
             $addressFinal = json_encode($address1);
              $curl = curl_init();

              curl_setopt_array($curl, array(
                CURLOPT_URL => domain."chharohttp/checkout/getstepthreenfourData",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
                name=\"sessionId\"\r\n\r\n".$sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
                 name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
                 name=\"billingData\"\r\n\r\n".$addressFinal."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
                 name=\"shippingData\"\r\n\r\n".$addressFinal."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
                 name=\"shippingMethod\"\r\n\r\nfreeshipping_freeshipping\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                CURLOPT_HTTPHEADER => array(
                  "cache-control: no-cache",
                  "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                  
                ),
              ));
              $tmpfname = 'cookie.txt';
              curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
              curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);

              $response34 = curl_exec($curl);
              $err = curl_error($curl);

              curl_close($curl);

              if ($err) {
                $ResData = array('status'=>0,'message'=>$err,'steperr'=>'34'); 
                echo json_encode($ResData); 
              } else {
                //echo $response34;
                $response34 = json_decode($response34);
                if($response34->success ==1){
                    $paymentMethods = $response34->paymentMethods;
                   /// print_r($paymentMethods);
                     $code = $paymentMethods[0]->code;
                     $title = $paymentMethods[0]->title;
                     $extraInformation = $paymentMethods[0]->extraInformation;
                     $_SESSION['code'] = $code;


                    //$ResData = array('status'=>1,'message'=>$response34,'step'=>'34','cart_item_id'=>$cart_item_id,'address'=> $address); 
                    //echo json_encode($ResData);
                     /// call 

                     $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => domain."chharohttp/checkout/getorderreviewData",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "POST",
                      CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
                      name=\"sessionId\"\r\n\r\n".$sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
                      name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
                      name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
                      name=\"method\"\r\n\r\n".$code."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                      CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                       
                      ),
                    ));
                    $tmpfname = 'cookie.txt';
                    curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
                    curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);
                    $orderReviewDataJson = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                      $ResData = array('status'=>0,'message'=>$err,'steperr'=>'getorderreviewData'); 
                      echo json_encode($ResData); 
                    } else {
                      //echo $orderReviewDataJson;
                      $orderReviewArr = json_decode($orderReviewDataJson);
                      //print_r($orderReviewArr);
                      if($orderReviewArr->success){

                        $billingMethod =$orderReviewArr->billingMethod;
                        $billingAddress =$orderReviewArr->billingAddress;
                        $orderReviewData =$orderReviewArr->orderReviewData;
                        //$billingMethod =$orderReviewArr->billingMethod;
                        //print_r($orderReviewData);
                        $items = $orderReviewData->items;
                        $currencyCode = $orderReviewData->currencyCode;
                        $currencyCode = 'INR';
                        $productName = $items[0]->productName;
                        $price = $items[0]->price;
                        $unformatedPrice = $items[0]->unformatedPrice;
                        $sku = $items[0]->sku;

                        // generate quoteID
                          $i = 0; //counter
                          $pin = ""; //our default pin is blank.
                          $digits = 4; // length
                          while($i < $digits){
                              //generate a random number between 0 and 9.
                              $pin .= mt_rand(1, 9);
                              $i++;
                          }
                        $unformatedPrice = number_format((float)$unformatedPrice, 2, '.', ''); 
                        $resData = array(); // define array 
                        $resData['unformatedPrice']=$unformatedPrice;
                        $resData['quoteId']=$pin;
                        $resData['customerId']=$customerId;
                        $resData['currencyCode']=$currencyCode;

                       // header("location:35.186.157.60/chharoseller/meTrnPayAPI.php?currency=".$currencyCode."&quoteId=".$quoteId."&customerId=".$customerId."&amount=".$unformatedPrice);
                        $ResData = array('status'=>1,'message'=>'Order reviewed successfully','steperr'=>'getorderreviewData','resData' => $resData ); 
                         echo json_encode($ResData); 

                      }else{

                         $ResData = array('status'=>0,'message'=>$orderReviewArr->message,'steperr'=>'getorderreviewData'); 
                         echo json_encode($ResData); 
                      }


                    }


                }else{

                     $ResData = array('status'=>0,'message'=>$response34,'step'=>'34','cart_item_id'=>$cart_item_id); 
                    echo json_encode($ResData); 
                }


              }
             

           }else{
           $ResData = array('status'=>0,'message'=>$response12,'step'=>'12','cart_item_id'=>$cart_item_id); 
           echo json_encode($ResData); 
          }




        }


  }else{

    $ResData = array('status'=>0,'message'=>$responseData1->message,'responseData1'=>'responseData1'); 
    echo json_encode($ResData); 

  }
}