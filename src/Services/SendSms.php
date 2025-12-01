<?php
namespace rahatSms\Services;

use rahatSms\Drivers\SmsIr;

class SendSms
{
    protected $driver;

    public function __construct($driverName = null)
    {
        $driverName = $driverName ?: config('rahatSms.default');
        $this->driver = $this->resolveDriver($driverName);
    }

    public function resolveDriver($name)
    {
        switch ($name) {
            case 'smsIr':
                return new SmsIr(config('rahatSms.drivers.smsIr'));
            default:
                throw new \Exception("SendSms driver [$name] not supported.");
        }
    }

    public function verify($mobile, $templateId,$parameters)
    {
        return $this->driver->verify($mobile, $templateId, $parameters);
    }
    public function bulk($mobiles,$message,$dateTime = null)
    {
        return $this->driver->bulk($mobiles, $message, $dateTime);
    }
    public function bulkDelete($packId)
    {
        return $this->driver->bulkDelete($packId);
    }
}
