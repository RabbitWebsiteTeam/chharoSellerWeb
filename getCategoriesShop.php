<?php 
include_once('config.php');

      $rootId =   $_POST['rootId'];
      if($rootId == 2){          
        $rootId = RESIDENT_SHOP;
      }elseif($rootId == 278){
          $rootId = TOURIST_SHOP;
      }else{
        $rootId = $rootId;
      }
      $storeId =   $_POST['storeId'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => domain."chharohttp/catalog/getcategoryListTREE",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
           name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
          name=\"rootId\"\r\n\r\n".$rootId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
          name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
          
          ),
        ));
        $tmpfname = 'cookie.txt';
        curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
         //echo  $response;
          $ctData = json_decode($response);
            if(isset($ctData->error))
              {
               if($ctData->error == 5){
                $curUrl = $_SERVER['REQUEST_URI'];
                      $redirPath = checkSessionId($curUrl);
                      header('Location: '.$redirPath);

               }
              }
              //echo '<pre>';
              $categories = $ctData->categories;
              //$children_data = $ctData->children_data;
              $ResData = array('status'=>1,'categories'=>$categories->children_data); 
              echo json_encode($ResData); 

             // echo count($children_data);
              // print_r($categories);
              // echo '<br>';
            //print_r($children_data);
        }