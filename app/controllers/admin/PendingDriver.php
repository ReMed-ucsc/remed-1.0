<?php
class PendingDriver
{
    use Controller;
    public function index()
    {
        // $user = new User;
        // $arr['email'] = "name@example.com";
        // $result = $model->where(data_for_filtering, data_not_for_filtering);
        // $result = $model->insert(insert_data);
        // $result = $model->update(filtering_data updating_data, id_column_for_filtering);
        // $result = $model->delete(id, id_column);
        // $result = $user->findAll();
        // show($result);
        // $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        $driverModel=new Driver();
        $drivers=$driverModel->getDrivers("PENDING");

        $data = [
            'drivers'=>$drivers
        ];
        
        $this->view('admin/pendingDriver', $data);
    }
    public function OnboardDrivers($id){
        $driverModel= new Driver;
        $driver = $driverModel->getDriverId($id);
        if(!$driver){
            redirect("admin/PendingDriver");
            exit();
        }

        $data=[
            'driver'=> $driver
        ];

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $data=[
                'driverName'=>$_POST['driverName'],
                'vehicalLicenseNo'=>$_POST['vehicalLicenseNo'],
                'email'=>$_POST['email'],
                'telNo'=>$_POST['telNo'],
                'status'=>'APPROVED',
                'document'=>$_FILES['document']
            ];
            if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = BASE_PATH . '/uploads/Drivinglicense/';
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

            if ($driverModel->validate($data)) {

                $driverModel->update($id, $data, 'driverID');
                redirect('admin/DriverDetails');
                exit();
            } else {
                $data['errors'] = $driverModel->errors;
            }
        }
         $this->view('admin/editDriver', $data);
    }
    // add other methods like edit, update, delete, etc.
}