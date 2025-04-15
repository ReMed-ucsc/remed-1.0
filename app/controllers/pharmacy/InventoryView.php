<?php

class InventoryView
{
    use Controller;
    public function index($batchID)
    {
        $inventoryModel = new PharmacyInventory();
        $inventory = $inventoryModel->getMedicineInventory($batchID);

        //pass the data to the view
        $this->View('pharmacy/inventoryView', ['batchID' => $batchID, 'inventory' => $inventory]);
    }

    public function read($batchID)
    {
        $inventoryModel = new PharmacyInventory();
        $inventory = $inventoryModel->getMedicineInventory($batchID);

        //pass the data to the view
        $this->View('pharmacy/inventoryView', ['batchID' => $batchID, 'inventory' => $inventory, 'viewOnly' => true]);
    }

    // add other methods like edit, update, delete, etc.
}
