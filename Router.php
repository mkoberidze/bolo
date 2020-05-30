<?php
namespace app;

class Router
{
    protected $routes = [];
    protected $postRoutes = [];
    protected $request = null;

    /**
     * Router constructor.
     * @param $request
     */
    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    public function get($path, $closure)
    {
        $this->routes[$path] = $closure;
    }

    public function post($path, $closure)
    {
        $this->postRoutes[$path] = $closure;
    }

    public function resolve()
    {
        $path = $_SERVER['PATH_INFO'] ?? '/';
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if($method === 'get')  {
            $closureOrView = $this->routes[$path] ?? false ;
        } else {
            $closureOrView = $this->postRoutes[$path] ?? false ;
        }

        if($closureOrView) {
            if(is_callable($closureOrView)) {
                echo call_user_func($closureOrView, $this->request,$this);
            } else {
                echo $this->renderView($closureOrView);
            }
        }  else {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
            echo "Not Found";
            exit;
        }
    }

    public function renderView($view,$params = [])
    {
        $content = $this->renderOnlyView($view,$params);
        ob_start();
        include_once __DIR__.'/views/_layout.php';
        return ob_get_clean();
    }

    public function renderOnlyView($view,$params = []){
        ob_start();
        foreach ($params as $key => $value){
            $$key = $value;
        }
        if(is_array($view) or $view == '/') $view = '/home';

        include_once __DIR__ . '\views/'. $view .'.php';
        return ob_get_clean();
    }
}