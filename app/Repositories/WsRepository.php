<?php

namespace Sibas\Repositories;

use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

class WsRepository
{
    public function getCustomer($dni)
    {
        SoapWrapper::add(function($service) {
            $service
                ->name('customer')
                ->wsdl('http://10.16.11.16:8077/WS/WebServiceSudamericana.asmx?WSDL')
                ->trace(true)                       // Optional: (parameter: true/false)
                // ->header()                          // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
                // ->customHeader($customHeader)       // Optional: (parameters: $customerHeader) Use this to add a custom SoapHeader or extended class
                // ->cookie()                          // Optional: (parameters: $name,$value)
                // ->location()                        // Optional: (parameter: $location)
                // ->certificate()                     // Optional: (parameter: $certLocation)
                ->cache(WSDL_CACHE_NONE)               // Optional: Set the WSDL cache
                ->options(['wPwd' => 't874j563bk580fghu']);   // Optional: Set some extra options
        });

        $data = [
            'wPwd'   => 't874j563bk580fghu',
            'wDocId' => $dni,
        ];

        SoapWrapper::service('customer', function ($service) use ($data) {
            $response = $service->call('su_PersonaGetByDocId', [$data]);

            dd(explode('|', $response->su_PersonaGetByDocIdResult));
        });
    }
}