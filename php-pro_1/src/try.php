<?php
//interface IDownloader
//{
//    /**
//     * @param string $url
//     * @return string
//     */
//    public function download(string $url): string;
//}
//
//class SimpleDownloader implements IDownloader
//{
//    /**
//     * @inheritdoc
//     */
//    public function download(string $url): string
//    {
//        // Downloading a file from the Internet.
//        $result = file_get_contents($url);
//        return $result;
//    }
//}
//
///**
// * @param IDownloader $downloader
// */
//function clientCode(IDownloader $downloader)
//{
//    // ...
//    $downloader->download("https://lms.ithillel.ua/");
//    $downloader->download("https://google.com/");
//    $downloader->download("https://lms.ithillel.ua/");
//    $downloader->download("https://lms.ithillel.ua/");
//    $downloader->download("https://google.com/");
//    $downloader->download("https://lms.ithillel.ua/");
//    $downloader->download("https://lms.ithillel.ua/");
//    $downloader->download("https://google.com/");
//    $downloader->download("https://lms.ithillel.ua/");
//    $downloader->download("https://lms.ithillel.ua/");
//    $downloader->download("https://google.com/");
//    $downloader->download("https://lms.ithillel.ua/");
//    $downloader->download("https://lms.ithillel.ua/");
//    $downloader->download("https://google.com/");
//    $downloader->download("https://lms.ithillel.ua/");
//    // ...
//}
//
//class CachingDownloader implements IDownloader
//{
//    /**
//     * @var SimpleDownloader
//     */
//    protected $downloader;
//
//    /**
//     * @var string[]
//     */
//    private $cache = [];
//
//    public function __construct(SimpleDownloader $downloader)
//    {
//        $this->downloader = $downloader;
//    }
//
//    public function download(string $url): string
//    {
//        if (!isset($this->cache[$url])) {
//            $this->cache[$url] = $this->downloader->download($url);
//        }
//        return $this->cache[$url];
//    }
//}
//
//
//$simpleDownloader = new SimpleDownloader();
//$downloader = new CachingDownloader($simpleDownloader);
//clientCode($downloader);
//
//exit;

class Rectangle
{
    protected $width;
    protected $height;

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {

        return $this->height;
    }

    public function Validate($width,$height)
    {
        if($width<=0 || $height <=0){
            throw new Exception('incorrect data');
        }
    }

}
class Square extends Rectangle
{
    public function setWidth($width)
    {
        parent::setWidth($width);
        parent::setHeight($width);
    }
    public function setHeight($height)
    {
        parent::setHeight($height);
        parent::setWidth($height);
    }

    public function Validate($width,$height)
    {
        if($width != $height){
            throw new Exception('incorrect data');
        }
    }

}
function calculate(Rectangle $rectangle, $width, $height)
{
    $rectangle->setWidth($width);
    $rectangle->setHeight($height);
    $rectangle->Validate($width, $height);
    return $rectangle->getHeight() * $rectangle->getWidth();
}

echo calculate(new Rectangle, 4, 5);
echo PHP_EOL;
echo calculate(new Square, 4, 5);
echo PHP_EOL;
exit;


