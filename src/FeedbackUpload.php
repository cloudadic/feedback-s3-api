<?php

namespace cloudadic\feedback;

use cloudadic\feedback\S3Bucket;

/**
 * Description of ImageUpload
 *
 * @author Cloudadic
 */
class FeedbackUpload {

    private $bucket;

    public function __construct(S3Bucket $s3bucket) {
        $this->bucket = $s3bucket;
    }

    public function UploadImage($local_file, $remote_location) {
        $response = [];
        if (!empty($local_file)) {
            # Original
            $s3_URL = $this->bucket->pushFileToS3($local_file, $remote_location);
//            $get_image = $this->bucket->getFileFromS3($local_file, $s3_URL);
            $response['message'] = "Photo Uploaded Successfully";
            $response['image_url'] = $s3_URL;
        }
        return $response;
    }

}
