<?php

namespace App\Controller\Admin;

use App\Entity\Act;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ActCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Act::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle( Crud::PAGE_NEW,'Создание акта приёма передачи')
            ->setPageTitle( Crud::PAGE_EDIT,'Редактирование акта приёма передачи')
            ->setPageTitle( Crud::PAGE_INDEX,'Список актов приёма передачи')
            ->setEntityLabelInSingular('');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->setLabel("Идентификатор")->onlyOnIndex(),
            yield NumberField::new('contract')->setLabel("Идентификационный номер договора"),
            yield TextField::new('buyer')->setLabel("ФИО покупателя"),
            yield TextField::new('seller')->setLabel("ФИО продавца"),
            yield TextField::new('vehicleBrand')->setLabel("Марка транспорта"),
            yield TextField::new('vehicleModel')->setLabel("Модель транспорта"),
            yield DateField::new('yearOfManufacture')->setLabel("Дата изготовления"),
            yield TextField::new('passportSeries')->setLabel("Серия ПТС")>setRequired(false),
            yield NumberField::new('passportNumber')->setLabel("Номер ПТС")>setRequired(false),
            yield DateField::new('passportDate')->setLabel("Дата выдачи ПТС")>setRequired(false),
            yield TextField::new('vin')->setLabel("Идентификационный номер транспорта"),
            yield TextField::new('bodyworkNumber')->setLabel("Номер кузова")>setRequired(false),
            yield TextField::new('engineNumber')->setLabel("Номер двигателя")>setRequired(false),
            yield TextField::new('vehicleColor')->setLabel("Цвет кузова")>setRequired(false),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('vehicleBrand')
            ->add('vehicleModel')
            ->add('yearOfManufacture')
            ->add('vin')
            ->add('bodyworkNumber')
            ->add('engineNumber')
            ->add('vehicleColor');
    }

}
