<?php

namespace App\Controllers;

class AdminController extends Controller
{
    public function saveRates()
    {
        $rates = $this->rates()->getRatesForSave();
        foreach ($rates as $name => $rate)
        {
            $this->db()->insert('rates',[
                'name' => $name,
                'rate_id' => $rate['id'],
                'self_to_rub' => $rate['self_to_rub'],
                'rub_to_self' => $rate['rub_to_self'],
            ]);
        }
    }
    public function updateRates()
    {
        $rates = $this->rates()->getRatesForSave();
        foreach ($rates as $rate)
        {
            $this->db()->update('rates', $rate['id'], [
                'self_to_rub' => $rate['self_to_rub'],
                'rub_to_self' => $rate['rub_to_self'],
            ]);
        }
    }
    public function getRates()
    {
        if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'])
        {
            $rates = $this->db()->getAll('rates');
            include_once APP_PATH . '/views/pages/admin.php';
        } else {
            echo 'unauthorized user';
        }

    }
}