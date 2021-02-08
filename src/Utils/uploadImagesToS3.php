<?php


namespace App\Utils;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class uploadImagesToS3
{
    public function uploadProfileImageToS3Bucket(UploadedFile $file)
    {
        // AWS connection info
        $bucketName = 'medicsoft-bucket';
        $IAM_KEY = 'AKIAXMKURXSJF5VWFYZ4';
        $IAM_SECRET = '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';

        // Connect to AWS
        try {
            $s3 = S3Client::factory(
                array(
                    'credentials' => array(
                        'key' => $IAM_KEY,
                        'secret' => $IAM_SECRET
                    ),
                    'version' => 'latest',
                    'region'  => 'eu-central-1',
                    'scheme' => 'http',
                )
            );
        } catch (\Exception $e) {
            // We use a die, so if this fails. It stops here. Typically this is a REST call so this would
            // return a json object.
            die("Error: " . $e->getMessage());
        }


        $keyName = 'images/' . $file->getClientOriginalName();
        $pathInS3 = 'https://s3.eu-central-1.amazonaws.com/' . $bucketName . '/' . $keyName;

        // Add it to S3
        try {

            $realPath = $file->getRealPath();

            $s3->putObject(
                array(
                    'Bucket'=>$bucketName,
                    'Key' =>  $keyName,
                    'SourceFile' => $realPath,
                    'StorageClass' => 'REDUCED_REDUNDANCY'
                )
            );

        } catch (S3Exception $e) {
            die('Error:' . $e->getMessage());
        }

    }
}