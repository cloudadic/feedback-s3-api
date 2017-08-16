<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/FeedbackUpload.php';
require __DIR__ . '/S3Bucket.php';
$feedback = new cloudadic\feedback\FeedbackUpload(new cloudadic\feedback\S3Bucket('AKIAIVD5GFS7A55OZXQA', '+/hAp5A45JuFSNnedjNi8+c/frX2oVrNQ5kExVce', 'pubema', 'us-east-1', '2006-03-01'));
$response = $feedback->UploadImage('/home/ziwid/Downloads/062aa016159b28294f8229cbbd0f602f.jpg', 'test/062aa016159b28294f8229cbbd0f602f.jpg');
print_r($response);
