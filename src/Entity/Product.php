<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Model\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    use IdTrait;

    #[ORM\Column]
    private string $name;

    /**
     * @var Collection<array-key, ProductCategoryReference>
     */
    #[ORM\OneToMany(targetEntity: ProductCategoryReference::class, mappedBy: 'product', cascade: ['persist'] )]
    private Collection $categoryReferences;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->categoryReferences = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array<array-key, Category>
     */
    public function getCategories(): array
    {
        return $this->categoryReferences->map(
            fn(ProductCategoryReference $reference) => $reference->getCategory()
        )->toArray();
    }

    public function addCategory(Category $category, int $randomNumber): void
    {
        $this->categoryReferences->add(new ProductCategoryReference($this, $category, $randomNumber));
    }

    public function removeCategory(Category $category): void
    {
        if ($reference = $this->findReferenceToCategory($category)) {
            $this->categoryReferences->removeElement($reference);
        }
    }

    private function findReferenceToCategory(Category $category): ?ProductCategoryReference
    {
        foreach ($this->categoryReferences as $reference) {
            if ($reference->getCategory() === $category) {
                return $reference;
            }
        }

        return null;
    }
}
