<?php 

namespace Src\Infrastructure\Repository\User;

use Src\Entity\User\User;

interface UserRepositoryInterface {
    public function find(int $id): ?User;

    /** @return User[] */
    public function search(): array;

    public function searchByGenre(int $genre_id): array;

    public function create(User $user): void;

    public function update(User $user): void;
}