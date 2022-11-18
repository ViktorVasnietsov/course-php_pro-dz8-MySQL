<?php

namespace Viktor\PhpPro\Shortener\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use InvalidArgumentException;
//use Psr\Http\Client\ClientInterface;
use Viktor\PhpPro\Shortener\Exceptions\UrlNotFoundException;
use Viktor\PhpPro\Shortener\Interfaces\IUrlValidator;

class UrlValidator implements IUrlValidator
{
    protected ClientInterface $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function validateUrl(string $url): bool
    {
        if(empty($url) || !filter_var($url,FILTER_VALIDATE_URL) )
        {
            throw new InvalidArgumentException('Url is broken');
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function checkRealUrl(string $url): bool
    {
        try{
            $statusCode = $this->client->request('GET', $url);
            return (!empty($statusCode->getStatusCode()) && in_array($statusCode->getStatusCode(), [200,202,301,302]));
        }catch (ConnectException $exception){
            throw new UrlNotFoundException($exception->getMessage(), $exception->getCode());
        }
//        $client = new Client();
//        $statusCode = $client->request('GET', $url);
//         if(empty($statusCode->getStatusCode()) || !in_array($statusCode->getStatusCode(), [200,202,301,302])){
//             throw new UrlNotFoundException('This Url does not exist');
//         }
//        return true;
//
//        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_NOBODY, true);
//        $result = curl_exec($curl);
//        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//        if(!in_array($statusCode, [200,202,301,302])){
//            throw new UrlNotFoundException('This Url does not exist');
//        }
//        return true;
    }
}