<?php

namespace App\Controller\Admin;

use App\Entity\Legal;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LegalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Legal::class;
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            -> remove(Crud::PAGE_INDEX,Action::BATCH_DELETE)
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle( Crud::PAGE_NEW,'Создание карточки юридического лица')
            ->setPageTitle( Crud::PAGE_EDIT,'Редактирование карточки юридического лица')
            ->setPageTitle( Crud::PAGE_INDEX,'Список юридических лиц')
            ->setEntityLabelInSingular('')
            ->setEntityLabelInPlural('Юридические лица');
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')->hideOnForm();

            yield FormField::addColumn('col-xxl-6');
            yield FormField::addFieldset()->setLabel('Общие данные юридического лица');

            yield TextField::new('name', 'Название');
            yield TextField::new('ownershipForm', 'Форма собственности')->hideOnIndex()->setColumns(6);
            yield DateField::new('registrationDate', 'Дата регистрации')->hideOnIndex()->setColumns(4);
            yield TextField::new('director', 'Директор')->setColumns(6);
            yield TextField::new('accountant', 'Бухгалтер')->hideOnIndex()->setColumns(6);
            yield TextField::new('inn', 'ИНН');
            yield TextField::new('ogrn', 'ОГРН');
            yield TextField::new('kpp', 'КПП');

            yield FormField::addColumn('col-xxl-4');
            yield FormField::addFieldset()->setLabel('Контакты');
            yield TextField::new('address', 'Адрес');
            yield TextField::new('phone', 'Телефон');
            yield EmailField::new('email', 'Email');

            yield FormField::addColumn('col-xxl-10');
            yield FormField::addFieldset()->setLabel('Банковские реквизиты');
            yield TextField::new('bik', 'БИК')->hideOnIndex()->setColumns(2);;
            yield TextField::new('bankName', 'Имя банка')->hideOnIndex()->setColumns(10);;
            yield TextField::new('correspondentAccount', 'Корреспондентский счет')->hideOnIndex()->setColumns(6);;
            yield TextField::new('checkingAccount', 'Расчетный счет')->hideOnIndex()->setColumns(6);;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('id')
            ->add('name')
            ->add('registrationDate')
            ->add('inn')
            ->add('ogrn')
            ->add('kpp')
            ->add('bik');
    }
}
