<?php


use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use UfoCms\ColoredCli\CliColor;
use Viktor\PhpPro\Core\CLI\CLIWriter;
use Viktor\PhpPro\Core\CLI\CommandHandler;
use Viktor\PhpPro\Core\CLI\Commands\TestCommand;
use Viktor\PhpPro\Core\CLI\Commands\UrlDecodeCommand;
use Viktor\PhpPro\Core\CLI\Commands\UrlEncodeCommand;
use Viktor\PhpPro\Core\ConfigHandler;
use Viktor\PhpPro\Core\Helpers\SingletonLogger;
use Viktor\PhpPro\Shortener\Helpers\UrlValidator;
use Viktor\PhpPro\Shortener\UrlConvertor;
use Viktor\PhpPro\Shortener\FileRepository;


require_once 'vendor/autoload.php';

$configs = require_once __DIR__ . '/../parameters/config.php';
$configHandler = ConfigHandler::getInstance()->addConfigs($configs);


$commandHandler = new CommandHandler(new TestCommand());

$monolog = new Logger($configHandler->get('monolog.channel'));
$monolog->pushHandler(new StreamHandler($configHandler->get('monolog.level.error'), Level::Error))
    ->pushHandler(new StreamHandler($configHandler->get('monolog.level.info'), Level::Info));

$singletonLogger = SingletonLogger::getInstance($monolog);

$fileRepository = new FileRepository($configHandler->get('dbFile'));
$urlValidator = new UrlValidator(new Client());
$converter = new UrlConvertor(
    $fileRepository,
    $urlValidator,
    $configHandler->get('urlConverter.codeLength')
);

$commandHandler->addCommand(new UrlEncodeCommand($converter));
$commandHandler->addCommand(new UrlDecodeCommand($converter));
$commandHandler->handle($argv, function ($params, \Throwable $e) {
    SingletonLogger::error($e->getMessage());
    CLIWriter::getInstance()->setColor(CliColor::RED)
        ->writeLn($e->getMessage());

    CLIWriter::getInstance()->write($e->getFile() . ': ')
        ->writeLn($e->getLine());
});

