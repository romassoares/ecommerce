<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class PerfilRepository
{
    public function addCreditToCom($data)
    {
        $result = DB::table('com_perfils')->insert([
            'user_id' => $data->id,
            'credit' => '10000.00'
        ]);
        return $result ? true : false;
    }

    public function setStatusToPending($user)
    {
        $result = DB::table("ven_perfils")->insert([
            'user_id' => $user->id,
            'status' => "pen"
        ]);
        return $result ? true : false;
    }
}
