<?php
namespace app;

class Request implements IRequest
{
    /**
     * Request constructor.
     */
    public function __construct()
    {
        foreach ($_SERVER as $key => $value) {
            $camelCaseKey = $this->toCamelCase($key);
            $this->{$camelCaseKey} = $value;
        }
    }

    public function toCameLCase($result)
    {
        $result = strtolower($result);
        preg_match_all('/_[a-z]/' , $result, $matches);
        foreach ($matches[0] as $match){
            $c = str_replace('_', '',strtoupper($match));
            $result = str_replace($match,$c,$result);
        }
        return $result;
    }

    public function getBody()
    {
        $data = [];
        if($this->getMethod() === 'post'){
            foreach ($_POST as $key => $value){
                $data[$key] = filter_input(INPUT_POST,$key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        } else if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value){
                $data[$key] = filter_input(INPUT_GET,$key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $data;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getPath()
    {
        return $_SERVER['PATH_INFO'] ?? '/';
    }
}