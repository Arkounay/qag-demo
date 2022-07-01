<?php

namespace App\Controller;

use App\Entity\Category;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Controller\Crud;

class CategoryController extends Crud
{

    public function getEntity(): string
    {
        return Category::class;
    }

    public function isDeletable($entity): bool
    {
        return false;
    }

    public function isEditable($entity): bool
    {
        return false;
    }

    public function isViewable($entity): bool
    {
        return true;
    }
}