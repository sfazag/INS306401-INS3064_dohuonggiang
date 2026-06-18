<?php

require_once 'config/config.php';
require_once 'core/Database.php';
require_once 'core/Model.php';

require_once 'models/TicketModel.php';

$model = new TicketModel();

echo "<pre>";
print_r($model->all());
echo "</pre>";