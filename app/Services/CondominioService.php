<?php

namespace App\Services;

use App\Repositories\CondominioRepository;

class CondominioService
{
    protected $repository;

    public function __construct(CondominioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        $data = $request->all();
        $userID = $request->user()->id;

        return $this->repository->create($data, $userID);
    }

    public function list($request)
    {
        $userID = $request->user()->id;
        $userTipo = auth()->user()->tipo->tipo;

        if ($userTipo === 'Admin') {
            return $this->repository->listAll();
        }

        return $this->repository->list($userID);
    }

    public function search($request)
    {
        $userID = $request->user()->id;
        $isProprietario = auth()->user()->tipo->tipo;

        return $this->repository->search($request, $userID, $isProprietario);
    }
}