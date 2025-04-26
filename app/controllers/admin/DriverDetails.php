<?php
class DriverDetails
{
    use Controller;

    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {

        $driverDetails = new Driver();
        $msg = new Pharmacy();

        $MsgDriver= $driverDetails->notificationDriver('pending');
        $Msg = $msg->notification('pending');
        $driver = $driverDetails->getDrivers("APPROVED");

        $data = [
            "driver" => $driver,
            'notification' => $Msg,
            'notificationDriver'=> $MsgDriver
        ];

        $this->view('admin/driverDetails', $data);
    }


    public function create()
    {
        // Prepare data for the view
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $driver = new Driver();
            // Prepare driver data
            $data = [
                'driverName' => $_POST['driverName'] ?? '',
                'telNo' => $_POST['telNo'] ?? '',
                'email' => $_POST['email'] ?? '',
                'deliveryTime' => $_POST['deliveryTime'] ?? '',
                'vehicalLicenseNo' => $_POST['vehicalLicenseNo'] ?? '',
                'status'=>"APPROVED",
                'token' => md5(uniqid()),
                'fcmToken' => md5(uniqid())
            ];

            // Validate and save
            if ($driver->validate($data)) {
                $result = $driver->insert($data);
                if ($result) {
                    redirect('admin/driverDetails');
                    exit();
                } else {
                    $data['errors']['general'] = 'Failed to create driver';
                }
            } else {
                $data['errors'] = $driver->errors;
            }
        }

        redirect('admin/driverDetails');
    }
    

    // add other methods like edit, update, delete, etc.
}

