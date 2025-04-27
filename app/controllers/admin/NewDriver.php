<?php
class NewDriver
{
    use Controller;

    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {
        // Protect the route
        $this->protectRoute();
        $data = [];
        $msg= new Pharmacy();
        $pharmacy = new Driver();
            $MsgDriver = $pharmacy->notificationDriver('prnding');
        $Msg = $msg->notification('pending');
        $data = [
            'notification' => $Msg,
            'notificationDriver'=>$MsgDriver
        ];
        $this->view('admin/newDriver', $data);
    }
}