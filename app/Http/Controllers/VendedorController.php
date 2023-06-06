<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendedorController extends Controller
{
    private $vendedor;

    public function __construct(Vendedor $vendedor)
    {
        $this->vendedor = $vendedor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->vendedor->get();

        return view('vendedor.index', ['users' => $users]);
    }

    public function status(Request $request)
    {
        $vendedor = $this->vendedor->find($request->user_id_input);
        if ($vendedor) {
            $vendedor->update(['status' => $request->status]);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $query = $this->vendedor->query();

        if (isset($request->name)) {
            $query->join('users', 'ven_perfils.user_id', 'users.id')
                ->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if (isset($request->status)) {
            $query->where('status', $request->status);
        }

        if (isset($request->credit)) {
            $query->where('credit', '<=', $request->credit);
        }

        $vendedor = $query->paginate(10);

        return view('vendedor.index', ['users' => $vendedor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
