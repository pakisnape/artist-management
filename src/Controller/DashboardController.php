<?php

namespace App\Controller;

use App\Entity\Celebrity;
use App\Entity\Representative;
use App\Entity\RepresentativeType;
use App\Entity\User;
use App\Entity\Logs;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/ams", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Artist Management');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Celebrities', 'fa fa-user', Celebrity::class);
        yield MenuItem::linkToCrud('Representatives', 'fa fa-user', Representative::class);
        yield MenuItem::linkToCrud('Representative Types', 'fa fa-user', RepresentativeType::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Logs', 'fa fa-user', Logs::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
