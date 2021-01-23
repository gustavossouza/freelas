<?php

namespace App\Domain\Usuarios\Service;

use App\Domain\Usuarios\Model\User;

class ServiceUsuario
{
    public $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function get()
    {
        return $this->model->all();
    }

    public function findById($usuarioId)
    {
        return $this->model->find($usuarioId);
    }

    public function create(array $request)
    {
        return $this->model->create($request);
    }

    public function update(array $request, $usuarioId)
    {
        $user = $this->findById($usuarioId);

        $user->fill($request);
        $user->update();

        return $user;
    }

    public function delete($usuarioId)
    {
        $user = $this->findById($usuarioId);
        $user->delete();

        return $user;
    }
}