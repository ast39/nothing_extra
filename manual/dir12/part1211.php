<div class="card mt-2 ml-5">
    <div class="card-header" style="border-bottom: none !important;">
        <h5>Работа с SOAP сервисвми <code>\framework\classes\SoapNative</code></h5>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td class="text-left">
                <pre>

class SoapNativeTest extends \framework\classes\SoapNative {

    public function __construct()
    {
        $this->service_link = 'test.asp?wsdl';
    }

    public function testMethod_1($params)
    {
        return $this->scallService($params, 'method_1');
    }

    public function testMethod_2($params)
    {
        return $this->scallService($params, 'method_2');
    }
}
                </pre>
            </td>
        </tr>
        <tr>
            <td class="text-left">
                <code>$soap = new SoapNativeTest();</code><br />
                <code>$soap->callService($params, $method)</code><br />
                Вызвать метод удаленного Soap сервиса</td>
        </tr>

        </tbody>
</div>