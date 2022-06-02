<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
use Innokassa\MDK\Client;
use Innokassa\MDK\Net\Transfer;
use Innokassa\MDK\Net\ConverterApi;
use Innokassa\MDK\Logger\LoggerFile;
use Innokassa\MDK\Net\NetClientCurl;
use Innokassa\MDK\Services\PipelineBase;
use Innokassa\MDK\Services\AutomaticBase;
use Innokassa\MDK\Services\ConnectorBase;
use Innokassa\MDK\Storage\ConverterStorage;

require_once plugin_dir_path(__FILE__) . '../include.php';

/**
 * Фабрика клиента MDK
 */
class InnokassaClientFactory
{
    public static function build(): Client
    {
        $receiptIdFactory = new InnokassaReceiptIdFactoryMetaConcrete();

        $settings = new InnokassaSettingsConcrete();
        $receiptStorage = new InnokassaReceiptStorageConcrete(
            $GLOBALS['wpdb'],
            new ConverterStorage($receiptIdFactory)
        );
        $receiptAdapter = new InnokassaReceiptAdapterConcrete($settings);
        $logger = new LoggerFile();
        $transfer = new Transfer(
            new NetClientCurl(),
            new ConverterApi(),
            $logger
        );

        $automatic = new AutomaticBase(
            $settings,
            $receiptStorage,
            $transfer,
            $receiptAdapter,
            $receiptIdFactory
        );
        $pipeline = new PipelineBase($settings, $receiptStorage, $transfer);
        $connector = new ConnectorBase($transfer);

        $client = new Client(
            $settings,
            $receiptStorage,
            $automatic,
            $pipeline,
            $connector,
            $logger
        );

        return $client;
    }
}
