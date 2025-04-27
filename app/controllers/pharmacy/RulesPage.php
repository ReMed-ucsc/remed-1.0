<?php

class RulesPage
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

        if (!isset($_SESSION['user_id'])) {
            redirect('login'); // or show an unauthorized message
            exit();
        }

        $pharmacyID = $_SESSION['user_id'];

        $pharmacyModel = new Pharmacy($pharmacyID);
        $legal = new LegalModel();
        $legalPolicy = $legal->getTermsConditions();
        $pharmacyData = $pharmacyModel->getPharmacyById($pharmacyID);
        $privacy_policy = $legal->getPrivacyPolicy();
        $date = $legal->getDate();

        $this->view('pharmacy/rulesPage', ['pharmacyData' => $pharmacyData, 'legalPolicy' => $legalPolicy, 'privacy_policy' => $privacy_policy, 'date' => $date]);
    }

    // add other methods like edit, update, delete, etc.
}
