<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\PerfilRepository;
use App\Service\PerfilService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $perfilService;
    private $perfilRepository;

    public function __construct(PerfilService $perfilService, PerfilRepository $perfilRepository)
    {
        $this->perfilService = $perfilService;
        $this->perfilRepository = $perfilRepository;
    }

    public function confirm_email(Request $request)
    {
        $ifexistUser = User::where('email', $request->email)->first();

        $ifCredited = DB::table("com_perfils")->where('id', $ifexistUser->id)->first();

        if ($ifexistUser->type == 'com' && !isset($ifCredited)) {
            $result = $this->perfilRepository->addCreditToCom($ifexistUser);

            return $result ? redirect()->route('home') : view('welcome');
        }
    }
}
