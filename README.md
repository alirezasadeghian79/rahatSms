# rahatPay
پکیج ساده و قابل توسعه برای اتصال به سیستم پیامکی **SmsIr** در لاراول.

این پکیج به شما اجازه می‌دهد بدون درگیر شدن با جزییات هر ارسال پیامک ، تنها با یک ساختار یکسان پیامک ارسال نمایید.

---

## 🚀 نصب

### 1. نصب از طریق Composer
```bash
composer require alirezasadeghian79/rahatsms
```

### 1. publish
```bash
php artisan vendor:publish --provider="rahatSms\Providers\SmsServiceProvider"
```

### 2. تنظیمات config.php
```bash 
    'default' => 'smsIr', // انتخاب درایور
    'drivers' => [
        'smsIr' => [
            'api_key' => env('SMSIR_APP_KEY'), // api_key سرویس پیامکی
            'line_number' => env('SMSIR_LINE_NUMBER'), // شماره سرویس پیامکی
            'routes' => [
                'verify' => 'https://api.sms.ir/v1/send/verify', // ارسال سریع با قالب
                'bulk' => 'https://api.sms.ir/v1/send/bulk', // ارسال گروهی و زمان دار
                'bulk_delete' => 'https://api.sms.ir/v1/send/scheduled/', // حذف پیامک زمان دار
            ]
        ],
    ],
```

### 3. verify - ارسال سریع با قالب
```bash
use rahatSms\Services\SendSms; // فراخوانی کتابخانه

$rahatSms = new SendSms(); // فراخوانی متود سازنده

$mobile = '09123456789'; // شماره همراه
$templateId = 123456; // کد قالب
$parameters = [
  ['name' => 'CODE', 'value' => 1234]
]; // پارامتر های ارسال

$rahatSms->verify($mobile,$templateId,$parameters); // ارسال
```


### 4. bulk - ارسال گروهی و زمان دار
```bash
use rahatSms\Services\SendSms; // فراخوانی کتابخانه

$rahatSms = new SendSms(); // فراخوانی متود سازنده

$mobiles = ['09111111111','09222222222']; // شماره همراه ها
$message = 'message'; // متن پیام
$dateTime = 1764598513; timestamp // در صورت ارسال سریع این قسمت را خالی بگذارید

$rahatSms->bulk($mobiles,$message,$dateTime); // ارسال
```


### 4. bulkDelete - حذف پیامک زمان دار
```bash
تنها پیامک هایی که 3 دقیقه از زمانشان باقی مانده باشد قابل حذف هستند
```

```bash
use rahatSms\Services\SendSms; // فراخوانی کتابخانه

$rahatSms = new SendSms(); // فراخوانی متود سازنده

$packId = 'xxxxxxxx-xxxx-xxxx-xxxxxxxxxxxx'; // شناسه پیامک زمان دار ارسالی

$rahatSms->bulkDelete($packId); // حذف
```
