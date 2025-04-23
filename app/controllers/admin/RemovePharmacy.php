<?php

class RemovePharmacy
{
    use Controller;
    public function index()
    {

        $data['username'] = [];
        $this->view('admin/pharmacyDetails', $data);
    }

    // add other methods like edit, update, delete, etc.
}
