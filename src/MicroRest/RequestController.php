<?php
namespace MicroRest;

abstract class RequestController {
   
   /**
    * Performs the 'GET' request method and provides a response object.
    *
    * @return \MicroRest\ResponseController
    */
   protected function _invokeGetMethod() : ResponseController {
      return new ResponseController(405);
   }
   
   /**
    * Performs the 'PUT' request method and provides a response object.
    *
    * @return \MicroRest\ResponseController
    */
   protected function _invokePutMethod() : ResponseController {
      return new ResponseController(405);
   }
   
   /**
    * Performs the 'POST' request method and provides a response object.
    *
    * @return \MicroRest\ResponseController
    */
   protected function _invokePostMethod() : ResponseController {
      return new ResponseController(405);
   }
   
   /**
    * Performs the 'PUT' request method and provides a response object.
    *
    * @return \MicroRest\ResponseController
    */
   protected function _invokeDeleteMethod() : ResponseController {
      return new ResponseController(405);
   }
   
   /**
    * Performs a request method other than 'GET', 'PUT', 'POST', or 'DELETE' and provides a response object.
    *
    * @return \MicroRest\ResponseController
    */
   protected function _invokeOtherMethod(string $requestMethod) : ResponseController {
      return new ResponseController(405);
   }
   
   /**
    * @var array
    */
   protected $_requestData = [];
   
   public function setRequestData(array $requestData=[]) : void {
      
      $this->_requestData = $requestData;
      
   }
   
   final public function invokeMethod(string $requestMethod) : ResponseController {
      
      if (!preg_match('/^[A-Z]+$/', $requestMethod)) {
         throw new \Error("invalid requestMethod");
      }
      
      if ($requestMethod=='GET') {
         return $this->_invokeGetMethod();
      }
      
      if ($requestMethod=='PUT') {
         return $this->_invokePutMethod();
      }
      
      if ($requestMethod=='POST') {
         return $this->_invokePostMethod();
      }
      
      if ($requestMethod=='DELETE') {
         return $this->_invokeDeleteMethod();
      }
      
      return $this->_invokeOtherMethod($requestMethod);
   }
   
   
   
   
   
   
   
   
   
   
   
}