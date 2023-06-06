<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprador extends Model
{
    use HasFactory;
    protected $table = 'com_perfils';

    public function getNascimento()
    {
        return isset($this->date_nasc) ? date("d/m/Y", strtotime($this->created_at)) : '';
    }

    public function getCPF()
    {
        if ($this->cpf) {
            return substr($this->cpf, 0, 3) . "." . substr($this->cpf, 3, 3) . "." . substr($this->cpf, 6, 3) . "-" . substr($this->cpf, 9, 2);
        }
        return '';
    }

    public function getCredit()
    {
        return 'R$' . number_format($this->credit, 2, ',', '.');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
