<?php

require_once 'core/Controller.php';
require_once 'models/ChatMessageModel.php';



class ChatController extends Controller
{


private $model;



public function __construct()
{

$this->model=
new ChatMessageModel();

}



public function send()
{


$this->model->create(

[

"ticket_id"=>$_POST['ticket_id'],

"user_id"=>1,

"message"=>$_POST['message']

]

);


echo "sent";


}


}
