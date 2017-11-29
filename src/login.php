<?php
require("./vendor/autoload.php");

$client = new Google_Client();
$client->setClientId('CLIENT_ID');
$client->setClientSecret('CLIENT_SECRET');
$client->setRedirectUri('REDIRECT_URI');
$client->addScope(
    array(
        Google_Service_Plus::PLUS_ME,
        Google_Service_Plus::USERINFO_EMAIL,
        Google_Service_Plus::USERINFO_PROFILE,
    )
);

$service = new Google_Service_Plus($client);
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $me = $service->people->get('me');
    var_dump(array_pop($me->getEmails())["value"]);
    exit(0);
} elseif(isset($_GET['access_token'])) {
    $client->verifyIdToken($_GET['access_token']);
    $me = $service->people->get('me');
    var_dump(array_pop($me->getEmails())["value"]);
    exit(0);

} else {
    $body = sprintf('<P><A HREF="%s">Login</A></P>',
        $client->createAuthUrl());
}
?>

<!DOCTYPE HTML>
<HTML>
<HEAD>
        <TITLE> Google SSO </TITLE>
</HEAD>
<BODY>
        <?= $body ?>
</BODY>
</HTML>

Google_Service_Plus_Person Object ( nternal_gapi_mappings:protected] => Array ( ) [modelData:protected] => Array ( ) [processed:protected] => Array ( ) [emails] => Array ( [0] => Google_Service_Plus_PersonEmails Object ( [type] => account [value] => dgamboaestrada@gmail.com [internal_gapi_mappings:protected] => Array ( ) [modelData:protected] => Array ( ) [processed:protected] => Array ( ) ) ) [name] => Object ( [familyName] => Gamboa Estrada [formatted] => [givenName] => Daniel [honorificPrefix] => [honorificSuffix] => [middleName] => [internal_gapi_mappings:protected] => Array ( ) [modelData:protected] => Array ( ) [processed:protected] => Array ( ) ) [image] => Google_Service_Plus_PersonImage Object ( [isDefault] => [url] => https://lh3.googleusercontent.com/-17bziJ_HP_w/AAAAAAAAAAI/AAAAAAAAAV0/ZAlpkCm8IHs/photo.jpg?sz=50 [internal_gapi_mappings:protected] => Array ( ) [modelData:protected] => Array ( ) [processed:protected] => Array ( ) ) )
