<?php
class NewDriver
{
    use Controller;
    public function index()
    {
        // Protect the route
        $this->protectRoute();
        $data = [];
        $msg= new Pharmacy();
        $Msg = $msg->notification('pending');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pharmacy = new Driver();
            $MsgDriver = $pharmacy->notificationDriver('prnding');
            $data = [
                'driverName' => $_POST['driverName'],
                'deliveryTime' => $_POST['deliveryTime'],
                'contactNo' => $_POST['contactNo'],
                'address' => $_POST['address'],
                'vehicalLicenseNo' => $_POST['vehicalLicenseNo'],
                'approvedDate' => $_POST['approvedDate'],
                'email' => $_POST['email'],
                'status' => $_POST['status'],
                'notification' => $Msg,
                'notificationDriver'=>$MsgDriver
            ];
            if ($pharmacy->validate($data['license'])) {
                // If validation passes, save and redirect
                $pharmacy->insert($data); // Assuming you have an `insert` method in your model
                redirect('admin/pharmacyDetails');
                exit();
            } else {
                // Pass errors to the view
                $data['errors'] = $pharmacy->errors;
            }
        }
        $this->view('admin/newDriver', $data);
    }
}