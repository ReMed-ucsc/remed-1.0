<?php

class PendingPharmacy
{
    use Controller;
    public function index()
    {
        $pharmacy = new Pharmacy;
        $pharmacyModel = $pharmacy->getPharmacies("PENDING");
        $data = [
            'pharmacy' => $pharmacyModel
        ];
        $this->view('admin/pendingPharmacy', $data);
    }
    public function onbordPharmacy($id)
    {
        $pharmacyModel = new Pharmacy();
        $pharmacy = $pharmacyModel->getPharmacyById($id);

        if (!$pharmacy) {
            redirect("admin/PendingPharmacy");
            exit();
        }

        $data = [
            'pharmacy' => $pharmacy
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [

                'name' => $_POST['name'],
                'pharmacistName' => $_POST['pharmacistName'],
                'RegNo' => $_POST['RegNo'],
                'contactNo' => $_POST['contactNo'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'status' => 'APPROVED',
                'document' => $_FILES['document'] ?? null
            ];
            show($data);
            // File upload handling
            if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = BASE_PATH . '/uploads/license/';
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

                $pharmacyModel->update($id, $data, 'pharmacyId');
                redirect('admin/PharmacyDetails');
                exit();
            } else {
                $data['errors'] = $pharmacyModel->errors;
            }
        }

        $this->view('admin/editPharmacy', $data);
    }



}

// add other methods like edit, update, delete, etc.

