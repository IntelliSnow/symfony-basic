<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Model\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    use IdTrait;

    #[ORM\Column]
    private string $name;

    public function __construct(
        string $name,
    )
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
