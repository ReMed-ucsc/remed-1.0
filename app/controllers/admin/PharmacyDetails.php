<?php

class PharmacyDetails
{
    use Controller;

    public function index()
    {
        // Protect the route
        // $this->protectRoute();

        // Get session data
        $PharmacyID = $this->getSession('pharmacy_id');
        $name = $this->getSession('pharmacy_name');
        $authToken = $this->getSession('auth_token');

        // Get all pharmacies
        $PharmacyModel = new Pharmacy();
        $Msg = $PharmacyModel->notification('pending');
        $pharmacy = $PharmacyModel->getPharmacies('APPROVED');


        $data = [
            'pharmacyName' => $name,
            'PharmacyID' => $PharmacyID,
            'authToken' => $authToken,
            'pharmacy' => $pharmacy,
            'notification' => $Msg
        ];



        $this->view('admin/pharmacyDetails', $data);
    }

    public function edit($id)
    {
        // Protect the route

        // $this->protectRoute();

        $pharmacyModel = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $pharmacyModel->notification('pending');
        $pharmacy = $pharmacyModel->first(['PharmacyId' => $id]);


        if (!$pharmacy) {
            redirect('admin/PharmacyDetails');
            exit();
        }

        $data = [
            'notification' => $Msg,
            'notificationDriver' => $MsgDriver,
            'pharmacy' => $pharmacy
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [

                'name' => $_POST['name'],
                'pharmacistName' => $_POST['pharmacistName'],
                'RegNo' => $_POST['RegNo'],
                'contactNo' => $_POST['contactNo'],
                'email' => $_POST['email'],
                'address' => $_POST['pharmacy-address'],
                'notification' => $Msg,
                'notificationDriver' => $MsgDriver,
                'latitude'=>$_POST['latitude'],
                'longitude'=>$_POST['longitude'],
                'document' => $_FILES['document'] ?? null
            ];


            if ($pharmacyModel->validate($data)) {

                $pharmacyModel->update($id, $data, 'pharmacyId');
                redirect('admin/PharmacyDetails');
                exit();
            } else {
                $data['errors'] = $pharmacyModel->errors;
            }
        }

        $this->view('admin/editPharmacy', $data);
    }

    public function create()
    {
        // Protect the route
        // $this->protectRoute();

        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pharmacy = new Pharmacy();

            // Prepare basic data
            $data = [
                'name' => $_POST['name'] ?? '',
                'pharmacistName' => $_POST['pharmacistName'] ?? '',
                'RegNo' => $_POST['RegNo'] ?? '',
                'contactNo' => $_POST['contactNo'] ?? '',
                'address' => $_POST['pharmacy-address'] ?? '',
                'email' => $_POST['email'] ?? '',
                'status' => 'APPROVED',
                'document' => $_FILES['document']['name'],
                'latitude'=>$_POST['latitude'],
                'longitude'=>$_POST['longitude']
            ];

            // show($data);
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
            if ($pharmacy->validate($data)) {
                $result = $pharmacy->insert($data);

                // show($result);
                if ($result) {
                    redirect('admin/PharmacyDetails');
                    exit();
                } else {
                    $data['errors']['general'] = "Failed to create pharmacy";
                }
            } else {
                // show('error');
                $data['errors'] = $pharmacy->errors;
            }
        }

        redirect('admin/pharmacyDetails');
        // $this->view('admin/pharmacyDetails', $data);
    }
    public function delete($id)
    {
        // Protect the route
        // $this->protectRoute();

        $pharmacyModel = new Pharmacy();
        $pharmacyModel->delete($id, 'PharmacyID');
        redirect('admin/PharmacyDetails');
        exit();
    }

}
