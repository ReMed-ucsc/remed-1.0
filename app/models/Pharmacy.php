<?php
class Pharmacy extends User
{
    use Model;

    protected $table = 'pharmacy';

    protected $allowedColumns = [
        'PharmacyID',
        'RegNo',
        'contactNo',
        'address',
        'name',
        'pharmacistName',
        'approvedDate',
        'email',
        'password',
        'token',
        'name',
        'status',
        'document',
        'latitude',
        'longitude'
    ];
    protected $order_column = "PharmacyID";

    public function delete($id, $id_column = 'PharmacyID')
    {
        try {
            // Validate ID
            if (empty($id)) {
                throw new Exception("Invalid pharmacy ID");
            }

            $data[$id_column] = $id;
            $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";

            // Execute the query and check result
            $result = $this->query($query, $data);

            if ($result === false) {
                throw new Exception("Failed to execute delete query");
            }

            return true;
        } catch (Exception $e) {
            error_log("Error deleting pharmacy: " . $e->getMessage());
            return false;
        }
    }
    public function getPharmacyById($id)
    {
        $data = ['PharmacyID' => $id];
        return $this->first($data);
    }

    // function checkLicenseNumberUnique($licenseNumber)
    // {
    //     // Assuming you have a database connection $db
    //     global $db;
    //     $query = $db->prepare("SELECT COUNT(*) FROM pharmacy WHERE license = ?");
    //     $query->execute([$licenseNumber]);
    //     $count = $query->fetchColumn();

    //     return $count == 0;
    // }

    function validate($data)
    {
        $this->errors = []; // Reset errors

        // Validate pharmacy name
        if (empty($data['name'])) {
            $this->errors['name'] = "Pharmacy name is required.";
        }

        // Validate email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }

        // Validate contact number
        if (!is_numeric($data['contactNo']) || strlen($data['contactNo']) < 10) {
            $this->errors['contactNo'] = "Invalid contact number.";
        }

        // Check if license is unique
        // if (!$this->checkLicenseNumberUnique($data['license'])) {
        //     $this->errors['license'] = "License number already exists.";
        // }

        return empty($this->errors); // Pass if no errors
    }

    public function registerPharmacy($name, $pharmacistName, $RegNo, $contactNo, $email, $address, $status = 'APPROVED', $document = null)
    {
        $data = [

            'name' => $name,
            'pharmacistName' => $pharmacistName,
            'RegNo' => $RegNo,
            'contactNo' => $contactNo,
            'email' => $email,
            'address' => $address,
            'status' => $status,
            'document' => $document ?? 'N/A' // Default to 'N/A' if no document
        ];

        return $this->insert($data);
    }

    public function getPharmacies($status = "APPROVED")
    {
        $sql = "Select * FROM $this->table where status = :status";
        return $this->query($sql, ['status' => $status]);
    }

    // public function pendingPharmacy()
    // {
    //     $sql = "SELECT * FROM $this->table WHREE status='Pending'";
    //     $pendingPharmacies = $this->table->query($sql)->fetchAll();

    //     require_once BASE_PATH ."/app/views/admin/pendingPharmacy.view.php";
    // }
    public function getlastId()
    {
        $sql = "SELECT MAX(PharmacyId) AS last_id FROM $this->table WHERE  status = 'APPROVED'";
        return $this->query($sql);

    }
}
