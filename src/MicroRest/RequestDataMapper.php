<?php
namespace MicroRest;

class RequestDataMapper {
   
   public function getRequestData() : array {
      return $this->_requestData;
   }
   
   private $_requestData = [];
   
   public function __construct() {
      if (!empty($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD']=='GET') && isset($_GET)) {
         $this->_requestData = $_GET;
      } else {
         
         /*
          * POST, PUT, DELETE, etc request methods...
          *    the input COULD be available preparsed query string (with $_POST, etc)
          *       --but--
          *    need to handle request's with JSON data input
          *       also...
          *    PHP doesn't put all request methods input data into a convenience super global
          */
         $content_type = '';
         if (!empty($_SERVER["CONTENT_TYPE"])) {
            $content_type = $_SERVER["CONTENT_TYPE"];
         }
         
         $rawinput = file_get_contents('php://input');
         if (!empty($rawinput)) {
            if (false !== (strpos($content_type,"application/json"))) {
               
               if (false !== ($json = json_decode($rawinput,true))) {
                  $this->_requestData = $json;
               } else {
                  throw new \Error("request body contains malformed JSON");
               }
            } else {
               /*
                * determine if input is JSON document
                */
               $json = json_decode($rawinput,true);
               if (false !== $json && NULL !==$json) {
                  $this->_requestData = $json;
               } else {
                  /*
                   * determine if input is query string
                   *    (like browser processed HTML forms do by default for POST, etc actions)
                   */
                  parse_str($rawinput, $result);
                  
                  if (!empty($result)) {
                     $this->_requestData = $result;
                  }
               }
            }
         }
         
      }
   }
}