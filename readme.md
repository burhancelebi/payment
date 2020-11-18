### Installation ###

Firstly you have to add this json to your composer.json

    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/burhancelebi/payment.git"
        }
    ]

To instal package run command below

    composer require virtual/payment

After installing package you need to extract config file your app config directory.

    php artisan vendor:publish --provider="Virtual\Payment\PaymentServiceProvider"

clear and cache your config

    php artisan config:cache

After these you can customize your config file with the information you have. 
Don't forget , you have to run php artisan config:cache for each changing in config file

Before using create your routes and add these links to app/Http/Middleware/VerifyCsrfToken.php $except array. 
I created like below. These links don't need to laravel token
because payment companies don't send token so we have to add to avoid get an error.

    'http://127.0.0.1:8000/iyzico-result/',
    'http://127.0.0.1:8000/paytr-result',
    'http://127.0.0.1:8000/paytr-fail',
    'http://127.0.0.1:8000/nestpay-fail',
    'http://127.0.0.1:8000/nestpay-result',

### USING ###

**Using Iyzico**

    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Virtual\Payment\Iyzico\Iyzico;

    class IyzicoController extends Controller
    {
        private $payment;
        
        public function __construct()
        {
            $this->payment = new Iyzico();
        }
        
        public function iyzico()
        {
            $this->payment->setUserAddress('Test Adres');

            $request = $this->payment->request();
            $request->setPrice('10');
            $request->setPaidPrice(5);
            $request->setConversationId("123456789");
            
            $basketItem = $this->payment->basketItem();

            $basketItem->setId(1);
            $basketItem->setName('Burhan');
            $basketItem->setCategory1('Category');
            $basketItem->setPrice("10");
            $basketItem->setItemType('PHYSICAL');
            
            $this->payment->request()->setBasketItems($this->payment->appendItem($basketItem));

            $this->payment->setCardHolderName('Burhan Çelebi');
            $this->payment->setCardNumber('5890040000000016');
            $this->payment->setCvv('123');
            $this->payment->setExpMonth('02');
            $this->payment->setExpYear('2024');
            
            $this->payment->setMerchantOid(rand(111111, 999999));
            $this->payment->setEmail('burhan.celebi.2112@gmail.com');
            $this->payment->setBuyerUserName('Burhan Çelebi');
            $this->payment->setUserAddress('Avcılar');
            $this->payment->setUserPhone('0543 537 0024');

            $buyer = $this->payment->buyer();
            $buyer->setId(123);
            
            $request->setBuyer($buyer);

            $this->payment->request()->setPaymentCard($this->payment->paymentCard());
            $this->payment->request()->setBillingAddress($this->payment->address());
            $this->payment->request()->setShippingAddress($this->payment->address());
            
            try {
                
                $html = $this->payment->init3D(); // To get html content in your view you can use this : {!! $html->getHtmlContent() !!}
                // $result = $this->payment->non3D(); // If you don't want to use 3d , you can use this method instead of init3D

                // dd($result); // while you use non3D method you can't get any html result .

            } catch (\Exception $e) {
                return $e->getMessage();
            }

            // dd($result->getStatus()); // You can check status
            
            return view('test', compact('html'));
        }

        public function iyzicoResult(Request $request)
        {
            return $this->payment->except('mdStatus')->getIyzicoMessage();
        }
    }


**Using Paytr**

    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Virtual\Payment\Paytr\Paytr;

    class PaytrController extends Controller
    {
        private $payment;
        
        public function __construct()
        {
            $this->payment = new Paytr();
        }
        
        public function paytr()
        {
            $this->payment->setCardHolderName('Burhan Çelebi');
            $this->payment->setCardNumber('4444555566667777');
            $this->payment->setCvv('000');
            $this->payment->setExpMonth('02');
            $this->payment->setExpYear('2024');
            
            $this->payment->setMerchantOid(rand(111111, 999999));
            $this->payment->setPaymentAmount(15);
            $this->payment->setEmail('burhan.celebi.2112@gmail.com');
            $this->payment->setBuyerUserName('Burhan Çelebi');
            $this->payment->setUserAddress('Avcılar');
            $this->payment->setUserPhone('0543 537 0024');
            $this->payment->setUserBasket(
                array('Hediyelik Esya', 1),
            );
            
            $this->payment->setUserIp(request()->ip());

            $html = $this->payment->send();

            return view('paytr', compact('html'));
        }

        public function result(Request $request)
        {
            return $this->payment->getPaytrMessage();
        }

        public function fail(Request $request)
        {
            return $this->payment->getPaytrMessage();
        }
    }

**Using Ziraat**

    <?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;
        use Virtual\Payment\Nestpay\Banks\Ziraat;

        class NestpayController extends Controller
        {
            private $payment;
            
            public function __construct()
            {
                $this->payment = new Ziraat();
            }
            
            public function nestpay()
            {
                $this->payment->setCardHolderName('Burhan Çelebi');
                $this->payment->setCardNumber(4546711234567894);
                $this->payment->setCvv('000');
                $this->payment->setExpMonth(12);
                $this->payment->setExpYear(26);
                $this->payment->setMerchantOid(rand(111111, 999999));
                $this->payment->setPaymentAmount(102);

                $html = $this->payment->send();

                return view('nestpay', compact('html'));
            }

            public function fail(Request $request)
            {
                return $this->payment->getNestpayMessage();
            }

            public function result(Request $request)
            {
                return $this->payment->getNestpayMessage();
            }
        }

