<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entity\User;
use App\Controllers\AbstractController;
use App\Http\Interfaces\RequestInterface;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends AbstractController
{
    public function __construct(
        private RequestInterface $request,
        private UserRepositoryInterface $userRepository = new UserRepository()
    ) {}

    public function index(): void
    {
        $users = $this->userRepository->list();

        $this->view('index', ['users' => $users]);
    }

    public function show(int $id): void
    {
        $user = $this->userRepository->find($id);

        $this->view('show', ['user' => $user]);
    }

    public function create(): void
    {
        $this->view('create');
    }

    public function store(): void
    {
        $data = $this->request::getBody();

        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        $this->userRepository->save($user);

        $this->redirect('users')
            ->with('success', 'Registrado com sucesso caralhooooo');
    }

    public function edit(int $id): void
    {
        $user = $this->userRepository->find($id);

        $this->view('edit', ['user' => $user]);
    }

    public function update(int $id): void
    {
        $data = $this->request::getBody();

        $user = new User();
        $user->setId($id);
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $this->userRepository->update($user);

        $this->redirect('users')->with('success', 'Atualizouuuu');
    }

    public function destroy(int $id): void
    {
        $this->userRepository->delete($id);

        $this->redirect('users')->with('success', 'Apagouuu');
    }
}
