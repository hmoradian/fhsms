# FhSms
FhSms API for send text messages

<div dir="rtl" align="justify">
    اين پکيج امکان اتصال <a href="http://www.smshooshmand.com" target="_blank" >FhSms API</a> به فريم ورک هايي که جهت نصب پکيج ها از composer و از استاندارد PSR-4 جهت autoload نمودن کلاس ها استفاده مي نمايند همانند (Laravel,Yii,symfony) را فراهم مي سازد.<br>
	جهت کسب اطلاعات بيشتر و مشاوره با شماره تلفن همراه 09132101417 (حسين مراديان) تماس بگيريد. منتظر پيشنهادات سازنده شما هستيم.

## محتوا

- [نصب و پيکره بندي](#نصب-و-پيکره-بندي)
- [نحوه استفاده](#نحوه-استفاده)
- [متدها](#متدها)
- [Laravel](#Laravel)
    - [پيکره بندي در لاراول](#پيکره-بندي-در-لاراول)
    - [نحوه استفاده در لاراول](#نحوه-استفاده-در-لاراول)
    - [استفاده در سيستم اعلانات لاراول ](#استفاده-در-سيستم-اعلانات-لاراول)
- [توليدکننده](#توليدکننده)
- [لايسنس](#لايسنس)


## نصب و پيکره بندي  

با استفاده از composer  قادر به نصب اين سرويس مي باشيد:
</div>

```bash
composer require hmoradian/fhsms
```

<div dir="rtl">
    
## نحوه استفاده

مطابق کد زير تنظيمات شناسه، رمزعبور و شماره تماس ارسال کننده را وارد نمائيد:
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
    
#### 1- متد ارسال پيامک (يک پيام به چند شماره)

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
    
#### 2- متد ارسال پيامک (چند پيام به چند شماره)

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

#### 4- متد دريافت وضعيت پيام ارسالي

</div>

`getStatus($unique_id)`

<div dir="rtl" >
 مثال :
</div>

```php
echo $sms->getStatus('536221499');
```

<div dir="rtl" >
    
#### 5- متد پيام هاي دريافت شده

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
    
### پيکره بندي در لاراول

</div>
<div dir="rtl">
بعد از نصب پکيج ، فايل env. را مطابق زير ويرايش نموده و کليدهاي زير را در آن با مقادير مربوط به حساب کاربري خود در سامانه پيامک ما وارد نماييد (مقدار کليد سوم شماره تلفن فرستنده است):
</div>

```php
// .env
...
FHSMS_USERNAME=*******
FHSMS_PASSWORD=*******
FHSMS_PHONE_NUMBER=*******
...
```

</div>
<div dir="rtl">
البته مي توانيد فايل پيکربندي موجود در پکيج را هم ويرايش و يا در فولدر پيکربندي پروژه پابليش کرده و مقادير را مستقيما و بدون ورود در فايل env. جايگزين نماييد
</div>

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
    چنانچه از نسخه هاي پايين تر از 5.5 استفاده مي نمائيد providers و aliases  زير  را به فايل config/app.php اضافه نمائيد:
 </div>  
 
 ```php
// config/app.php
...
'providers':
Hmoradian\FhSms\FhSmsServiceProvider::class,
...
'aliases':
'FhSms' => Hmoradian\FhSms\Facades\FhSms::class,
...
```

<div dir="rtl">
    
### نحوه استفاده در لاراول

</div>

<div dir="rtl">
    هم اکنون مي توانيد با استفاده از Facade اين پکيج (FhSms) به متدهاي پکيج دسترسي داشته باشيد :
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
    
echo  FhSms::getData();
    ...
```

<div dir="rtl">
    
###  استفاده در سيستم اعلانات لاراول

</div>

<div dir="rtl">
    
## توليدکننده

- [Hossein Moradian](https://github.com/hmoradian)
   
## لايسنس


لايسنس اين پکيج (MIT) مي باشد . جهت اطلاعات در مورد اين لايسنس به [License File](LICENSE) مراجعه نماييد. 

</div>
