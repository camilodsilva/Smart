<?php

namespace Smart\Parsers;

class Parser
{
    /**
     * URL parser gets it and identify controller and its methods
     * 
     * @return Array
     */
    public function url()
    {
        $url = strtolower(isset($_GET['url']) ? filter_var($_GET['url'], FILTER_SANITIZE_URL) : null);

        return explode('/', rtrim($url));
    }

    public function callMethod($url)
    {
        // if (!isset($url[0]) || !isset($url[1]))
        //     throw Exception('Missing controller or method');
        
        // if (!method_exists($url[0], $url[1]))
        //     throw Exception(sprintf('Method not found: %s', $url[0]));
        
        // TODO: Think about this later
        // $params = array();
        // for ($i=2; $i<sizeof($url); $i++)
        // {
        //     echo $params[] = $url[$i];
        // }

        // try {
        //     call_user_func_array();
        // } catch(Exception $e) {

        // }
    }
}