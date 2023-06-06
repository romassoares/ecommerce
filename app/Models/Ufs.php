<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Ufs extends Model
{
    use HasFactory;

    public function getUfs()
    {
        $ufs = Http::withoutVerifying()
            ->get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
            ->object();
        return $ufs;
    }
}
