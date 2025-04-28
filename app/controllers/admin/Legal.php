<?php

class Legal
{
    use Controller;

    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {

        $legal = new LegalModel;
        $msg = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $msg -> notification('pending');
        $privacyArr = $legal->getPrivacyPolicy();         
        $termsArr = $legal->getTermsConditions();         

        $privacy = $privacyArr[0]->privacy_policy ?? '';
        $terms = $termsArr[0]->terms_and_conditions ?? '';


        $data = [
            'privacy' => $privacy,
            'terms' => $terms,
            'notification' => $Msg,
            'notificationDriver'=>$MsgDriver
        ];
        $this->view('admin/legal', $data);
    }
    public function legalEdit()
    {
        $legalModel = new LegalModel;

        // Fetch current content
        $existing = $legalModel->findAll();

        $data = [
            'privacy' => $existing[0]->privacy_policy ?? '',
            'terms' => $existing[0]->terms_and_conditions ?? ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $privacy = $_POST['privacy_policy'] ?? '';
            $terms = $_POST['terms_conditions'] ?? '';

            // Update in DB
            $legalModel->legalUpdate($privacy, $terms);

            redirect('admin/legal');
            exit();
        }

        // Load edit view
        $this->view('admin/legal', $data);
    }



    // add other methods like edit, update, delete, etc.
}
