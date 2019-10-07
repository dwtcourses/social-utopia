<?php 
// initialize Facebook class using your own Facebook App credentials
// see: https://developers.facebook.com/docs/php/gettingstarted/#install
$config = array();
$config['appId'] = '285469752123810';
$config['secret'] = 'c4c3a03218d8d488eac6da036bcda5cd';
$config['fileUpload'] = false; // optional

//Facebook configuration
//$config['App_ID']      =   '285469752123810';
//$config['App_Secret']  =   'c4c3a03218d8d488eac6da036bcda5cd'; 

//https://www.facebook.com/dialog/oauth?client_id=285469752123810&redirect_uri=https://dev.interactiveutopia.com/socialMediaApp/fb-tokens/&scope=manage_pages


//https://graph.facebook.com/oauth/access_token?client_id=285469752123810&redirect_uri=https://dev.interactiveutopia.com/socialMediaApp/fb-tokens/&client_secret=c4c3a03218d8d488eac6da036bcda5cd&code=AQCHmBiImBwg-w7gq1BuRsdfTwVYAx3FTP0HwidmbROcb3byXOPAcNVnrk89cV3LeaRAhZqGMqzgI0mXv4mF3eYeFgo-yBZNkYQ6mB8P159ghBhtr_cj-B1rt1kvoNuCeW5HTFvIfci81kBvY6-jcSo3WbKrYDNOc8kPSjiBVxUcQEHnPmE9ORAUE4r-IMmuBhNJ-5xzxsxDDBVTV4uek4bo9P_onApXdhGdlVhSCzxq-eiI1IQOgdiazJyGZzshcvFTssfQj8i3JbBbyFAQR5KUlnaungtzbSjN_ink4cijzexFowAtWVU9zCBg0lSMqks

//https://graph.facebook.com/me/accounts?access_token=EAAEDohsrYaIBAJV9iEDyrqyxjFW5LV8pSn3FjeekFM4gywvWiZA3WTVVE8Y6O294BWNzWkqO2GbbGutujsFRgvglFiAwhGssN10ZBR3bV2zZBurJiEqoXLZBaJL6Qn6lCWkrtdZB3CgQINShEP9jI0grkj9KUngoZD

//https://www.facebook.com/dialog/oauth?client_id=285469752123810&redirect_uri=https://dev.interactiveutopia.com/socialMediaApp/fb-tokens/&scope=manage_pages%2Cpublish_pages&response_type=code+token&enable_profile_selector=1&profile_selector_ids=143193829055196