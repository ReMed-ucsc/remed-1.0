<?php

class Drug
{
    use Model;

    protected $table = 'drug';
    protected $allowed = ['DrugID', 'genericName', 'overTheCounter', 'form', 'category'];

    public function checkForOverTheCounter($drugIDs)
    {
        if (empty($drugIDs)) {
            return true; // No drugs to check, all are considered OTC
        }

        // Create placeholders for each ID
        $placeholders = implode(',', array_fill(0, count($drugIDs), '?'));

        $query = "SELECT COUNT(*) as count FROM $this->table WHERE DrugID IN ($placeholders) AND overTheCounter = 'N'";
        $result = $this->query($query, $drugIDs);

        if ($result) {
            return $result[0]->count;
        }
        return null;
    }
}
