<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findMe($userID)
    {
        return User::with('tipo')->where('id', $userID)->first();
    }

    public function create($data)
    {
        return User::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'telefone' => $data['telefone'],
            'tipo_usuario_id' => $data['tipo_usuario_id'] ?? 3,
            'email' => strtolower($data['email']),
            'password' => bcrypt($data['password']),
        ]);
    }

    public function findAll()
    {
        return User::with('tipo')->whereNull('deleted_at')->paginate(10);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->deleted_at = now();
            $user->save();
        }
        return $user;
    }
}