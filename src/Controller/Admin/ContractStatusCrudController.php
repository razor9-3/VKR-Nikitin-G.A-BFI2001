<?php

namespace App\Controller\Admin;

use App\Entity\ContractStatus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContractStatusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContractStatus::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            -> add(Crud::PAGE_INDEX,Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->setLabel("Идентификатор")->onlyOnIndex(),
            yield NumberField::new('contractId')->setLabel("Идентификационный номер договора"),
            yield DateField::new('statusChange')->setLabel("Дата смены статуса"),
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('id')
            ->add('contractId');
    }
}
