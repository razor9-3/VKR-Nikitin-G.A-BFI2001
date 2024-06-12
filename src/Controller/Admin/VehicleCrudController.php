<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Vehicle;
use App\Repository\ArticleRepository;
use App\Repository\ContractItemRepository;
use App\Repository\ContractRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
class VehicleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vehicle::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle( Crud::PAGE_NEW,'Создание карточки автомобиля')
            ->setPageTitle( Crud::PAGE_EDIT,'Редактирование карточки автомобиля')
            ->setPageTitle( Crud::PAGE_INDEX,'Список автомобилей')
            ->setEntityLabelInSingular('');
    }
    public function configureFields(string $pageName): iterable
    {
        $fields =  [

            yield FormField::addColumn('col-xxl-6'),
            yield IdField::new('id')->setLabel("Идентификатор")->onlyOnIndex(),
            yield TextField::new('vin')->setLabel("Идентификационный номер транспорта"),
            yield TextField::new('vehicleBrand')->setLabel("Марка транспорта"),
            yield TextField::new('vehicleModel')->setLabel("Модель транспорта"),
            yield TextField::new('type')->setLabel("Тип транспорта")->hideOnIndex(),
            yield TextField::new('category')->setLabel("Категория транспорта")->hideOnIndex(),
            yield DateField::new('yearOfManufacture')->setLabel("Дата изготовления"),
            yield TextField::new('engineModel')->setLabel("Модель двигателя")->hideOnIndex()->setRequired(false),
            yield TextField::new('engineNumber')->setLabel("Номер двигателя")->hideOnIndex()->setRequired(false),
            yield TextField::new('chassisNumber')->setLabel("Номер шасси")->hideOnIndex()->setRequired(false),

            yield AssociationField::new('article', 'Артикль')//->autocomplete()
            ->formatValue(function ($value, $entity) {
                if($value)
                    return  $value->getDescription();
            }) -> onlyOnIndex(),

            yield AssociationField::new('article', 'Артикль')
                ->setFormTypeOptions(
                    [
                        'class' => 'App\Entity\Article',
                        'query_builder' => function (ArticleRepository $rep) {
                            return $rep->createQueryBuilder('r');
                        },
                        'choice_label' => function ($article) {
                            return $article->getDescription(). '( ' . $article->getCost() . ' )';
                        }
                    ])->hideOnIndex(),

            yield FormField::addColumn('col-xxl-6'),
            yield TextField::new('bodyworkNumber')->setLabel("Номер кузова")->hideOnIndex()->setRequired(false),
            yield TextField::new('vehicleColor')->setLabel("Цвет кузова")->hideOnIndex()->setRequired(false),
            yield NumberField::new('enginePower')->setLabel("Мощность двигателя(в л.с.)")->hideOnIndex()->setRequired(false),
            yield NumberField::new('engineCapacity')->setLabel("Объём двигателя(в куб. см.)")->hideOnIndex()->setRequired(false),
            yield TextField::new('engineType')->setLabel("Тип двигателя")->hideOnIndex()->setRequired(false),
            yield NumberField::new('mass')->setLabel("Масса без нагрузки(в кг)")->hideOnIndex()->setRequired(false),
            yield TextField::new('manufacturer')->setLabel("Организация-изготовитель")->hideOnIndex()->setRequired(false),
//            yield NumberField::new('articleId')->setLabel("Номер артикула")->setRequired(false),
            yield DateField::new('inDate')->setLabel("Дата загрузки на склад")->hideOnIndex()->setRequired(false),
            yield DateField::new('outDate')->setLabel("Дата выгрузки со склада")->hideOnIndex()->setRequired(false),
            yield NumberField::new('status')->setLabel("Статус"),

            yield AssociationField::new('contractItem', 'Договор')//->autocomplete()
                ->formatValue(function ($value, $entity) {
                    if($value)
                    return  $value->getContract()->getContractNumber() . ' от ' . $value->getContract()->getContractDate()->format('Y-m-d');
            }) -> onlyOnIndex()


        ];

        $fields[] = yield AssociationField::new('contractItem', 'Договор')
            ->setFormTypeOptions(
                [
                    'class' => 'App\Entity\ContractItem',
                    'query_builder' => function (ContractItemRepository $rep) {
                        return $rep->createQueryBuilder('r');
                    },
                    'choice_label' => function ($contractItem) {
                        return $contractItem->getContract()->getContractNumber() . ' от ' . $contractItem->getContract()->getContractDate()->format('Y-m-d');
                    }
                ])->hideOnIndex();
        return $fields;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('vin')
            ->add('vehicleBrand')
            ->add('vehicleModel')
            ->add('type')
            ->add('category')
            ->add('engineModel')
            ->add('vehicleColor')
            ->add('enginePower')
            ->add('inDate')
            ->add('outDate');
    }

}
