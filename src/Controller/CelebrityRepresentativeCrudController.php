<?php

namespace App\Controller;

use App\Entity\CelebrityRepresentative;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CelebrityRepresentativeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CelebrityRepresentative::class;
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
