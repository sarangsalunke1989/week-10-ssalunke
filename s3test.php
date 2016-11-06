<?php
//echo "Hello World";
//echo "\n Sarang Salunke";

require 'vendor/autoload.php';

$sharedConfig = [
    'region'  => 'us-west-2',
    'version' => 'latest',
];

// Create an SDK class used to share configuration across clients.
$sdk = new Aws\Sdk($sharedConfig);

// Create an Amazon S3 client using the shared configuration data.
$client = $sdk->createS3();

$s3 = $sdk->createS3();
$result = $s3->listBuckets();
//echo $result . "\n";

foreach ($result['Buckets'] as $bucket) {
     //echo $bucket['Name']. "\n";
}

// Convert the result object to a PHP array
//$array = $result->toArray();
//echo "ending php block"

//$result_1 = $s3->getObject([ 'Bucket' => 'ssalunke-week-10']);
//echo $result_1

$objects = $s3->getIterator('ListObjects', array(
        'Bucket' => 'ssalunke-week-10'
    ));
    foreach ($objects as $object)
        {
//      echo $object['Key'] . "\n";
        }
$url = $s3->getObjectUrl('ssalunke-week-10', 'img');
//echo $url;

$result_upload = $s3->putObject(array(
    'Bucket'     => 'ssalunke-week-10',
    'Key'        => 'newimg',
    'SourceFile' => 'switchonarex.png',
    'ACL'        => 'public-read'
    )
);

// We can poll the object until it is accessible
/*$s3->waitUntil('ObjectExists', array(
    'Bucket' => $this->bucket,
    'Key'    => 'newimg'
));

*/

$url_rex = $s3->getObjectUrl('ssalunke-week-10', 'newimg');
//echo $url_rex;


?>

<html>
<head></head>
<body>
<h1>Week-10 Assignment</h1>
<br>

Buckets found : <b> <?php foreach ($result['Buckets'] as $bucket) {
     echo $bucket['Name']. "\n";
}
?>
</b>
<br>
The URI for the switchonarex.png is <b> <?php echo $url_rex ?> </b>
<br>
<img src="<?php echo $url_rex ?>" height="500" width="500" > </img>
</body>
</html>
