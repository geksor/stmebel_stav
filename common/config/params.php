<?php
$contactFile = __DIR__. '/contact.json';
if (!is_file($contactFile)){
    file_put_contents($contactFile, '{}');
}
$contact = json_decode(file_get_contents($contactFile), true);

$aboutPageFile = __DIR__. '/about-page.json';
if (!is_file($aboutPageFile)){
    file_put_contents($aboutPageFile, '{}');
}
$aboutPage = json_decode(file_get_contents($aboutPageFile), true);

$siteSettingsFile = __DIR__. '/site-settings.json';
if (!is_file($siteSettingsFile)){
    file_put_contents($siteSettingsFile, '{}');
}
$siteSettings = json_decode(file_get_contents($siteSettingsFile), true);

$deliveryPageFile = __DIR__. '/delivery-page.json';
if (!is_file($deliveryPageFile)){
    file_put_contents($deliveryPageFile, '{}');
}
$deliveryPage = json_decode(file_get_contents($deliveryPageFile), true);

$agreePageFile = __DIR__. '/agree-page.json';
if (!is_file($agreePageFile)){
    file_put_contents($agreePageFile, '{}');
}
$agreePage = json_decode(file_get_contents($agreePageFile), true);

$threeBlockFile = __DIR__. '/three-block.json';
if (!is_file($threeBlockFile)){
    file_put_contents($threeBlockFile, '{}');
}
$threeBlock = json_decode(file_get_contents($threeBlockFile), true);

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'Contact' => $contact,
    'AboutPage' => $aboutPage,
    'SiteSettings' => $siteSettings,
    'DeliveryPage' => $deliveryPage,
    'AgreePage' => $agreePage,
    'ThreeBlock' => $threeBlock,
];