Added new function for Nestpay Payment.
If you want to use IsBank, you can change Ziraat class name to IsBank.
IsBank has a lot of payment method so if you want to use these methods, you can use below.

        <?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;
        use Virtual\Payment\Nestpay\Banks\IsBank;

        class IsBankasiController extends Controller
        {
            private $payment;
                
            public function __construct()
            {
                $this->payment = new IsBank();
            }
            
            public function isBankasi()
            {
                $this->payment->setPaymentAmount('91.96');
                $this->payment->setGirogateMobile('906163343245');
                $this->payment->setPaymentType('GIROGATE_GIROPAY');
                $this->payment->setCCode('DE');
                $this->payment->withGiroPay(); // This function is will use GiroPay method.

                // If you use giropay method , you don't need these.
                // $this->payment->setCardHolderName('Burhan Çelebi');
                // $this->payment->setCardNumber(4546711234567894);
                // $this->payment->setCvv('000');
                // $this->payment->setExpMonth(12);
                // $this->payment->setExpYear(26);
                
                $this->payment->setMerchantOid(rand(111111, 999999));
                $this->payment->setPaymentAmount(102);
                
                $html = $this->payment->send();

                return view('nestpay', compact('html'));
            }

            public function fail(Request $request)
            {
                return $this->payment->getIsBankMessage();
            }

            public function success(Request $request)
            {
                return $this->payment->getIsBankMessage();
            }
        }

**Useful Functions**

***Setter Functions***

    setCardNumber($card_number)
    
    setConfig($config)
    
    setCardHolderName(string $card_holder_name)
    
    setCvv($cvv)
    
    setExpMonth($exp_month)
    
    setExpYear($exp_year)
    
    setIyzicoOptions()

    setCountry(string $country)

    setCity(string $city)

    setRegistrationAddress(string $registration_address)

    setIdentityNumber(string $identity_number)
    
    setLocale($locale = false)
    
    setInstallmentCount( $installment_count = false )
    
    setCurrency($currency = false)
    
    paymentChannel($channel = false)
    
    paymentGroup($payment_group = false)
    
    setUserIp( $userIp = false)
    
    setConversationId($conversation_id)
    
    setTotalPrice($total_price)
    
    setBuyerId($buyer_id)
    
    setBuyerSurname($buyer_surname)
    
    setDeliveryName(string $delivery_name)
    
    setDeliveryCity(string $delivery_city)
    
    setDeliveryAddress(string $delivery_address)
    
    setMerchantOid($merchantOid)
    
    setEmail(string $email)
    
    setPaymentAmount($payment_amount)
    
    setIyzicoToken($iyzicoToken)
    
    setUserBasket($userBasket)
    
    setBuyerUserName($buyer_name)
    
    setUserAddress($userAddress)

    setUserPhone($userPhone)
    
    setPaymentType($payment_type = false)
    
    setPaytrToken($paytrToken)

    setMerchantOkUrl($merchant_ok_url = false)
    
    setMerchantFailUrl($merchant_fail_url = false)
    
    setNon3dTestFailed($non3d_test_failed = false)
    
    setNon3d($non_3d = false)
    
    setRnd($rnd = false)

    setLang($lang = false)

    setTransactionType(string $transactionType)
    
    setNestpayToken($nestpayToken)
    
    setClientID()

    setStoreKey()

    setStoreType($store_type = false)

    setGirogateMobile(string $girogatemobile)

    setCCode(string $ccode)

***Getter Functions***

    getCardNumber()
    
    getCardHolderName()
    
    getCvv()
    
    getExpMonth()
    
    getExpYear()
    
    getIyzicoOptions()
    
    getCountry()

    getCity()

    getRegistrationAddress()

    getIdentityNumber()
    
    getLocale()
    
    getInstallmentCount()
    
    getUserIp()
    
    getPaymentChannel()
    
    getPaymentGroup()
    
    getConversationId()
    
    getTotalPrice()
    
    getBuyerId()
    
    getBuyerSurname()
    
    getMerchantOid()
    
    getEmail()
    
    getPaymentAmount()
    
    getUserBasket()
    
    getBuyerUserName()
    
    getDeliveryName()
    
    getDeliveryCity()
    
    getDeliveryAddress()
    
    getUserAddress()
    
    getUserPhone()
    
    getMerchantOkUrl()
    
    getMerchantFailUrl()
    
    getCurrency()
    
    getCurlUrl(): ?string
    
    getIyzicoToken()
    
    private function getUserBasketAsJson()
    
    getPaymentType()
    
    getMerchantId()
    
    getPaytrToken()
    
    function getInitialPaytrToken()
    
    getNoInstallment()
    
    getMaxInstallment()
    
    getTestMode()
    
    getDebugOn()
    
    getMerchantKey()
    
    getMerchantSalt()
    
    getTimeOutLimit()
    
    getNon3dTestFailed()
    
    getNon3d()
    
    getStoreKey()
    
    getClientID()
    
    getRnd()
    
    getTransactionType()
    
    getLang()
    
    getNestpayToken()
    
    getStoreType()

    getGirogateMobile()

    getCCode()