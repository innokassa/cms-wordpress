<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Innokassa\MDK\Entities\ReceiptId\ReceiptIdFactoryMeta;

require_once plugin_dir_path(__FILE__) . '../include.php';

class ReceiptIdFactoryMetaConcrete extends ReceiptIdFactoryMeta
{
    protected function getEngine(): string
    {
        return 'Woo';
    }
}
