<?php 

namespace Src\Infrastructure\Repository\User;

use Src\Infrastructure\PDO\PDOManager;
use Src\Entity\User\User;

final readonly class UserRepository extends PDOManager implements UserRepositoryInterface {
    public function find(int $id): ?User
    {
        $query = <<<HEREDOC
                        SELECT 
                            *
                        FROM
                            user C
                        WHERE
                            C.id = :id AND C.deleted = 0
                    HEREDOC;

        $parameters = [
            "id" => $id,
        ];

        $result = $this->execute($query, $parameters);

        return $this->toUser($result[0] ?? null);
    }

    /** @return User[] */
    public function search(): array
    {
        $query = <<<HEREDOC
                        SELECT
                            *
                        FROM
                            user C
                        WHERE
                            C.deleted = 0
                    HEREDOC;
        
        $results = $this->execute($query);

        $users = [];
        foreach($results as $result) {
            $users[] = $this->toUser($result);
        }

        return $users;
    }

    public function searchByGenre(int $genre_id): array
    {
        $query = <<<HEREDOC
                        SELECT
                            *
                        FROM
                            user C
                        WHERE
                            C.genre_id = :genre_id AND C.deleted = 0
                    HEREDOC;

        $parameters = [
            "genre_id" => $genre_id,
        ];

        $results = $this->execute($query, $parameters);

        $users = [];
        foreach($results as $result) {
            $users[] = $this->toUser($result);
        }

        return $users;
    }


    public function create(User $user): void
    {
        $query = <<<INSERT_QUERY
                        INSERT INTO user (name, genre_id, description, image, date, deleted)
                        VALUES (:name, :genre_id, :description, :image, :date, :deleted)
                    INSERT_QUERY;

        $parameters = [
            "name" => $user->name(),
            "genre_id" => $user->genre_id(),
            "description" => $user->description(),
            "image" => $user->image(),
            "date" => $user->date(),
            "deleted" => $user->deleted()
        ];

        $this->execute($query, $parameters);
    }

    public function update(User $user): void
    {
        $query = <<<UPDATE_CATEGORY
                    UPDATE
                        user
                    SET
                        name = :name,
                        genre_id = :genre_id,
                        description = :description,
                        image = :image,
                        date = :date,
                        deleted = :deleted

                    WHERE
                        id = :id
                UPDATE_CATEGORY;
        
        $parameters = [
            "name" => $user->name(),
            "genre_id" => $user->genre_id(),
            "description" => $user->description(),
            "image" => $user->image(),
            "date" => $user->date(),
            "deleted" => $user->deleted(),
            "id" => $user->id()
        ];

        $this->execute($query, $parameters);
    }

    private function toUser(?array $primitive): ?User {
        if ($primitive === null) {
            return null;
        }

        return new User(
            $primitive["id"],
            $primitive["name"],
            $primitive["genre_id"],
            $primitive["description"],
            $primitive["image"],
            $primitive["date"],
            (bool) $primitive["deleted"]
        );
    }
}