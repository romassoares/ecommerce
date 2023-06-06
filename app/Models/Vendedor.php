<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;
    protected $table = 'ven_perfils';
    protected $fillable = ['status', 'credit'];

    public function getCredit()
    {
        return 'R$' . number_format($this->credit, 2, ',', '.');
    }

    public function getStatus()
    {

        switch ($this->status) {
            case "pen":
                return 'Pendente';
                break;
            case "apr":
                return 'Aprovado';
                break;
            case "rej":
                return 'Rejeitado';
                break;
            default:
                return 'indefinido';
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
