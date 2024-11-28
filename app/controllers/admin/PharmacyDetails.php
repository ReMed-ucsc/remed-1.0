<?php

class PharmacyDetails
{
    use Controller;

    public function index()
    {
        // Protect the route
        $this->protectRoute();

        // Get session data
        $PharmacyID = $this->getSession('pharmacy_id');
        $pharmacyName = $this->getSession('pharmacy_name');
        $authToken = $this->getSession('auth_token');

        // Get all pharmacies
        $PharmacyModel = new Pharmacy();
        $pharmacy = $PharmacyModel->findAll();

        if ($pharmacy === false) {
            $data['error_message'] = 'Error loading pharmacy data. Please try again later.';
        } else {
            $data['pharmacy'] = $pharmacy;
        }
        // Pass session data to the view
        $data = [
            'pharmacyName' => $pharmacyName,
            'PharmacyID' => $PharmacyID,
            'authToken' => $authToken,
            'pharmacy' => $pharmacy
        ];

        $this->unsetSession('error_message');
        $this->unsetSession('success_message');

        $this->view('admin/pharmacyDetails', $data);
    }

    public function edit($id)
    {
        // Protect the route
        $this->protectRoute();

        $pharmacyModel = new Pharmacy();
        $pharmacy = $pharmacyModel->first(['pharmacyId' => $id]);

        if (!$pharmacy) {
            redirect('admin/PharmacyDetails');
            exit();
        }

        $data = ['pharmacy' => $pharmacy];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'name' => $_POST['pharmacyName'],
                'pharmacistName' => $_POST['pharmacistName'],
                'license' => $_POST['license'],
                'contactNo' => $_POST['contactNo'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
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
        $this->protectRoute();

        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pharmacy = new Pharmacy();
            $data = [
                'pharmacyName' => $_POST['pharmacyName'],
                'pharmacistName' => $_POST['pharmacistName'],
                'license' => $_POST['license'],
                'contactNo' => $_POST['contactNo'],
                'address' => $_POST['address'],
                'email' => $_POST['email'],
                'document' => $_FILES['document'] ?? null,
            ];

            // Handle file upload
            $document = 'N/A';
            if (isset($_FILES['prescription']) && $_FILES['prescription']['error'] === UPLOAD_ERR_OK) {
                $targetDir = BASE_PATH . '/uploads/license/';
                $fileName = uniqid() . '_' . basename($_FILES['prescription']['name']);
                $targetFile = $targetDir . $fileName;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($_FILES['prescription']['tmp_name'], $targetFile)) {
                    $document = $fileName;
                } else {
                    $data['errors']['file'] = "Failed to upload file.";
                }
            }

            if ($pharmacy->validate($data)) {
                $pharmacy->registerPharmacy($data['pharmacyName'], $data['pharmacistName'], $data['license'], $data['contactNo'], $data['email'], $data['address'], $document);
                redirect('admin/PharmacyDetails');
            } else {
                $data['errors'] = $pharmacy->errors;
            }
        }

        $this->view('PharmacyDetails/create', $data);
    }

    public function delete($id)
    {
        // Protect the route
        $this->protectRoute();

        $pharmacyModel = new Pharmacy();
        $pharmacyModel->delete($id, 'PharmacyID');
        redirect('admin/PharmacyDetails');
        exit();
    }
}
