<?php

namespace App\Controller;

use App\Entity\Article;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Controller\Crud;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Model\Filters;

class ArticleController extends Crud
{

    public function getEntity(): string
    {
        return Article::class;
    }

    protected function getFilters(): Filters
    {
        return parent::getFilters()
            ->add('date')
            ->add('published');
    }

}