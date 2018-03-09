<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://35.186.157.60/chharohttp/customer/AddProduct",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
  name=\"sessionId\"\r\n\r\nv623kbml2r3sc3n5o62r93ip91\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"sellerId\"\r\n\r\n2016\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"websiteId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"categorylist\"\r\n\r\n292\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"product_brand\"\r\n\r\nMi\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"name\"\r\n\r\nBetter, faster, longer with Redmi 4\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"description\"\r\n\r\nRedmi 4 focuses on the most important aspects of a great smartphone experience. The 4100mAh powerhouse is able to run up to 18 days on standby mode and up to 2 days with heavy duty usage. \r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"sku\"\r\n\r\nRedmi4-k2016\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"price\"\r\n\r\n15\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"spprice\"\r\n\r\n10\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"spfrom\"\r\n\r\n2018-02-13\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"spto\"\r\n\r\n2018-04-19\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"qty\"\r\n\r\n5\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"images[]\"; filename=\"mi1 (1).jpg\"\r\nContent-Type: image/jpeg\r\n\r\n\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"images[]\"; filename=\"mi1 (2).jpg\"\r\nContent-Type: image/jpeg\r\n\r\n\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"   
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


================================


<?php
if ( isset($_POST['submitfile']) )
{
    // Make sure there are no upload errors
    if ($_FILES['upfile']['error'] > 0)
    {
        die("Error uploading file...");
    }

    // Prepare the cURL file to upload, including file name and MIME type
    $post = array(
    'upfile' => new CurlFile($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["type"], $_FILES["upfile"]["name"]),
    );

    // Include the other $_POST fields from the form?
    $post = array_merge($post, $_POST);

    // Prepare the cURL call to upload the external script
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.website.com/php-receive-file.php");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:54.0) Gecko/20100101 Firefox/54.0");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec($ch);
    curl_close($ch);

    // Print the result?
    print_r($result);
}
?>