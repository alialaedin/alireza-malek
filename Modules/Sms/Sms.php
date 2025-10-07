<?php


namespace Modules\Sms;

use Illuminate\Support\Facades\Facade;

/**
 * Class Sms
 * @package Store\Helpers\Sms
 * @method static Sms driver(String $driver)
 * @method static Sms pattern(String $pattern)
 * @method static Sms text(String $message)
 * @method static Sms from(Integer $from)
 * @method static Sms to(array $to)
 * @method static Sms data(array $data)
 * @method static Sms credit()
 * @method static Sms send()
 */
class Sms extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'sms';
    }
}
