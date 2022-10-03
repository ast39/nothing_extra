<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 23.07.2019
 * Time: 10:49
 */

/*
// Set a "subject"
$message->setSubject('Demo message using the SwiftMailer library.');

// Set the "From address"
$message->setFrom(['sender@gmail.com' => 'sender name']);

// Set the "To address" [Use setTo method for multiple recipients, argument should be array]
$message->addTo('recipient@gmail.com','recipient name');

// Add "CC" address [Use setCc method for multiple recipients, argument should be array]
$message->addCc('recipient@gmail.com', 'recipient name');

// Add "BCC" address [Use setBcc method for multiple recipients, argument should be array]
$message->addBcc('recipient@gmail.com', 'recipient name');

// Add an "Attachment" (Also, the dynamic data can be attached)
$attachment = Swift_Attachment::fromPath('example.xls');
$attachment->setFilename('report.xls');
$message->attach($attachment);

// Add inline "Image"
$inline_attachment = Swift_Image::fromPath('nature.jpg');
$cid = $message->embed($inline_attachment);

// Set the plain-text "Body"
$message->setBody("This is the plain text body of the message.\nThanks,\nAdmin");

// Set a "Body"
$message->addPart('This is the HTML version of the message.<br>Example of inline image:<br><img src="'.$cid.'" width="200" height="200"><br>Thanks,<br>Admin', 'text/html');

// Send the message
$result = $mailer->send($message);
*/

return [

    'mailers' => [

        'test' => [
            'transport'  => 'smtp',
            'host'       => 'test.smtp.com',
            'port'       => 25,
            'encryption' => null,
            'username'   => 'user@test.com',
            'password'   => 'neversay',
            'timeout'    => null,
            'auth_mode'  => null,
            'from'       => 'user@test.com',
            'from_name'  => 'test user',
        ],
    ],
];
