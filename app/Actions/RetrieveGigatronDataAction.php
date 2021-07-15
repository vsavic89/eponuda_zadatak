<?php

namespace App\Actions;

class RetrieveGigatronDataAction {

    private $result;
    private $parsedJsonResult;
    private $totalPages;    
    private $baseUrl;
    private $url;

    public function __construct()
    {
        $this->result = '';
        $this->baseUrl = 'https://gigatron.rs/prenosni-racunari/laptop-racunari';        
        $this->url = '';
        $this->totalPages = 0;
        $this->parsedJsonResult = '';
    }

    public function prepareRequestForInitialDataResponse() {
        $this->url = $this->baseUrl;              
    }

    public function prepareRequestForDataByPage($page) {
        $this->url = $this->baseUrl . '?strana=' . $page . '&prikaz=grid&poredak=rastuci';
    }    

    public function getTotalPages(){
        return $this->totalPages;
    }

    public function getData() {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $this->result = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);            
            curl_close($ch);

            if($http_status != 200){
                throw new \Exception('Error during data fetching.');
            }
            
            return $this->result;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }  
    }

    public function parsePaginationInfo() {  
        try {      
            $this->totalPages = $this->parsedJsonResult["catalog"]["pages"];
            $this->currentPage = $this->parsedJsonResult["catalog"]["page"];
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getGigatronCatalogItems() {
        \Log::info($this->parsedJsonResult["catalog"]["items"]);
        return $this->parsedJsonResult["catalog"]["items"];
    }

    public function parseResultIntoJson() {
        try {
            $needleStartString = '<script>window.__PRELOADED_STATE__ = ';
            $needleEndString = '</script>';            

            $needleStartPosition = strpos($this->result, $needleStartString) + strlen($needleStartString);
            $needleEndPosition = strpos($this->result, $needleEndString, $needleStartPosition);

            $jsonString = substr(
                $this->result,
                $needleStartPosition,
                $needleEndPosition - $needleStartPosition
            );    

            $this->parsedJsonResult = json_decode($jsonString, true);        

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }                           
    }    
}