<?php
namespace MicroRest;

class EndpointController {
   
   public function __construct(RequestController $requestController) {
      
      $requestController->setRequestData(
            (new RequestDataMapper())->getRequestData()
      );
      
      $requestMethod = 'GET';
      if (!empty($_SERVER['REQUEST_METHOD'])) {
         $requestMethod = $_SERVER['REQUEST_METHOD'];
      }
      
      $responseController = $requestController->invokeMethod($requestMethod);
      
      $httpStatusCode = $responseController->getHttpStatusCode();
      
      if ($httpStatusCode!=200) {
         
         http_response_code($httpStatusCode);
         
      }
      
      $responseData = $responseController->getResponseData();
      
      if (count($responseData)) {
         header("Content-Type: application/json");
         echo json_encode($responseData);
      }
      
   }
   
}