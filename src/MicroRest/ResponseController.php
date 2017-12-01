<?php
namespace MicroRest;

class ResponseController {
   public function getResponseData() : array {
      return $this->_responseData;
   }
   public function getHttpStatusCode() : int {
      return $this->_httpStatusCode;
   }
   private $_httpStatusCode;
   private $_responseData;
   
   /**
    * @param int $httpStatusCode
    * @param array $responseData optional
    */
   public function __construct(int $httpStatusCode, array $responseData=[]) {
      
      if ( ($httpStatusCode < 100) || ($httpStatusCode > 599)) {
         throw new \Error("httpStatusCode out of range");
      }
      $this->_httpStatusCode = $httpStatusCode;
      $this->_responseData = $responseData;
   }
}