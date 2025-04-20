<?php

class ManufacturedDrug
{
    use Model;

    protected $table = 'manufacturedDrug';
    protected $allowed = ['ProductID', 'ProductName', 'DrugID', 'ManufactureName', 'strength', 'unitPrize'];

    public function getDrugIDs($productIDs)
    {
        if (empty($productIDs)) {
            return null;
        }

        // Create placeholders for each ID
        $placeholders = implode(',', array_fill(0, count($productIDs), '?'));

        $query = "SELECT DrugID FROM $this->table WHERE ProductID IN ($placeholders)";
        $result = $this->query($query, $productIDs);

        if ($result) {
            return array_map(function ($item) {
                return $item->DrugID;
            }, $result);
        }

        return null;
    }
}
