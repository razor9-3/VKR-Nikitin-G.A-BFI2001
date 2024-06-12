<?php

namespace App\Controller\Admin;

use App\Entity\BillsOfLading;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BillsOfLadingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BillsOfLading::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle( Crud::PAGE_NEW,'Создание товарного поручения')
            ->setPageTitle( Crud::PAGE_EDIT,'Редактирование товарного поручения')
            ->setPageTitle( Crud::PAGE_INDEX,'Список товарных поручений')
            ->setEntityLabelInSingular('');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->setLabel("Идентификатор")->onlyOnIndex(),
            yield TextField::new('recipient')->setLabel("Грузополучатель"),
            yield TextField::new('buyer')->setLabel("ФИО покупателя"),
            yield TextField::new('seller')->setLabel("ФИО продавца"),
            yield NumberField::new('contractId')->setLabel("Идентификатор договора"),
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('recipient')
            ->add('buyer')
            ->add('seller')
            ->add('contractId');
    }
}
