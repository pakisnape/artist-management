<?php

namespace App\Controller;

use App\Entity\RepresentativeType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RepresentativeTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RepresentativeType::class;
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
