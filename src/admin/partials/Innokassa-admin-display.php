<?php

/**
 * @link       https://innokassa.ru/
 * @since      1.1.0
 *
 * @package    Innokassa
 * @subpackage Innokassa/admin/partials
 */

?>

<?php
$aOrderStatuses = wc_get_order_statuses();

$aSchemes = array(
    '0' => 'Предоплата, полный расчет',
    '1' => 'Полный расчет'
);

$аTaxation = array(
    '1' => 'ОРН',
    '2' => 'УСН доход',
    '4' => 'УСН доход - расход',
    '16' => 'ЕСН',
    '32' => 'ПСН'
);

$аSendingReceipt = array(
    'email' => 'Email',
    'phone' => 'Телефон'
);

$aTypeOfReceiptPosition = array(
    '1' => 'Товар',
    '2' => 'Подакцизный товар',
    '3' => 'Работа',
    '4' => 'Услуга',
    '5' => 'Ставка азартной игры',
    '6' => 'Выигрыш азартной игры',
    '7' => 'Лотерейный билет',
    '8' => 'Выигрыш лотереи',
    '9' => 'Предоставление РИД',
    '10' => 'Платеж',
    '11' => 'Агентское вознаграждение',
    '12' => 'Составной предмет расчета',
    '13' => 'Иной предмет расчета',
    '14' => 'Имущественное право',
    '15' => 'Внереализационный доход',
    '16' => 'Страховые взносы',
    '17' => 'Торговый сбор',
    '18' => 'Курортный сбор',
    '19' => 'Залог',
    '20' => 'Расход',
    '21' => 'Взносы на ОПС ИП',
    '22' => 'Взносы на ОПС',
    '23' => 'Взносы на ОМС ИП',
    '24' => 'Взносы на ОМС',
    '25' => 'Взносы на ОСС',
    '26' => 'Платеж казино',
    '27' => 'Выдача ДС',
    '30' => 'Акцизный товар не маркированный',
    '31' => 'Акцизный товар маркированный',
    '32' => 'Товар не маркированный',
    '33' => 'Товар маркированный'
);

$aVat = array(
    '1' => 'Ставка НДС 20%',
    '2' => 'Ставка НДС 10%',
    '5' => 'Ставка НДС 0%',
    '6' => 'НДС не облагается'
);
?>
<style>
    div label {
        display: block;
    }

    div input {
        width: 250px;
        height: 30px;
        border: unset;
        padding: 0px 10px;
        border-radius: 10px;
    }

    #Innokassa_check_wnd {
        position: absolute;
        z-index: 99999;
        top: 0px;
    }

    .wrap div{
        margin: 20px 0px;
    }
    
    .wrap{
        padding: 30px;
        background: white;
        border-radius: 20px;
        max-width: 1000px;
        margin: 20px auto;
    }

    #wpcontent{
        padding-left: 0px;
    }
    
    .wrap h1{
        font-weight: 700;
    }

    .flex_div{
        display: flex;
        justify-content: space-between;
    }
    
    .w66{
        max-width: 66%;
    }

    .flex_div div{
        width: 32%;
        margin: 0;
    }

    .flex_div div input{
        width: 100%;
        background: #f0f0f1;
        height: 50px;
    }

    .flex_div div select{
        width: 100%;
        background: #f0f0f1;
        border: unset;
        height: 50px;
        border-radius: 10px;
    }

    .w66 div{
        width: calc(48% + 3px);
    }
    
    .button-primary{
        background-color: #002365 !important;
        background: #002365 !important;
        padding: 10px 20px 39px 20px !important;
        width: max-content !important;
    }

    .flex_div label{
        margin-bottom: 10px;
    }

</style>
<div class="wrap">
    <img src="https://innokassa.ru/images/inno_logo.svg" style="width: 150px;"/>
    <h1>Настройки innokassa</h1>
    <form method="post" action="options.php">
        <?php settings_fields('Innokassa-option-group');
        settings_errors('Innokassa-option-group-errors', '', false);
        ?>
        <?php do_settings_sections('Innokassa_submenu'); ?>
        <div class="flex_div">
            <div>
                <label>Идентификатор актора</label>
                <input name="innokassa_option_actor_id"
                value="<?php esc_html_e(get_option('innokassa_option_actor_id'), 'text_domain'); ?>" />
            </div>
            <div>
                <label>Токен актора</label>
                <input name="innokassa_option_actor_token"
                value="<?php esc_html_e(get_option('innokassa_option_actor_token'), 'text_domain'); ?>" />
            </div>
            <div>
                <label>Группу касс</label>
                <input name="innokassa_option_cashbox" value="<?php esc_html_e(get_option('innokassa_option_cashbox'), 'text_domain'); ?>" />
            </div>
        </div>
        <div class="flex_div">
            <div>
                <label>Выберите схему фискализации:</label>
                <select name="innokassa_option_scheme">
                    <?php
                    foreach ($aSchemes as $key => $value) {
                        if ($key == get_option('innokassa_option_scheme')) {
                            ?>
                                <option selected value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        } else {
                            ?>
                                <option value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>Статус заказа для чека предоплаты</label>
                <select name="innokassa_option_status_first_receipt" value="">
                    <?php
                    foreach ($aOrderStatuses as $key => $value) {
                        if ($key == get_option('innokassa_option_status_first_receipt')) {
                            ?>
                                <option selected value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        } else {
                            ?>
                                <option value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>Статус заказа для чека полного расчета</label>
                <select name="innokassa_option_status_second_receipt">
                    <?php
                    foreach ($aOrderStatuses as $key => $value) {
                        if ($key == get_option('innokassa_option_status_second_receipt')) {
                            ?>
                                <option selected value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        } else {
                            ?>
                                <option value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="flex_div">
            <div>
                <label>Место расчетов</label>
                <input name="innokassa_option_place_of_settlement"
                value="<?php echo get_option('innokassa_option_place_of_settlement'); ?>" />
            </div>
            <div>
                <label>Налогообложение</label>
                <select name="innokassa_option_taxation">
                    <?php
                    foreach ($аTaxation as $key => $value) {
                        if ($key == get_option('innokassa_option_taxation')) {
                            ?>
                                <option selected value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        } else {
                            ?>
                                <option value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>Тип позиции чека по умолчанию</label>
                <select name="innokassa_option_type_of_receipt_position">
                    <?php
                    foreach ($aTypeOfReceiptPosition as $key => $value) {
                        if ($key == get_option('innokassa_option_type_of_receipt_position')) {
                            ?>
                                <option selected value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        } else {
                            ?>
                                <option value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="flex_div w66">
            <div>
                <label>НДС позиции чека по умолчанию</label>
                <select name="innokassa_option_vat">
                    <?php
                    foreach ($aVat as $key => $value) {
                        if ($key == get_option('innokassa_option_vat')) {
                            ?>
                                <option selected value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        } else {
                            ?>
                                <option value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>НДС доставки</label>
                <select name="innokassa_option_delivery_vat">
                    <?php
                    foreach ($aVat as $key => $value) {
                        if ($key == get_option('innokassa_option_delivery_vat')) {
                            ?>
                                <option selected value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        } else {
                            ?>
                                <option value="<?php esc_html_e($key, 'text_domain'); ?>"><?php esc_html_e($value, 'text_domain'); ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes'); ?>" />
        </p>
    </form>
</div>
