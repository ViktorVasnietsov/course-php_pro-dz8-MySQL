<?php
namespace Viktor\PhpPro\Core\CLI\Commands;

use Viktor\PhpPro\Shortener\UrlConvertor;
use UfoCms\ColoredCli\CliColor;

class UrlEncodeCommand extends AbstractCommand
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

    /**
     * @inheritDoc
     */
    public function run(array $params = []): void
    {
        parent::run($params);
        $this->writer->setColor(CliColor::CYAN)
            ->writeLn('Shortcode: ' . $this->convertor->encode($params[0]));
    }

    /**
     * @inheritDoc
     */
    public static function getCommandDesc(): string
    {
        return 'Encode the url to sort code';
    }

}