<?php

namespace App\Controller\Admin;

use App\Entity\PaymentOrder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PaymentOrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PaymentOrder::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle( Crud::PAGE_NEW,'Создание платёжного поручения')
            ->setPageTitle( Crud::PAGE_EDIT,'Редактирование платёжного поручения')
            ->setPageTitle( Crud::PAGE_INDEX,'Список платёжных поручений')
            ->setEntityLabelInSingular('');
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
            yield TextField::new('buyer')->setLabel("ФИО покупателя"),
            yield TextField::new('buyerBank')->setLabel("Банк покупателя"),
            yield TextField::new('seller')->setLabel("ФИО продавца"),
            yield TextField::new('sellerBank')->setLabel("Банк продавца"),
            yield NumberField::new('summ')->setLabel("Сумма требуемая от покупателя"),
            yield NumberField::new('contractId')->setLabel("Идентификационный номер договора"),
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('buyer')
            ->add('buyerBank')
            ->add('seller')
            ->add('sellerBank')
            ->add('contractId');
    }
}
