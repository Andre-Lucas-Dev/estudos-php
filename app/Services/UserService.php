<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        $data = $request->all();
        return $this->repository->create($data);
    }

    public function me($request)
    {
        $userID = $request->user()->id;
        return $this->repository->findMe($userID);
    }

    public function list()
    {
        return $this->repository->findAll();
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}