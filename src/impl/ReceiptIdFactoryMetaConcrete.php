<?php

use Innokassa\MDK\Entities\ReceiptId\ReceiptIdFactoryMeta;

require_once plugin_dir_path(__FILE__) . '../include.php';

class ReceiptIdFactoryMetaConcrete extends ReceiptIdFactoryMeta
{
    protected function getEngine(): string
    {
        return 'Woo';
    }
}
