<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Http_request_logger {


    public function start_log(){
        log_message('CUSTOM', '++++++++++++++++++++++++++++++++++++++[LOG START]+++++++++++++++++++++++++++++++++');
        log_message('CUSTOM', '++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++');
    }
    

    public function log_all() {
        $CI = & get_instance();

        $argv = $url =  $query_string = $referrer = '';

        if(isset($_SERVER['argc'])){
            $argv = implode('/',$_SERVER['argv']);
        }

        if(isset($_SERVER['REQUEST_URI'])){
            $url = $_SERVER['REQUEST_URI'];
        }

        if(isset($_SERVER['QUERY_STRING'])){
            $query_string = $_SERVER['QUERY_STRING'];
        }

        if(isset($_SERVER['HTTP_REFERER'])){
            $referrer = $_SERVER['HTTP_REFERER'];
        }


        
        log_message('CUSTOM', ' ===================================[START]===================================');
        log_message('CUSTOM', '[ARGV]==== ' . $argv );
        log_message('CUSTOM', '[URI]==== ' . $url);
        log_message('CUSTOM', '[QUERY_STRING]==== ' . $query_string);
        log_message('CUSTOM', '[REFERRER]==== ' . $referrer);

        log_message('CUSTOM', '[GET]==== ' . var_export($CI->input->get(null), true));
        log_message('CUSTOM', '[POST]==== ' . var_export($CI->input->post(null), true));  
        
        log_message('CUSTOM', '========================================[END]=========================================='. " \n \n");


        // log_message('CUSTOM', '$_SERVER -->' . var_export($_SERVER, true));
    }
    public function logQueries() {
        $CI = & get_instance();

        //SQL Queries
        log_message('CUSTOM', '===================================[START SQL QUERIES]===================================');
        if(count($CI->db->query_times) > 0) {
            $times = $CI->db->query_times;
            foreach ($CI->db->queries as $key => $query) 
            { 
                if($query!=''){
                    if((substr($query, 0, 6)!='SELECT') && (substr($query, 0, 6)!='select') ){
                        $sql = " \n \n ". $query . " \n \n Execution Time:" . $times[$key] ." \n "; 
                        log_message('CUSTOM',  $sql);
                    }
                    
                }
            }
        }
        log_message('CUSTOM', '===================================[END SQL QUERIES]===================================');
       
    }

    public function end_log(){
        log_message('CUSTOM', '++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++');
        log_message('CUSTOM', '++++++++++++++++++++++++++++++++++++++++++[LOG END]+++++++++++++++++++++++++++++++++++++++++');
        log_message('CUSTOM', '++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++');

    }


}
