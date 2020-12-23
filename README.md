# FhSms
FhSms API for send text messages

<div dir="rtl" align="justify">
    این پکیج امکان اتصال <a href="http://www.smshooshmand.com" target="_blank" >FhSms API</a> به فریم ورک هایی که جهت نصب پکیج ها از composer و از استاندارد PSR-4 جهت autoload نمودن کلاس ها استفاده می نمایند همانند (Laravel,Yii,symfony) را فراهم می سازد.<br>
	جهت کسب اطلاعات بيشتر و مشاوره با شماره تلفن همراه 09132101417 (حسین مرادیان) تماس بگیرید. منتظر پیشنهادات سازنده شما هستیم.

## محتوا

- [نصب و پیکره بندی](#نصب-و-پیکره-بندی)
- [نحوه استفاده](#نحوه-استفاده)
- [متدها](#متدها)
- [Laravel](#Laravel)
    - [پیکره بندی در لاراول](#پیکره-بندی-در-لاراول)
    - [نحوه استفاده در لاراول](#نحوه-استفاده-در-لاراول)
    - [استفاده در سیستم اعلانات لاراول ](#استفاده-در-سیستم-اعلانات-لاراول)
- [تولیدکننده](#تولیدکننده)
- [لایسنس](#لایسنس)


## نصب و پیکره بندی  

با استفاده از composer  قادر به نصب این سرویس می باشید:
</div>

```bash
composer require hmoradian/fhsms
```

<div dir="rtl">
    
## نحوه استفاده

مطابق کد زیر تنظیمات شناسه، رمزعبور و شماره تماس ارسال کننده را وارد نمائید:
</div>

```php
$user_name = '*******';
$password = '*******';
$phone_number = '*******';;
$sms = new \Hmoradian\FhSms\Sms($user_name, $password, $phone_number);
```
<div dir="rtl">
    
### متدها

</div>

<div dir="rtl">
    
#### 1- متد ارسال پیامک (يک پيام به چند شماره)

</div>

`sendSms($reciver_numbers, $text_message)`

<div dir="rtl" >
 مثال :
</div>

```php
echo $sms->sendSms('0936*******','Test Message');
...
echo $sms->sendSms(['0936*******', '091********'],'Test Message');
```

<div dir="rtl">
    
#### 2- متد ارسال پیامک (چند پيام به چند شماره)

</div>

`sendSms2(array $reciver_numbers, array $text_messages)`

<div dir="rtl" >
 مثال :
</div>

```php
echo $sms->sendSms2(['0936*******', '091********'],['Test Message 1', 'Test Message 2']);
```

<div dir="rtl" >
    
#### 3- متد دريافت اطلاعات حساب

</div>

`getData()`

<div dir="rtl" >
 مثال :
</div>

```php
echo $sms->getData();
```
<div dir="rtl" >

#### 4- متد دريافت وضعيت پيام ارسالی

</div>

`getStatus($unique_id)`

<div dir="rtl" >
 مثال :
</div>

```php
echo $sms->getStatus('536221499');
```

<div dir="rtl" >
    
#### 5- متد پيام های دريافت شده

</div>

`getMessages()`

<div dir="rtl" >
 مثال :
</div>

```php
echo $sms->getMessages();
```


<div dir="rtl">
    
## Laravel

</div>
<div dir="rtl">
    
### پیکره بندی در لاراول

</div>
<div dir="rtl">
بعد از نصب پکیج ، فایل های config/fhsms.php و env. را مطابق زیر ویرایش نمائید :
</div>

```php
// .env
...
FHSMS_USERNAME=*******
FHSMS_PASSWORD=*******
FHSMS_PHONE_NUMBER=*******
...
```

```php
// config/fhsms.php
...
    'services' => [
        'user_name' => env('FHSMS_USERNAME'),
        'password' => env('FHSMS_PASSWORD'),
        'phone_number' => env('FHSMS_PHONE_NUMBER'),
    ],
...
```
<div dir="rtl">
    چنانچه از نسخه های پایین تر از 5.5 استفاده می نمائید ServiceProvider و aliase  زیر  را به فایل config/app.php اضافه نمائید:
 </div>  
 
 ```php
// config/app.php
...
Hmoradian\FhSms\FhSmsServiceProvider::class,
...
'FhSms' => Hmoradian\FhSms\Facades\FhSms::class,
...
```

<div dir="rtl">
    
### نحوه استفاده در لاراول

</div>

<div dir="rtl">
    هم اکنون می توانید با استفاده از Facade این پکیج (FhSms) به متدهای پکیج دسترسی نمایید :
</div>

 ```php
echo  FhSms::sendSms('0936*******','Test Message');
    ...   
    
echo  FhSms::sendSms2(['0936*******'],['Welcome ...']);
    ...
    
$result = FhSms::getStatus('536221499');
if($result['result']['statusId'] === 4){
    ///
}else{
   ///
}
    ...   
    
echo  RayganSms::getData();
    ...
```

<div dir="rtl">
    
###  استفاده در سیستم اعلانات لاراول

</div>

<div dir="rtl">
    
## تولیدکننده

- [Hossein Moradian](https://github.com/hmoradian)
   
## لایسنس


لایسنس این پکیج (MIT) می باشد . جهت اطلاعات در مورد این لایسنس به [License File](LICENSE) مراجعه نمایید. 

</div>

