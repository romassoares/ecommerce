<?php

namespace App\Http\Controllers;

use App\Models\Comprador;
use App\Models\Ufs;
use Illuminate\Http\Request;

class CompradorController extends Controller
{
    private $comprador;
    private $ufs;

    public function __construct(Comprador $comprador, Ufs $ufs)
    {
        $this->comprador = $comprador;
        $this->ufs = $ufs;
    }

    public function index()
    {
        $compradores = $this->comprador->get();
        $ufs = $this->ufs->getUfs();
        return view('compradores.index', ['compradores' => $compradores, 'ufs' => $ufs]);
    }

    public function search(Request $request)
    {
        $query = $this->comprador->query();

        if (isset($request->name)) {
            $query->join('users', 'com_perfils.user_id', 'users.id')
                ->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if (isset($request->data_nasc)) {
            $query->where('data_nasc', $request->data_nasc);
        }

        if (isset($request->cpf)) {
            $query->where('cpf', 'LIKE', '%' . $request->cpf . '%');
        }
        if (isset($request->estado)) {
            $query->where('state', $request->estado);
        }
        if (isset($request->credit)) {
            $query->where('credit', '<=', $request->credit);
        }
        $compradores = $query->paginate(10);
        $ufs = $this->ufs->getUfs();
        return view('compradores.index', ['compradores' => $compradores, 'ufs' => $ufs]);
    }
}
