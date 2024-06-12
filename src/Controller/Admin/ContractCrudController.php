<?php

namespace App\Controller\Admin;

use App\Entity\Contract;
use App\Entity\ContractItem;
use App\Entity\User;
use App\Repository\LegalRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContractCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contract::class;
    }
    public function updateEntity(EntityManagerInterface|\Doctrine\ORM\EntityManagerInterface $entityManager, $entityInstance): void
    {
         parent::updateEntity($entityManager,$entityInstance);
    }

    public function configureFields(string $pageName): iterable
    {
        //$userRepository = new UserRepository(User::class);

        $fields =   [
            yield IdField::new('id')->hideOnIndex()->hideOnForm()->hideOnDetail(),
            yield IntegerField::new('contractNumber', 'Номер договора')->setColumns(6),
            yield DateField::new('contractDate', 'Дата договора')->setColumns(6),

        ];

        if($pageName==Crud::PAGE_NEW){
            //выставление статуса при создании договора
            $fields[] = yield Field::new('status', 'Статус договора')
                ->setFormTypeOptions(
                    [
                        'disabled' => true,
                        'attr'=>['value'=>'создан']
                    ]
                );
        }elseif($pageName==Crud::PAGE_EDIT){
            $fields[] = yield ChoiceField::new('status', 'Статус договора')
                //создание вариантов статуса договора
                ->setChoices([
                    'Договор создан' => 'создан',
                    'Ожидает оплаты ' => 'оплата',
                    'Оплачен полностью' => 'оплачен(п)',
                    'Оплачен частично' => 'оплачен(ч)',
                    'Отгружен полностью' => 'отгружен(п)',
                    'Отгружен частично' => 'отгружен(ч)',
                    'Исполнен' => 'исполнен',
                    'Отменен' => 'отменен',
                ])->renderAsBadges([
                    // $value => $badgeStyleName
                    //'оплачен(п)' => 'success',
                    'создан' => 'warning',
                    'оплата' => 'warning',
                    'оплачен(п)' => 'info',
                    'оплачен(ч)' => 'info',
                    'отгружен(п)' => 'info',
                    'отгружен(ч)' => 'info',
                    'исполнен' => 'success',
                    'отменен' => 'danger',
                ]);


        }elseif ($pageName==Crud::PAGE_INDEX){
            $fields[] = yield Field::new('status', 'Статус договора');
        }

        if($pageName==Crud::PAGE_EDIT||$pageName==Crud::PAGE_NEW) {
            $fields[] =
                yield AssociationField::new('buyer', 'Покупатель')
                    ->setFormTypeOptions([
                        'class' => 'App\Entity\Legal',
                        //опрос таблицы с юридическими лицами
                        'query_builder' => function (LegalRepository $legalRepository) {
                            return $legalRepository->createQueryBuilder('l')
                                ->orderBy('l.name', 'ASC');
                        },
                        'choice_label' => function ($legal) {
                            //возврат юридических лиц в формате "название (ИНН)"
                            return $legal->getName() . ' (ИНН:' . $legal->getInn() . ')';
                        }
                    ]);

            $fields[]=
                yield AssociationField::new('contragent', 'Представитель дивизиона')
                    ->setFormTypeOptions([
                        'class' => 'App\Entity\User',
                        //опрос таблицы пользователей
                        'query_builder' => function (UserRepository $userRepository) {
                            return $userRepository->createQueryBuilder('u')
                                ->orderBy('u.lastName', 'ASC');
                        },
                        'choice_label' => function ($user) {
                            //возврат пользователей в формате "имя фамилия"
                            return $user->getFirstName() . ' ' . $user->getLastName();
                        }
                    ])->hideOnIndex();
        }elseif ($pageName==Crud::PAGE_INDEX){
            $fields[] =
                yield AssociationField::new('buyer', 'Покупатель')
                    ->formatValue(function ($value, $entity) {
                        return  $value->getName();
                            //$entity->getName() . ' (ИНН:' . $entity->getInn() . ')';
                    });
        }


        $fields[] =
            yield MoneyField::new('amount', 'Сумма требуемая от покупателя')->setCurrency('RUB');

        $fields[] =
            yield MoneyField::new('paid', 'Сумма полученная от покупателя')->setCurrency('RUB');

        if ($pageName === Crud::PAGE_NEW || $pageName === Crud::PAGE_EDIT) {
//            yield AssociationField::new('b_', 'B_ Collection')
//                ->setCrudController(B_CrudController::class)
//                ->setPaginatorPageSize(10) // Optional: set the number of items per page
//                ->setTemplatePath('path_to_template/b_collection_table.html.twig');
/*
            $fields[] =yield CollectionField::new('contractItems', 'Элементы договора')
                ->setEntryType(TextType::class)
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => false,
                ])->setEntryIsComplex()->showEntryLabel();
*/
        }

        return $fields;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['id' => 'ASC'])
            ->setPaginatorPageSize(30)
            ->setPageTitle( Crud::PAGE_NEW,'Создание договора')
            ->setPageTitle( Crud::PAGE_EDIT,'Редактирование договора')
            ->setPageTitle( Crud::PAGE_INDEX,'Список договоров')
            ->setEntityLabelInSingular('');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::BATCH_DELETE);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('contractNumber')
            ->add('status')
            ->add('contractDate');
    }


}
