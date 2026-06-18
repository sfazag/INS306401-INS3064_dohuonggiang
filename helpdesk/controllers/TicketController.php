<?php

require_once 'core/Controller.php';

require_once 'models/TicketModel.php';
require_once 'models/AssignmentModel.php';
require_once 'models/NotificationModel.php';
require_once 'models/AttachmentModel.php';


class TicketController extends Controller
{


    private TicketModel $ticketModel;
    private AssignmentModel $assignmentModel;
    private NotificationModel $notificationModel;
    private AttachmentModel $attachmentModel;



    public function __construct()
    {

        $this->ticketModel = new TicketModel();

        $this->assignmentModel = new AssignmentModel();

        $this->notificationModel = new NotificationModel();

        $this->attachmentModel = new AttachmentModel();

    }





    // ===============================
    // LIST TICKETS
    // ===============================

    public function index()
    {

        $tickets = $this->ticketModel->all();


        require_once 
        'views/tickets/index.php';

    }







    // ===============================
    // CREATE FORM
    // ===============================


    public function create()
    {

        require_once 
        'views/tickets/create.php';

    }








    // ===============================
    // STORE TICKET
    // ===============================


    public function store()
    {


        /*
        TEST TEMP
        bỏ comment khi login hoàn chỉnh
        */

        /*
        $this->requireAuth();
        $user = $this->currentUser();
        */


        // TEST USER ID = 1

        $userId = 1;



        $title =
        trim($_POST['title'] ?? '');



        $description =
        trim($_POST['description'] ?? '');



        $categoryId =
        intval($_POST['category_id'] ?? 1);





        if(
            strlen($title)<5 ||
            strlen($description)<10
        )
        {

            $this->json([
                "success"=>false,
                "message"=>"Invalid data"
            ]);

            return;

        }






        $ticketCode =
        "TK-".date('YmdHis');




        $ticketId =
        $this->ticketModel->create(
        [

            "ticket_code"=>$ticketCode,

            "title"=>$title,

            "description"=>$description,

            "category_id"=>$categoryId,

            "submitter_id"=>$userId,

            "priority"=>"medium",

            "status"=>"open"

        ]);






        // notification

        $this->notificationModel->create(
        [

            "user_id"=>$userId,

            "title"=>"New Ticket",

            "message"=>"Ticket $ticketCode created",

            "notification_type"=>"new_ticket",

            "is_read"=>0

        ]);






        $this->json(
        [
            "success"=>true,

            "ticket_id"=>$ticketId
        ]);



    }









    // ===============================
    // SHOW DETAIL
    // ===============================


    public function show()
    {


        $id =
        intval($_GET['id'] ?? 0);



        if(!$id)
        {
            die("Ticket ID missing");
        }



        $ticket =
        $this->ticketModel->find($id);




        if(!$ticket)
        {
            die("Ticket not found");
        }




        require_once 
        'views/tickets/show.php';


    }





}
