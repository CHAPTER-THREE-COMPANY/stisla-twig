<?php


namespace ChapterThree\C3Bundle\Service;


use Aws\S3\S3Client;

class AwsS3
{
    public $client;
    public $bucket;

    public function __construct(S3Client $s3Client)
    {
        $this->client = $s3Client;
        // Amazon S3 ストリームラッパーを登録
        $this->client->registerStreamWrapper();

        $this->bucket = 's3-symfony';
    }

    public function listBuckets()
    {
        return $this->client->listBuckets();
    }

    public function listObjects($params=[])
    {
        if (empty($params['Bucket'])) {
            $params['Bucket'] = $this->bucket;
        }
        return $this->client->listObjects($params);
    }

    public function getObject($params)
    {
        if (empty($params['Bucket'])) {
            $params['Bucket'] = $this->bucket;
        }
        try {
            $result = $this->client->getObject($params);
        }catch (\Exception $exception){
            throw $exception;
        }
        return $result;
    }
    public function putObject($params)
    {
        if (empty($params['Bucket'])) {
            $params['Bucket'] = $this->bucket;
        }
        try {
            $result = $this->client->putObject($params);
        }catch (\Exception $exception){
            throw $exception;
        }
        return $result;
    }

    public function download($filename) : \Symfony\Component\HttpFoundation\Response
    {
        $key = "s3://".$this->bucket."/".$filename;
        $size = filesize($key);
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . $size);
        header('Content-Disposition: attachment; filename="'.($filename).'"');
        while (ob_get_level()) { ob_end_clean(); }
        readfile($key);
        exit();
    }


}