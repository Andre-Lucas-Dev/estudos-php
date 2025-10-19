<?php

namespace App\Services;

use App\Repositories\ApartamentoRepository;
use App\Rules\ApartamentoRule;

class ApartamentoService
{
    protected $repository;
    protected $apartamentoRule;

    public function __construct(ApartamentoRepository $repository, ApartamentoRule $apartamentoRule)
    {
        $this->repository = $repository;
        $this->apartamentoRule = $apartamentoRule;
    }

    public function create($request)
    {
        $data = $request->all();

        $apartamento = $this->apartamentoRule->validaApartamentoPorBloco($data['bloco'], $data['numero']);

        if(!$apartamento){
            return $this->repository->create($data);
        }

        return false;
    }

    public function list()
    {
        $userTipo = auth()->user()->tipo->tipo;
        
        if ($userTipo === 'Admin') {
            return $this->repository->listAll();
        }
        
        return $this->repository->listByUser(auth()->id());
    }

    public function update($request, $id)
    {
        $data = $request->all();
        $apartamento = $this->repository->find($id);
        
        if (auth()->user()->tipo->tipo === 'Proprietário' && $apartamento->user_proprietario !== auth()->id()) {
            abort(403, 'Você não pode editar apartamentos de outros proprietários.');
        }

        return $this->repository->update($apartamento, $data);
    }

    public function delete($id)
    {
        $apartamento = $this->repository->find($id);
        
        if (auth()->user()->tipo->tipo === 'Proprietário' && $apartamento->user_proprietario !== auth()->id()) {
            abort(403, 'Você não pode deletar apartamentos de outros proprietários.');
        }

        return $this->repository->delete($apartamento);
    }
}