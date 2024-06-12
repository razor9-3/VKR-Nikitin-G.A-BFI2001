<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle( Crud::PAGE_NEW,'Создание пользователя')
            ->setPageTitle( Crud::PAGE_EDIT,'Редактирование пользователя')
            ->setPageTitle( Crud::PAGE_INDEX,'Список пользователей')
            ->setEntityLabelInSingular('');
    }

    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->setLabel("Идентификатор")->hideOnIndex()->hideOnForm();
        yield FormField::addColumn('col-xxl-6');
        yield FormField::addFieldset()->setLabel("ФИО");
        yield TextField::new('lastName')->setLabel("Фамилия");
        yield TextField::new('firstName')->setLabel("Имя");
        yield TextField::new('patronymic')->setLabel("Отчество")->hideOnIndex()->setRequired(false);
        yield TextField::new('email')->setLabel("Почта")->setRequired(false);

        yield FormField::addColumn('col-xxl-4');
        yield FormField::addFieldset()->setLabel("Параметры входа");
        yield BooleanField::new('is_active')->setLabel('Пользователь активен');

        yield TextField::new('login')->setLabel("Логин");
        yield TextField::new('password')->setLabel("Пароль")->hideOnIndex();
        yield ChoiceField::new('roles')->setLabel("Роли")->setChoices([
                'Продавец' => 'ROLE_USER_SALE',
                'Бухгалтер' => 'ROLE_USER_FIN',
                'Сотрудник склада' => 'ROLE_USER_STORE',
                'Администратор системы' => 'ROLE_ADMIN',
            ])->renderExpanded()->allowMultipleChoices()->hideOnIndex();

//        yield FormField::addColumn('col-xxl-10');
 //       yield FormField::addFieldset();

//        for($i=0; $i<5; $i++ )
//        {
//           yield TextField::new('Index_'.$i)->setLabel("Индекс_".$i)->setRequired(false);
//        }

    }

    //конфигурация фильтра записей
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('login')
            ->add('firstName')
            ->add('lastName');
    }

}
