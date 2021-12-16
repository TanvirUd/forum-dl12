<?php
namespace App\Service;

abstract class Router 
{
    const FORBIDDEN = VIEW_PATH."403.php";
    const NOT_FOUND = VIEW_PATH."404.php";

    /**
     * @return array|false le résultat de l'appel d'une méthode d'un contrôleur, false sinon
     */
    public static function handleRequest()
    {
        //la valeur du param ctrl OU test
        $ctrl = filter_input(INPUT_GET, "ctrl", FILTER_SANITIZE_STRING) ?? DEFAULT_CTRL;
        //la valeur du param action OU index
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) ?? DEFAULT_METHOD;
        //le param id éventuel, null s'il est absent de la requête
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT) ?? null;

        $ctrlFQCN = "App\\Controller\\".ucfirst($ctrl)."Controller";//App\Controller\TestController
        
        if(class_exists($ctrlFQCN)){
            
            $controller = new $ctrlFQCN();//new App\Controller\TestController()

            if(method_exists($controller, $action)){
                //response = ["view" => .../...php, "data" => les données à afficher]
                //C'EST ICI QUE LE CONTROLLER EST APPELE ET QUE SA METHODE EST EXECUTEE
                return $controller->$action($id);
            }
        }
        return false;
    }

    public static function generateToken()
    {
        if(!Session::get("csrf_key")){
            Session::set("csrf_key", bin2hex(random_bytes(32)));
        }
        return hash_hmac("sha256", SECRET_WORD, Session::get("csrf_key"));
    }

    public static function CSRFProtection($token)
    {
        if(Form::isSubmitted()){
            $form_token = Form::getData("csrf_token", "text");
            if(!$form_token || !hash_equals($token, $form_token)){  
                Session::invalidate();
                Session::set("message", ["type" => "error", 'msg' => "Invalid CSRF Token !"]);
                header("Location: index.php");
                die;
            }
        }
    }
}