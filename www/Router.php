<?php
namespace TINHCONG;
class Router
{
    static public function parse($url, $request)
    {
        $url = trim($url);

        if ($url == "/")
        {
            $request->controller = "Excels";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            $request->controller = isset($_GET['controller'])?$_GET['controller'] :"";
            $request->action = isset($_GET['action'])?$_GET['action']:"Index";
            $request->params = isset($_GET['params'])?[$_GET['params']]:[];
        }

    }
}
