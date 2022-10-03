<?php
/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 24.07.2019
 * Time: 14:09
 */


namespace framework\classes;


class SoapNative {

    protected $service_link;
    
    public function callService($params, $method)
    {
        try {

            $client = new \SoapClient($this->service_link, [

                    'cache_wsdl'         => WSDL_CACHE_DISK,
                    'exceptions'         => 1,
                    'connection_timeout' => 5,
                    'features'           => SOAP_SINGLE_ELEMENT_ARRAYS,
                    "trace"              => true
                ]
            );

            return $client->__soapCall($method, ['params' => $params]);

        } catch(\SoapFault $fault) {

            $log = 'Date: ' . date('Y-m-d H:i:s', time()) . PHP_EOL;
            $log .= 'Service: ' . $this->service_link . PHP_EOL;
            $log .= 'Method: ' . $method . PHP_EOL;
            $log .= 'Error: ' . $fault . PHP_EOL;
            Log::getInstance()->appendLog('_soap_native_', $log);
            Log::getInstance()->saveLog('_soap_native_');

            return false;
        }
    }
}