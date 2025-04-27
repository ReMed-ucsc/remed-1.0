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
        
        $driver = new Driver();
        $data = [
            'driver'=>$driver,
            'error'=>[]
        ];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_POST['driverName'] ?? '';
            $telNo = $_POST['telNo'] ?? '';
            $email = $_POST['email'] ?? '';
            $time = $_POST['deliveryTime'] ?? '' ;
            $license = $_POST['vehicalLicenseNo'] ?? '' ;

            $existError=$driver->existingDriver($license );

            if (empty($name)) {
                $data['errors']['driverName'] = "Driver Name is required !";
            }
            if (empty($telNo)) {
                $data['errors']['telNo'] = "Contact Number is required !";
            }
            if (empty($time)) {
                $data['errors']['deliveryTime'] = "Delivery time is required !";
            }
            if (!empty($existError)) {
                $data['errors']['vehicalLicenseNo'] = "License Number Is Exist !";
            }
            if (empty($license)) {
                $data['errors']['vehicalLicenseNo'] = "Vehicle License Number is required !";
            }
            if (empty($email)) {
                $data['errors']['email'] = "Email is required !";
            }
            if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
                $data['errors']['email'] = "Wrrong Email !";
            }
            // Prepare driver data
            $updateData = [
                'driverName' => $name,
                'telNo' => $telNo,
                'email' => $email,
                'deliveryTime' => $time,
                'vehicalLicenseNo' => $license,
                'status'=>"APPROVED",
                'token' => md5(uniqid()),
                'fcmToken' => md5(uniqid())
            ];

            // Validate and save
            if (empty($data['errors'])) {
                $driver->insert($updateData);
                redirect('admin/driverDetails');
            } else {
                $data['errors'] = array_merge($data['errors'], $driver->errors ?? []);
            }
        }
        $this->view('admin/newDriver',$data);
    }
    

    // add other methods like edit, update, delete, etc.
}

