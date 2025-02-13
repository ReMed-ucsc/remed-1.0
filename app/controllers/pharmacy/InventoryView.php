<?php

class InventoryView
{
    use Controller;
    public function index()
    {
        $data['viewOnly'] = [true];
        $this->view('pharmacy/inventoryView', $data);
    }

    // add other methods like edit, update, delete, etc.
}
