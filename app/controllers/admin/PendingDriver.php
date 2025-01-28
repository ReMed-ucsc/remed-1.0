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
    // add other methods like edit, update, delete, etc.
}