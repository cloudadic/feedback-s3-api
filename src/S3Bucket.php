<?php

namespace cloudadic\feedback;

use Aws\S3\S3Client;

/**
 * Description of S3Bucket
 *
 * @author Cloudadic
 */
class S3Bucket {
    
    /**
     *
     * @var type $s3_Access_Key Description S3 Bucket Access Key
     * @var type $s3_Secret_Key Description S3 Bucket Secret Key
     * @var type $s3_Region Description S3 Bucket Region
     * @var type $s3_Version Description S3 Bucket Version
     * @var type $s3_Bucket Description S3 Bucket 
     */

    private $s3_Access_Key;
    private $s3_Secret_Key;
    private $s3_Region;
    private $s3_Version;
    private $s3_Bucket;

    public function __construct($s3_Access_Key, $s3_Secret_Key, $s3_Bucket, $s3_Region, $s3_Version) {
        $this->s3_Access_Key = $s3_Access_Key;
        $this->s3_Secret_Key = $s3_Secret_Key;
        $this->s3_Bucket = $s3_Bucket;
        $this->s3_Region = $s3_Region;
        $this->s3_Version = $s3_Version;
    }

    public function pushFileToS3($file_path, $s3_file_Name) {
        $s3Client = S3Client::factory(array(
                    'credentials' => array(
                        'key' => $this->s3_Access_Key,
                        'secret' => $this->s3_Secret_Key,
                    ),
                    'region' => $this->s3_Region,
                    'version' => $this->s3_Version
        ));
        $result = $s3Client->putObject(array(
            'Bucket' => $this->s3_Bucket,
            'Key' => $s3_file_Name,
            'SourceFile' => $file_path
        ));
        return $result;
    }

    public function getFileFromS3($file_path, $s3_URL) {
        $url_parts = explode('/', $s3_URL);
        $key_start = array_search($this->s3_Bucket . ".s3.amazonaws.com", $url_parts);
        $key_arr = array_slice($url_parts, $key_start + 1);
        $s3_key = implode('/', $key_arr);
        $s3Client = S3Client::factory(array(
                    'credentials' => array(
                        'key' => $this->s3_Access_Key,
                        'secret' => $this->s3_Secret_Key,
                    ),
                    'region' => $this->s3_Region,
                    'version' => $this->s3_Version
        ));
        $request = [
            'Bucket' => $this->s3_Bucket,
            'Key' => $s3_key,
        ];
        if ($file_path) {
            $request['SaveAs'] = $file_path;
        }
        $result = $s3Client->getObject($request);
        return $result;
    }

}
