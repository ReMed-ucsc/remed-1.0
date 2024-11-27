<?php
class NewDriver
{
    use Controller;
    public function index()
    {
        // Protect the route
        $this->protectRoute();
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pharmacy = new Driver();
            $data = [
                'driverName' => $_POST['driverName'],
                'deliveryTime' => $_POST['deliveryTime'],
                'contactNo' => $_POST['contactNo'],
                'address' => $_POST['address'],
                'license' => $_POST['license'],
                'approvedDate' => $_POST['approvedDate'],
                'email' => $_POST['email'],
                'status' => $_POST['status'],
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