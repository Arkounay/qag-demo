<?php

namespace App\Controller;

use App\Entity\Article;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Controller\Crud;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Model\Action;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Model\Actions;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Model\Filters;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Model\Modal;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Crud
{

    public function getEntity(): string
    {
        return Article::class;
    }

    protected function getFilters(): Filters
    {
        return parent::getFilters()
            ->add('type')
            ->add('date')
            ->add('published');
    }

    public function getGlobalActions(): Actions
    {
        $actions = parent::getGlobalActions();

        $statModal = new Modal($this->translator, 'Stats');
        $statModal->setTitle('Published articles stats');
        $statModal->setAjaxTarget($this->generateUrl('qag.article_stats'));

        $statModalAction = new Action('stats');
        $statModalAction->setModal($statModal);
        $statModalAction->setLabel('Stats');
        $actions->add($statModalAction);

        return $actions;
    }

    public function statsAction(): Response
    {
        $allArticlesCount = $this->repository->count([]);
        $publishedArticlesCount = $this->repository->count(['published' => true]);

        return $this->render('@ArkounayQuickAdminGenerator/crud/entities/article/_stats_modal.html.twig', [
            'all_articles_count' => $allArticlesCount,
            'published_articles_count' => $publishedArticlesCount,
            'unpublished_articles_count' => $allArticlesCount - $publishedArticlesCount
        ]);
    }

}