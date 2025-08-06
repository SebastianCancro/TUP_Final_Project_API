<?php 

namespace Src\Service\User;

use Src\Entity\User\User;
use Src\Infrastructure\Repository\User\UserRepository;
use Src\Service\Gender;
use Src\Service\Gender\GenderFinderService;

final readonly class UserCreatorService {
    private UserRepository $repository;
    private GenderFinderService $genderFinder;

    public function __construct() {
        $this->repository = new UserRepository();
        $this->genderFinder = new GenderFinderService();
    }

    public function create(string $name, int $genre_id, string $description, string $image, string $date): void
    {
        $genre = $this ->genderFinder->find($genre_id);
        $user = User::create($name, $genre->id(), $description, $image, $date);
        $this->repository->create($user);
    } 
}