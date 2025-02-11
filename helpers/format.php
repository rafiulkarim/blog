<?php
class Format{
    public function formatDate($date){
        return date('F j, Y, g:i a', strtotime($date));
    }

    public function testShorten($text, $limit = 480){
        $text = $text."";
        $text = substr($text, 0, $limit);
        $text = $text.".......";
        return $text;
    }

    public function validation($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');

        if($title == 'index'){
            $title = 'home';
        }elseif ($title == 'about') {
            $title = 'about';
        }elseif ($title=='contact') {
            $title = 'contact';
        }
        return $title = ucwords($title);
    }

}
?>