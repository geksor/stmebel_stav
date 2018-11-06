<?php
$contactFile = __DIR__. '/contact.json';
if (!is_file($contactFile)){
    file_put_contents($contactFile, '{}');
}
$contact = json_decode(file_get_contents($contactFile), true);

$aboutHomeFile = __DIR__. '/about-home.json';
if (!is_file($aboutHomeFile)){
    file_put_contents($aboutHomeFile, '{}');
}
$aboutHome = json_decode(file_get_contents($aboutHomeFile), true);

$aboutPageFile = __DIR__. '/about-page.json';
if (!is_file($aboutPageFile)){
    file_put_contents($aboutPageFile, '{}');
}
$aboutPage = json_decode(file_get_contents($aboutPageFile), true);

$advantageFile = __DIR__. '/advantage.json';
if (!is_file($advantageFile)){
    file_put_contents($advantageFile, '{}');
}
$advantage = json_decode(file_get_contents($advantageFile), true);

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'Contact' => $contact,
    'AboutHome' => $aboutHome,
    'AboutPage' => $aboutPage,
    'Advantage' => $advantage,
];
