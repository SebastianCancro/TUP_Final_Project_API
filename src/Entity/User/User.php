<?php 

namespace Src\Entity\User;

final class User {
    public function __construct(
        private readonly ?int $id,
        private string $name,
        private int $genre_id,
        private string $description,
        private string $image,
        private string $date,
        private bool $deleted
    ) {
    }

    public static function create(string $name, int $genre_id, string $description, string $image, string $date): self
    {
        return new self(null, $name, $genre_id,$description, $image,$date, false);
    }

    public function modify(string $name, int $genre_id, string $description, string $image, string $date): void
    {
        $this->name = $name;
        $this->genre_id = $genre_id;
        $this->description = $description;
        $this->image = $image;
        $this->date = $date;
    }

    public function delete(): void
    {
        $this->deleted = true;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function genre_id(): int
    {
        return $this->genre_id;
    }

    public function description(): string
    {
        return $this->description;
    }
    public function image(): string
    {
        return $this->image;
    }
    public function date(): string
    {
        return $this->date;
    }
    public function deleted(): int
    {
        return $this->deleted ? 1 : 0;
    }
}