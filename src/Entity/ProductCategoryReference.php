<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Model\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class ProductCategoryReference
{

    #[ORM\ManyToOne(inversedBy: 'categoryReferences')]
    #[ORM\Id]
    private Product $product;

    #[ORM\ManyToOne]
    #[ORM\Id]
    private Category $category;

    #[ORM\Column]
    private int $randomNumber;

    public function __construct(
        Product $product,
        Category $category,
        int $randomNumber,
    )
    {
        $this->product = $product;
        $this->category = $category;
        $this->randomNumber = $randomNumber;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getRandomNumber(): int
    {
        return $this->randomNumber;
    }

    public function setRandomNumber(int $randomNumber): void
    {
        $this->randomNumber = $randomNumber;
    }
}
