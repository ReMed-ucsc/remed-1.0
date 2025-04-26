<?php

class PendingPharmacy
{
    use Controller;
    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {
        $pharmacy = new Pharmacy;
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $pharmacy->notification('pending');
        $pharmacyModel = $pharmacy->getPharmacies("pending");
        $data = [
            'pharmacy' => $pharmacyModel,
            'notification' => $Msg,
            'notificationDriver' => $MsgDriver
        ];
        $this->view('admin/pendingPharmacy', $data);
    }
    public function onboardPharmacy($id)
    {
        $pharmacyModel = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $pharmacyModel->notification('pending');
        $pharmacy = $pharmacyModel->getPharmacyById($id);

        if (!$pharmacy) {
            redirect("admin/pendingPharmacy");
            exit();
        }

        $data = [
            'pharmacy' => $pharmacy,
            'notification' => $Msg,
            'notificationDriver' => $MsgDriver
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'name' => $_POST['name'],
                'pharmacistName' => $_POST['pharmacistName'],
                'RegNo' => $_POST['RegNo'],
                'contactNo' => $_POST['contactNo'],
                'email' => $_POST['email'],
                'address' => $_POST['pharmacy-address'],
                'status' => 'APPROVED',
                'notification' => $Msg,
                'notificationDriver' => $MsgDriver,
                'latitude'=>$_POST['latitude'],
                'longitude'=>$_POST['longitude'],
                'document' => $_FILES['document']['name'] ?? null
            ];
            show($data);
            // File upload handling
            if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = BASE_PATH . '/uploads/NMRA/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $filename = uniqid() . '_' . basename($_FILES['document']['name']);
                $uploadPath = $uploadDir . $filename;
                if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadPath)) {
                    $data['document'] = $filename;
                } else {
                    $data['errors']['document'] = 'File upload failed';
                }
            }

            // Validate and insert
            if ($pharmacyModel->validate($data)) {

                $pharmacyModel->update($id, $data, 'PharmacyID');
                redirect('admin/PharmacyDetails');
                exit();
            } else {
                $data['errors'] = $pharmacyModel->errors;
            }
        }

        $this->view('admin/onboardPharmacy', $data);
    }
    public function reject($id){
        $pharmacyModel = new Pharmacy();

        $pharmacyModel->rejectPharmacy($id);
        redirect("admin/PendingPharmacy");
    }



}

// add other methods like edit, update, delete, etc.

