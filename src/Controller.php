<?php
namespace Dual;

abstract class Controller {

    private $beforeMiddleware   = [];
    private $afterMiddleware    = [];

    public function options(\Dual\Provider\Apache\Request $Request, \Dual\Provider\Apache\Response &$Response){
        $Response->addHeader('Access-Control-Allow-Methods', strtoupper(implode(',', array_unique(get_class_methods(get_called_class())))));
    }

    public function head(\Dual\Provider\Apache\Request $Request, \Dual\Provider\Apache\Response &$Response){
        $Response->addHeader('Content-Length', 1);
        $Response->setBody(null);
    }

    public function beforeRoute(\Dual\Provider\Apache\Request $Request, \Dual\Provider\Apache\Response &$Response) {
        // do something
        $this->__evaluatePass($pass, 'before');
    }

    public function afterRoute(\Dual\Provider\Apache\Request $Request, \Dual\Provider\Apache\Response &$Response) {
        // do something
        $this->__evaluatePass($pass, 'before');
    }

    public function addBeforeMiddleware($funcs) {
        $this->beforeMiddleware[] = $funcs;
    }

    public function addAfterMiddleware($funcs) {
        $this->afterMiddleware[] = $funcs;
    }

    private function __evaluatePass(bool $pass, string $route) {
        if (!$pass) throw new Exception("error triggered during: {$route}; check logs and/or api response");
    }
}
