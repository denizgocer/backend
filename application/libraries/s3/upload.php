<?php
require 'aws-autoloader.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'parth-bucket';
$keyname = 'uploads/fb.jpg';
                        
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'ap-south-1',
    'credentials' => array(
    'key' => 'AKIAJ5GNXK4WC63MLJWQ',
    'secret'  => '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',
  )
]);

try {
    // Upload data.
    $result = $s3->putObject([
        'Bucket' => $bucket,
        'Key'    => $keyname,
        'Body'   => fopen('fb.jpg', 'r'),
        'ACL'    => 'public-read'
    ]);

    // Print the URL to the object.
    echo $result['ObjectURL'] . PHP_EOL;
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

?>