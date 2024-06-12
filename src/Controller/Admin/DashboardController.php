<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Act;
use App\Entity\Article;
use App\Entity\BillsOfLading;
use App\Entity\Contract;
use App\Entity\ContractItem;
use App\Entity\ContractStatus;
use App\Entity\PaymentOrder;
use App\Entity\Vehicle;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        if(is_null($this->getUser()))
            $this->redirectToRoute("app_login");
        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('vehicle sales')
            ->renderContentMaximized()
            ->setLocales(['ru'=>'Русский']);
    }

    //конфигурация панели управления
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Главная', 'fa fa-home');
        yield MenuItem::subMenu('Управление пользователями');

        if(is_null($this->getUser())) {
            $this->redirectToRoute("app_login");
        } else {
            $this->getUser()->eraseCredentials();
        }

//        $this->getUser()->eraseCredentials();
//
//        if((!is_null($this->getUser())) && $this->getUser()->getRoles()[0]==="ROLE_ADMIN"){
  //          yield MenuItem::linkToCrud('User', 'fa fa-user-circle-o', User::class);
    //    }

        yield MenuItem::subMenu("Склад", "fa fa-university")
            ->setSubItems(
                [
                    MenuItem::linkToCrud('Автомобили', 'fa fa-car', Vehicle::class)
                        ->setController(VehicleCrudController::class)
                        ->setPermission("ROLE_USER_STORE"),

                    MenuItem::linkToCrud('Акты приема-передачи', 'fa fa-suitcase', Act::class)
                        ->setController(ActCrudController::class)
                        ->setPermission("ROLE_USER_STORE"),

                    MenuItem::linkToCrud('Товарные накладные', 'fa fa-cubes', BillsOfLading::class)
                        ->setController(BillsOfLadingCrudController::class)
                        ->setPermission("ROLE_USER_STORE")
                        ->setPermission("ROLE_USER_SALE")
                        ->setPermission("ROLE_USER_FIN")

                ]
        );

        yield MenuItem::subMenu("Продажи", "fa fa-bolt")
            ->setSubItems(
                [
                    MenuItem::linkToCrud('Договор на поставку', 'fa fa-file-o', Contract::class)
                        ->setController(ContractCrudController::class)
                        ->setPermission("ROLE_USER_SALE"),
                    MenuItem::linkToCrud('Позиции договора на поставку', 'fa fa-file-o', ContractItem::class)
                        ->setController(ContractItemCrudController::class)
                        ->setPermission("ROLE_USER_SALE"),
                    MenuItem::linkToCrud('Юридические лица', 'fas fa-building', LegalEntity::class)
                        ->setController(LegalCrudController::class)
                        ->setPermission("ROLE_USER_SALE"),


                ]
            );

        yield MenuItem::subMenu("Бухгалтерия", "fa fa-usd")
            ->setSubItems(
                [
                    MenuItem::linkToCrud('Артикулы', 'fa fa-file-text-o', Article::class)
                        ->setController(ArticleCrudController::class)
                        ->setPermission("ROLE_USER_FIN"),

                    MenuItem::linkToCrud('Платежные поручения', 'fa fa-suitcase', PaymentOrder::class)
                        ->setController(PaymentOrderCrudController::class)
                        ->setPermission("ROLE_USER_FIN"),

                ]
            );



//        yield MenuItem::linkToCrud('Пользователи', 'fa fa-user-circle-o', User::class)->setPermission("ROLE_ADMIN");
//        yield MenuItem::linkToCrud('Артикулы', 'fa fa-file-text-o', Article::class);
//        yield MenuItem::linkToCrud('Товарные накладные', 'fa fa-cubes', BillsOfLading::class);
//        yield MenuItem::linkToCrud('Договоры на поставку', 'fa fa-handshake-o', Contract::class);
//        yield MenuItem::linkToCrud('Позиции договора', 'fa fa-shopping-basket', ContractItem::class);
//        yield MenuItem::linkToCrud('Статусы договора', 'fa fa-cog', ContractStatus::class);
//        yield MenuItem::linkToCrud('Платежные поручения', 'fa fa-money', PaymentOrder::class);
//        yield MenuItem::linkToCrud('Автомобили', 'fa fa-car', Vehicle::class);
        //yield MenuItem::linkToCrud('Admin', 'fa fa-file-text-o', Admin::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        //добавление категории меню "Администрирование"
        yield MenuItem::subMenu("Администрирование", "fa fa fa-wrench")
            ->setSubItems(
                [
                    //добавление пункта меню "Управление пользователями" и установка требуемой для доступа роли
                    MenuItem::linkToCrud('Управление пользователями', 'fa fa-user-circle-o', User::class)
                        ->setController(UserCrudController::class)
                        ->setPermission("ROLE_ADMIN"),

                ]
            )
        ;

    }
}
