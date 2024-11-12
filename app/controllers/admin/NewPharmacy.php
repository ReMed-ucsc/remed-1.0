<?php
class NewPharmacy
{
    use Controller;
    public function index()
    {
        // $user = new User;
        $arr['email'] = "";
        $this->view('admin/newPharmacy', $arr);
    }
}
