<?php
namespace Viktor\PhpPro\Core\CLI\Commands;

use Viktor\PhpPro\Shortener\UrlConvertor;
use UfoCms\ColoredCli\CliColor;

class UrlDecodeCommand extends AbstractCommand
{
    protected UrlConvertor $convertor;

    /**
     * @param UrlConvertor $convertor
     */
    public function __construct(UrlConvertor $convertor)
    {
        parent::__construct();
        $this->convertor = $convertor;
    }

    public function run(array $params = []): void
    {
        parent::run($params);
        $this->writer->setColor(CliColor::CYAN)
            ->writeLn('Shortcode: ' . $this->convertor->decode($params[0]));
    }

    public static function getCommandDesc(): string
    {
        return 'Decode shortcode to url';
    }
}