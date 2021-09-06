<?php

namespace App\Document;

use App\Repository\TodoSiMaiBunRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="TodoSiMaiBun", repositoryClass=TodoSiMaiBunRepository::class)
 */
class TodoSiMaiBun
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $idUser;

    /**
     * @ODM\Field(type="string")
     */
    private $task;

    /**
     * @ODM\Field(type="integer")
     */
    private $importance;

    /**
     * @ODM\Field(type="boolean")
     */
    private $completed;

    public function getId()
    {
        return $this->id;
    }

    public function getIdUser(): ?string
    {
        return $this->idUser;
    }

    public function setIdUser(string $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(string $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getImportance(): ?int
    {
        return $this->importance;
    }

    public function setImportance(int $importance): self
    {
        $this->importance = $importance;

        return $this;
    }

    public function getCompleted(): ?bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): self
    {
        $this->completed = $completed;

        return $this;
    }
}
