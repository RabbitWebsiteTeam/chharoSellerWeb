 <?php
 include_once('config.php');
//print_r($_SESSION); exit;
        $storeId =1; 
         $website = 1;  	
        if(isset($_POST['submit'])){

          //print_r($_POST);
       /// add product
             $spfrom = date("Y-m-d",strtotime($_POST['sppricefrom']));
             $spto = date("Y-m-d",strtotime($_POST['sppriceto']));
            //print_r($_FILES); exit;
          
              
               //getMIMEType("myfile.html");
             /* $finfo = finfo_open(FILEINFO_MIME_TYPE);
              $mime = finfo_file($finfo, $temName);
              
              finfo_close($finfo);*/
              $finalImg ='';
              $postfields=array();
             foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
              {
                 $file_name=$_FILES["files"]["name"][$key];
                 $file_tmp=$_FILES["files"]["tmp_name"][$key];
                 $file_type=$_FILES["files"]["type"][$key];
                 $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                 // => new CurlFile($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["type"], $_FILES["upfile"]["name"])
                //echo '<br>';
                 $postfields[] = array("filedata" => "@$file_tmp", "filename" => $file_name);
              // $finalImg .='\r\n\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name="images[]"; filename=@"'.$file_name.'"\r\nContent-Type: '.$file_type.'\r\n\r\n';
               // if(in_array($ext,$extension))
                //{
                    /*if(!file_exists("photo_gallery/".$txtGalleryName."/".$file_name))
                    {
                        move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$txtGalleryName."/".$file_name);
                    }
                    else
                    {
                        $filename=basename($file_name,$ext);
                        $newFileName=$filename.time().".".$ext;
                        move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$txtGalleryName."/".$newFileName);
                    }*/
               // }
                //else
                //{
                    //array_push($error,"$file_name, ");
                //}
            }

            //echo  $finalImg ;

            //exit;
             $categorylist = '';
             $hex_color ="#000";

             if ($_POST['productType'] == 2) {
                   $categorylist = RESIDENT_ROOT_ID .",".RESIDENT_SHOP.",".$_POST['category'].",".$_POST['subcategory'].",".$_POST['segment'];
              } else {
                   $categorylist = TOURIST_ROOT_ID ."," .TOURIST_SHOP . ",".$_POST['category'].",".$_POST['subcategory'].",".$_POST['segment'];
              }
              //echo $categorylist;
          //  exit;
            $curl = curl_init();
            //$cfile = new CURLFile($img_name,$mimetype,'images');
            //$data = array('images' => $cfile);
            $headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => domain."chharohttp/customer/AddProduct",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"sellerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"websiteId\"\r\n\r\n".$website."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"categorylist\"\r\n\r\n".$categorylist."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"product_brand\"\r\n\r\n".$_POST['brandname']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"name\"\r\n\r\n".$_POST['producttype']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"description\"\r\n\r\n".$_POST['description']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"sku\"\r\n\r\n".$_POST['sku']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"price\"\r\n\r\n".$_POST['price']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"spprice\"\r\n\r\n".$_POST['spprice']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"spfrom\"\r\n\r\n".$spfrom."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"spto\"\r\n\r\n".$spto."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"qty\"\r\n\r\n".$_POST['qty']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW".$finalImg,
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"            
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
             } 
        else {
             //echo $response;
              $response = json_decode($response);
            // exit;
             //echo $response->error;
              if(isset($response->error))
              {
               if($response->error == 5){
                $curUrl = $_SERVER['REQUEST_URI'];
                      $redirPath = checkSessionId($curUrl);
                      header('Location: '.$redirPath);

               }
              }

              if($response->success==1){
                $message =$response->message;
                $Product_id =$response->Product_id;
              }else{
                $err_message =$response->message;
              }

          }
        }
            ?>