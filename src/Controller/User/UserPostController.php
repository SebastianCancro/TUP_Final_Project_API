<?php 

use Src\Utils\ControllerUtils;
use Src\Service\User\UserCreatorService;

final readonly class UserPostController {
    private UserCreatorService $service;

    public function __construct() {
        $this->service = new UserCreatorService();
    }

    public function start(): void
    {
        $name = ControllerUtils::getPost("name");
        $genre_id = ControllerUtils::getPost("genre_id");
        $description = ControllerUtils::getPost("description");
        $image = ControllerUtils::getPost("image");
        $date = ControllerUtils::getPost("date");

        $this->service->create($name, $genre_id, $description, $image, $date);
    }
}