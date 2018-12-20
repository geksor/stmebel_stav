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

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'Contact' => $contact,
    'AboutPage' => $aboutPage,
    'SiteSettings' => $siteSettings,
];
