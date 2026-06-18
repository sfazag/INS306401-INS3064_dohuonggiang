<?php


require_once 'models/RoutingKeywordModel.php';



class TicketRoutingService
{


private RoutingKeywordModel $keywordModel;



public function __construct()
{

$this->keywordModel =
new RoutingKeywordModel();

}




/*
AUTO FIND CATEGORY
*/


public function route(
string $title,
string $description=''
)
{


$text =
mb_strtolower(
$title." ".$description
);



$keywords =
$this->keywordModel
->getKeywords();



$scores=[];



foreach($keywords as $keyword)
{


$word =
mb_strtolower(
$keyword['keyword']
);



if(
str_contains(
$text,
$word
)
)
{

$cat =
$keyword['category_id'];



if(!isset($scores[$cat]))
{
$scores[$cat]=0;
}


$scores[$cat]++;

}


}




if(empty($scores))
{

return null;

}




arsort($scores);



return array_key_first($scores);



}






}
