<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Controller extends REST_Controller {
    protected $optionalInputs=[];
    protected $requiredInputs=[];
    protected $apiError='';
    function __construct() {
        parent::__construct();
        $this->load->library('format');
    }
function now(){
return date('Y-m-d H:i:s');
}
    protected function ValidatePostField($requiredInputs=NULL,$optionalInputs=NULL) {
        if ($requiredInputs==NULL && $optionalInputs==NULL):
            return false;
        endif;
       
        $inputStringArray=$this->post();
        if (count($requiredInputs)>count($inputStringArray)):
            $this->apiError='misssing required input fields.';
            return false;
        else:
            foreach($requiredInputs as $key){
                if(array_key_exists($key, $inputStringArray)){
                   unset($inputStringArray[$key]);
                }
            }
        endif;
       
        if(!is_array($optionalInputs) && count($inputStringArray)>0){
             $unknownPostFields=0;
             foreach($inputStringArray as $key=>$value){
                if($unknownPostFields++==0){
                    $this->apiError='containing unknown input '.$key;
                }else{
                     $this->apiError.=', '.$key;
                }
             }
        }
       
        if($this->apiError!=''){
            return false;
        }
       
        $unknownPostFields=0;
            
        foreach($inputStringArray as $key=>$value){
            if(!in_array($key, $optionalInputs)){
                if($unknownPostFields++==0){
                    $this->apiError='containing unknown input '.$key;
                }else{
                    $this->apiError.=', '.$key;
                }
            }       
        }
        if($this->apiError!=''){
            return false;
        }
       
        return true;
    }
      protected function ValidateQueryString($requiredInputs=NULL) {
        $inputStringArray=$this->get();
        if (count($requiredInputs)>count($inputStringArray)):
            $this->apiError='misssing required input fields.';
            return false;
        else:
            $unknownPostFields=0;
            
            foreach($inputStringArray as $key=>$value){
                if(!in_array($key, $requiredInputs)){
                    if($unknownPostFields++==0){
                        $this->apiError='containing unknown input '.$key;
                    }else{
                        $this->apiError.=', '.$key;
                    }
                }       
            }
        endif;
        if($this->apiError!=''){
            return false;
        }
        return true;
    }
}