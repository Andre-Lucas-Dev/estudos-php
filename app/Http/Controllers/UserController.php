<?php

namespace App\Http\Controllers;

use App\Constants\Geral;
use App\Http\Requests\AdminUserRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $user = $this->service->me($request);

        return ['status' => true, 'message' => Geral::USUARIO_ENCONTRADO, "usuario" => $user];
    }

    public function list()
    {
        $users = $this->service->list();

        return ['status' => true, 'message' => Geral::USUARIO_ENCONTRADO, "usuarios" => $users];
    }

    public function create(UserRequest $request)
    {
        $user = $this->service->create($request);

        return ['status' => true, 'message' => Geral::USUARIO_CADASTRADO, "usuario" => $user];
    }

    public function adminCreate(AdminUserRequest $request)
    {
        $user = $this->service->create($request);

        return ['status' => true, 'message' => Geral::USUARIO_CADASTRADO, "usuario" => $user];
    }

    public function destroy(string $id)
    {
        $user = $this->service->delete($id);

        return ['status' => true, 'message' => Geral::USUARIO_DELETADO, "usuario" => $user];
    }
}