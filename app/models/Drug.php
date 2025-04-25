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

    public function getMedicineCategoryChartData()
    {
        $query = "
        SELECT 
            CASE 
                WHEN Category = 'Pain Reliever' THEN 'Pain Killers'
                WHEN Category = 'Vitamins' THEN 'Vitamins'
                WHEN Category = 'Antibiotic' THEN 'Antibiotics'
                ELSE 'Others'
            END AS categoryGroup,
            COUNT(*) AS count
        FROM {$this->table}
        GROUP BY categoryGroup
    ";

        $result = $this->query($query);

        $labels = ['Pain Killers', 'Vitamins', 'Antibiotics', 'Others'];
        $dataMap = array_fill_keys($labels, 0);

        foreach ($result as $row) {
            $dataMap[$row->categoryGroup] = (int)$row->count;
        }

        return [
            'labels' => $labels,
            'data' => array_values($dataMap)
        ];
    }
}
