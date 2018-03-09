<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://35.186.157.60/chharohttp/checkout/getstepthreenfourData",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionId\"\r\n\r\ncqugqd2ofdelg45hg08q3ol545\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
   name=\"customerId\"\r\n\r\n2016\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
   name=\"billingData\"\r\n\r\n{\"addressId\":518,\"same_as_shipping\":0,\"newAddress\":0}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"shippingData\"\r\n\r\n{\"addressId\":518,\"same_as_billing\":0,\"newAddress\":0}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"shippingMethod\"\r\n\r\nfreeshipping_freeshipping\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

///// savorder 


 $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => domain."chharohttp/checkout/saveOrder",
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

                      $saveOrderJson = curl_exec($curl);
                      $err = curl_error($curl);

                      curl_close($curl);

                        if ($err) {
                          $ResData = array('status'=>0,'message'=>$err,'steperr'=>'saveOrder'); 
                          echo json_encode($ResData); 
                        } else {

                          // echo $saveOrderJson;

                          $saveOrderArr = json_decode($saveOrderJson);

                          if($saveOrderArr->success ==1){
                              $incrementId = $saveOrderArr->incrementId;
                             // print_r($welcome);
                              $orderId = $saveOrderArr->orderId;
                        
                          // echo $orderId = $saveOrderArr->orderId;

                            $ResData = array('status'=>1,'message'=>'Order placed successfull, Order Id #'.$orderId,'step'=>'saveOrder','incrementId'=>$incrementId); 
                            echo json_encode($ResData);
                          }else{
                            $ResData = array('status'=>0,'message'=>$saveOrderArr->message,'step'=>'saveOrder','cart_item_id'=>$cart_item_id,'address'=> $address); 
                            echo json_encode($ResData);

                          }

                        }