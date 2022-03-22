<?php
function info(string $message){
    set('info', $message);
}

function success(string $message){
    set('success', $message);
}

function warning(string $message){
    set('warning', $message);
}

function danger(string $message){
    set('danger', $message);
}




function set($type, $message)
{
    $_SESSION['flash'][$type][] = $message;
}

function getMessages()
{
   
    $flashes = ($_SESSION['flash']) ?? '';
    //var_dump($flashes); die();
    if(empty($flashes)) return '';
    $html = "";
    foreach ($flashes as $flash => $messages){
        $html .= '<div class="alert alert-'.$flash.'" id="flash" role="alert">';
        $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>';
        if (is_array($messages)){
            //var_dump($messages); die();
            foreach ($messages as $message){
        
                $html .= $message;
            }
        }elseif (is_string($messages)){
            $html .= $messages;

        }

        $html .= "</div>";
    }
    destroy();
    return $html;
}

function destroy(){
    unset($_SESSION['flash']);

}

?>