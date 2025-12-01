<?php

namespace rahatSms\Contracts;

interface SmsInterface
{
    public function verify($mobile,$templateId,$parameters);
    public function bulk($mobiles,$message,$dateTime = null);
    public function bulkDelete($packId);
}
