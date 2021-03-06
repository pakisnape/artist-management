<?php

namespace App\Controller;

use App\Entity\Representative;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RepresentativeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Representative::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
