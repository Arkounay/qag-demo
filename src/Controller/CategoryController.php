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

    public function isExportable(): bool
    {
        return true;
    }

    protected function backUrl(): string
    {
        if ($from = $this->request->query->get('from')) {
            return $this->generateUrl($from);
        }
        return parent::backUrl();
    }

}