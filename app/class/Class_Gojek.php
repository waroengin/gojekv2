<?php
class Class_Gojek{
    static $guidv4;

    function register($no = ''){
        $biodata = Class_Fakename::random();
        $name = $biodata['name'];
        $email = $biodata['email_u'].'@'.$biodata['email_d'];

        $data = array(
            'url' => 'https://api.gojekapi.com/v5/customers',
            'method' => 'POST',
            'body' => '{"email":"'.$email.'","name":"'.$name.'","phone":"'.$no.'","signed_up_country":"ID"}',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'X-UniqueId: '.self::$guidv4.'',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'Accept-Language:  id-ID',
                'X-DeviceOS:  iOS, 15.5',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Content-Type:  application/json',
                'X-PushTokenType:  APN',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-User-Type:  customer'
            )                

        );

        return $this->curl_post($data);
    }

    function verify($otp,$otp_token){
        $data = array(
            'url' => 'https://api.gojekapi.com/v5/customers/phone/verify',
            'method' => 'POST',
            'body' => '{"client_name":"gojek:consumer:app","client_secret":"pGwQ7oi8bKqqwvid09UrjqpkMEHklb","data":{"otp":"'.$otp.'","otp_token":"'.$otp_token.'"}}',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'X-UniqueId: '.self::$guidv4.'',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'Accept-Language:  id-ID',
                'X-DeviceOS:  iOS, 15.5',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Content-Type:  application/json',
                'X-PushTokenType:  APN',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-User-Type:  customer'
            )                

        );

        return $this->curl_post($data);
    }

    function goid($data){
        $dateTime = new DateTime();
        // Override current time
        $timestamp = $dateTime->getTimestamp();
        $data = array(
            'url' => 'https://goid.gojekapi.com/goid/token',
            'method' => 'POST',
            'body' => '{"client_id":"gojek:consumer:app","client_secret":"pGwQ7oi8bKqqwvid09UrjqpkMEHklb","data":{"refresh_token":"'.trim($data["data"]["refresh_token"]).'"},"grant_type":"refresh_token"}',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'Authorization: Bearer '.trim($data['data']["access_token"]).'',
                'X-UniqueId: '.self::$guidv4.'',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'Accept-Language:  id-ID',
                'X-DeviceOS:  iOS, 15.5',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Content-Type:  application/json',
                'X-PushTokenType:  APN',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-User-Type:  customer',
                'X-Signature-Time: '.$timestamp.''
            )                

        );

        return $this->curl_post($data);
    }

    function logingoid($otptoken,$otp){
        $dateTime = new DateTime();
        // Override current time
        $timestamp = $dateTime->getTimestamp();
        $data = array(
            'url' => 'https://goid.gojekapi.com/goid/token',
            'method' => 'POST',
            'body' => '{"client_id" : "gojek:consumer:app","data" : {"otp" : "'.$otp.'","otp_token" : "'.$otptoken.'"},"client_secret" : "pGwQ7oi8bKqqwvid09UrjqpkMEHklb","grant_type" : "otp"}',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'X-UniqueId: '.self::$guidv4.'',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'Accept-Language:  id-ID',
                'X-DeviceOS:  iOS, 15.5',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Content-Type:  application/json',
                'X-PushTokenType:  APN',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-User-Type:  customer'
            )                

        );

        return $this->curl_post($data);
    }

    function claim_voucher($token,$promocode){
        $dateTime = new DateTime();
        // Override current time
        $timestamp = $dateTime->getTimestamp();
        $data = array(
            'url' => 'https://api.gojekapi.com/go-promotions/v1/promotions/enrollments',
            'method' => 'POST',
            'body' => '{"promo_code":"'.$promocode.'"}',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'Authorization: Bearer '.$token.'',
                'X-UniqueId: '.self::$guidv4.'',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'Accept-Language:  id-ID',
                'X-DeviceOS:  iOS, 15.5',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Content-Type:  application/json',
                'X-PushTokenType:  APN',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-User-Type:  customer',
            )                

        );

        return $this->curl_post($data);
    }

    function reward($token){
        $data = array(
            'url' => 'https://api.gojekapi.com/growth/go-rewards/v3/rewards?types=vouchers,missions,bscriptions',
            'method' => 'GET',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'X-UniqueId:  '.self::$guidv4.'',
                'Gojek-Country-Code:  ID',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'X-DeviceOS:  iOS, 15.5',
                'Authorization:  Bearer '.$token.'',
                'Accept-Language:  id-ID',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-PushTokenType:  APN',
                'X-User-Type:  customer'
            )                

        );

        return $this->curl_get($data);
    }

    function voucher($token){
        $data = array(
            'url' => 'https://api.gojekapi.com/gopoints/v3/wallet/vouchers?limit=200&page=1',
            'method' => 'GET',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'X-UniqueId:  '.self::$guidv4.'',
                'Gojek-Country-Code:  ID',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'X-DeviceOS:  iOS, 15.5',
                'Authorization:  Bearer '.trim($token).'',
                'Accept-Language:  id-ID',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-PushTokenType:  APN',
                'X-User-Type:  customer'
            )                

        );

        return $this->curl_get($data);
    }

    function pin($pin,$token){
        $data = array(
            'url' => 'https://customer.gopayapi.com/v1/users/pin',
            'method' => 'POST',
            'body' => '{"pin":"'.$pin.'"}',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'Authorization: Bearer '.$token.'',
                'X-UniqueId: '.self::$guidv4.'',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'Accept-Language:  id-ID',
                'X-DeviceOS:  iOS, 15.5',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Content-Type:  application/json',
                'X-PushTokenType:  APN',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-User-Type:  customer'
            )                

        );

        return $this->curl_post($data);
    }

    function pinverify($pin,$token,$otp){
        $data = array(
            'url' => 'https://customer.gopayapi.com/v1/users/pin',
            'method' => 'POST',
            'body' => '{"pin":"'.$pin.'"}',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'otp: '.$otp.'',
                'Authorization: Bearer '.$token.'',
                'X-UniqueId: '.self::$guidv4.'',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'Accept-Language:  id-ID',
                'X-DeviceOS:  iOS, 15.5',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Content-Type:  application/json',
                'X-PushTokenType:  APN',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-User-Type:  customer'
            )                

        );

        return $this->curl_post($data);
    }

    function customer($token){
        $data = array(
            'url' => 'https://api.gojekapi.com/gojek/v2/customer',
            'method' => 'GET',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'X-UniqueId:  '.self::$guidv4.'',
                'Gojek-Country-Code:  ID',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'X-DeviceOS:  iOS, 15.5',
                'Authorization:  Bearer '.$token.'',
                'Accept-Language:  id-ID',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-PushTokenType:  APN',
                'X-User-Type:  customer'
            )                

        );

        return $this->curl_get($data);
    }

    function loginrequest($phone){
        $data = array(
            'url' => 'https://goid.gojekapi.com/goid/login/request',
            'method' => 'POST',
            'body' => '{"client_id":"gojek:consumer:app","country_code":"+62","phone_number":"'.$phone.'","client_secret":"pGwQ7oi8bKqqwvid09UrjqpkMEHklb","magic_link_ref":""}',
            'header' => array(
                'X-AppId:  com.go-jek.ios',
                'X-PhoneModel:  Apple, iPhone X',
                'User-Agent:  Gojek/4.48.0 (com.go-jek.ios; build:36012209; iOS 15.5.0) NetworkSDK/1.3.2',
                'X-Updater:  1',
                'X-PhoneMake:  Apple',
                'X-UniqueId: '.self::$guidv4.'',
                'Connection:  keep-alive',
                'X-User-Locale:  id_ID',
                'Accept-Language:  id-ID',
                'X-DeviceOS:  iOS, 15.5',
                'X-Platform:  iOS',
                'X-AppVersion:  4.48.0',
                'Accept:  */*',
                'Content-Type:  application/json',
                'X-PushTokenType:  APN',
                'Accept-Encoding:  br;q=1.0, gzip;q=0.9, deflate;q=0.8',
                'X-User-Type:  customer',
            )                

        );

        return $this->curl_post($data);
    }

    function curl_post($data){
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $data['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $data['method'],
            CURLOPT_POSTFIELDS => $data['body'],
            CURLOPT_HTTPHEADER => $data['header'],
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response,true);
    }

    function curl_get($data){
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $data['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $data['method'],
            CURLOPT_HTTPHEADER => $data['header'],
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response,true);
    }
}
?>