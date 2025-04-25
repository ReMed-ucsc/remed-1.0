<?php

class Sidebar
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

        // $data['username'] = [];
        // $this->view('pharmacy/sidebar', $data);

        if (!isset($_SESSION['user_id'])) {
            redirect('login'); // or show an unauthorized message
            exit();
        }

        $pharmacyID = $_SESSION['user_id'];

        $pharmacyModel = new Pharmacy();
        $pharmacy = $pharmacyModel->getPharmacyById($pharmacyID);

        show($pharmacy);

        $this->View('inc/pharmacy/sidebar', ['pharmacy' => $pharmacy]);
    }

    // add other methods like edit, update, delete, etc.
}
