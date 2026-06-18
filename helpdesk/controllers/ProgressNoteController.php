<?php

require_once 'core/Controller.php';
require_once 'models/ProgressNoteModel.php';



class ProgressNoteController extends Controller
{


private $model;



public function __construct()
{

$this->model=
new ProgressNoteModel();

}



public function store()
{


$this->model->create(

[

"ticket_id"=>$_POST['ticket_id'],

"staff_id"=>1,

"note_text"=>$_POST['note_text']

]

);


echo "saved";


}



}
