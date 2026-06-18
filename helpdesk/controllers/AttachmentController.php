<?php


require_once 'core/Controller.php';
require_once 'models/AttachmentModel.php';



class AttachmentController extends Controller
{


private AttachmentModel $model;


public function __construct()
{

$this->model=
new AttachmentModel();

}




public function upload()
{


$file=$_FILES['file'];


$name =
uniqid()
."_"
.$file['name'];



$path =
"uploads/tickets/"
.$name;



move_uploaded_file(
$file['tmp_name'],
$path
);



$this->model->upload(

[

"ticket_id"=>$_POST['ticket_id'],

"file_name"=>$name,

"file_path"=>$path,

"file_type"=>$file['type'],

"uploaded_by"=>1

]

);



echo "uploaded";


}


}
