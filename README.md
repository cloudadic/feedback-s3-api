# Feedback API to push messages to S3

### Here's a sample config

```php

require __DIR__ . '/../vendor/autoload.php';

$feedback = new cloudadic\feedback\FeedbackUpload(new cloudadic\feedback\S3Bucket('AWS_ACCESS_KEY', 'AWS_SECRET_KEY', 'S3_BUCKET', 'us-east-1', '2006-03-01'));
$response = $feedback->UploadImage('/home/codeswift/Downloads/062aa016159b28294f8229cbbd0f602f.jpg', 'test/062aa016159b28294f8229cbbd0f602f.jpg');
print_r($response);
```
