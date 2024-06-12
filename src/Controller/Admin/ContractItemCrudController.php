<?php

namespace App\Controller\Admin;

use App\Entity\ContractItem;
use App\Entity\Vehicle;
use App\Repository\ContractRepository;
use App\Repository\LegalRepository;
use App\Repository\VehicleRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Collection;

class ContractItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContractItem::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle( Crud::PAGE_NEW,'Создание позиции договора')
            ->setPageTitle( Crud::PAGE_EDIT,'Редактирование позиции договора')
            ->setPageTitle( Crud::PAGE_INDEX,'Список позиций договора')
            ->setEntityLabelInSingular('');
    }

    public function configureFields(string $pageName): iterable
    {
        $fields[] = yield IdField::new('id')->setLabel("Идентификатор")->onlyOnIndex();

        if($pageName==Crud::PAGE_EDIT||$pageName==Crud::PAGE_NEW) {
            $fields[] =
                yield AssociationField::new('contract', 'Договор')
                    ->setFormTypeOptions(
                        [
                            'class' => 'App\Entity\Contract',
                            'query_builder' => function (ContractRepository $rep) {
                                return $rep->createQueryBuilder('r')
                                    ->orderBy('r.contractNumber', 'ASC');
                            },
                            'choice_label' => function ($contract) {
                                return $contract->getContractNumber() . ' от ' . $contract->getContractDate()->format('Y-m-d');
                            }
                        ]);

            $fields[] =
                yield AssociationField::new('vehicle', 'Автомобиль')
                    ->setFormTypeOptions(
                        [
                            'class' => 'App\Entity\Vehicle',
                            'query_builder' => function (VehicleRepository $rep) {
                                return $rep->createQueryBuilder('r')
                                    ->orderBy('r.id', 'ASC');
                            },
                            'choice_label' => function ($vehicle) {
                                return $vehicle->getVehicleBrand() . ' ' . $vehicle->getVehicleModel(). ' VIN( ' .$vehicle->getVin() .' )';
                            }
                        ]);

        } elseif($pageName==Crud::PAGE_INDEX) {
            $fields[] = yield AssociationField::new('contract')->setLabel("Договор")
                ->formatValue(function ($value, $entity) {
                    if ($value)
                        return $value->getContractNumber() . ' от ' . $value->getContractDate()->format('Y-m-d');
                });

            $fields[] = yield AssociationField::new('vehicle')->setLabel("Автомобиль")
                ->formatValue(function ($value, $entity) {
                    if ($value)
                        return $value->getVehicleBrand() . ' ' . $value->getVehicleModel(). ' VIN( ' .$value->getVin() .' )' ;
                });
        }
        return $fields;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('vehicle');
    }
}
