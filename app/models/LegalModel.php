<?php

class LegalModel
{
    use Model;

    protected $table = 'legal';

    protected $allowed = ['privacy_policy', 'terms_and_conditions'];


    public function getPrivacyPolicy()
    {
        $query = "SELECT privacy_policy FROM $this->table ";

        return $this->query($query);
    }
    public function getTermsConditions()
    {
        $query = "SELECT terms_and_conditions FROM $this->table ";

        return $this->query($query);
    }

    public function legalUpdate($privacy, $terms)
    {
        $sql = "UPDATE $this->table SET privacy_policy = :privacy, terms_and_conditions = :terms";
        return $this->query($sql, ["privacy" => $privacy, "terms" => $terms]);
    }
}
