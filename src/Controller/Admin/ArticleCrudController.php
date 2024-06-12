<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle( Crud::PAGE_NEW,'Создание артикула')
            ->setPageTitle( Crud::PAGE_EDIT,'Редактирование артикула')
            ->setPageTitle( Crud::PAGE_INDEX,'Список артикулей')
            ->setEntityLabelInSingular('');
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            -> add(Crud::PAGE_INDEX,Action::DETAIL);
    }
    public function configureFields(string $pageName): iterable
    {
//        yield TextEditorField::new('content')->setNumOfRows(10)->hideOnIndex();

        return [
            yield IdField::new('id')->setLabel("Уникальный идентификатор артикля ")-> onlyOnIndex(),
            yield TextField::new('description')->setLabel("Расширенное описание артикля"),
            yield MoneyField::new('cost')->setLabel("Стоимость одной единицы товара")->setCurrency('RUB'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('id')
            ->add('cost');
    }
}
