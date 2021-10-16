<?php

namespace App\Controller;

use App\Entity\Celebrity;
use App\Entity\CelebrityRepresentative;
use App\Entity\Representative;
use App\Entity\RepresentativeType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CelebrityCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Celebrity::class;
    }
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
    
    public function configureResponseParameters(KeyValueStore $responseParameters): KeyValueStore
    {
        if (Crud::PAGE_DETAIL === $responseParameters->get('pageName')) {
            $celebrityId = $_GET['entityId'];
            $this->assignRepresentative($_POST, $celebrityId);
            $celebrityRepresentatives = $this->getDoctrine()
                ->getRepository(CelebrityRepresentative::class)
                ->findBy(array('celebrity_id' => $celebrityId));
            $responseParameters->set('celebrityRepresentatives', $celebrityRepresentatives);
            $representatives = $this->getDoctrine()
                ->getRepository(Representative::class)
                ->findAll();
            $responseParameters->set('representatives', $representatives);
            $representativeTypes = $this->getDoctrine()
                ->getRepository(RepresentativeType::class)
                ->findAll();
            $responseParameters->set('representativeTypes', $representativeTypes);
        }

        return $responseParameters;
    }
    
    public function assignRepresentative($reqData, $celebrityId)
    {
        if (isset($reqData['removeRepresentative']) && !empty($reqData['celebRepsRemove'])) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($reqData['celebRepsRemove'] as $celebRep) {
                $celebrityRepresentative = $this->getDoctrine()->getRepository(CelebrityRepresentative::class)->find($celebRep);
                $entityManager->remove($celebrityRepresentative);
            }
            $entityManager->flush();
            return new RedirectResponse($reqData['referrer']);
        } else if (isset($reqData['assignRepresentative']) && !empty($reqData['representative']) && !empty($reqData['representative_type'])) {
            $celebrity = $this->getDoctrine()
                ->getRepository(Celebrity::class)
                ->find($celebrityId);
            $representative = $this->getDoctrine()
                ->getRepository(Representative::class)
                ->find($reqData['representative']);
            $representative_type = $this->getDoctrine()
                ->getRepository(RepresentativeType::class)
                ->find($reqData['representative_type']);
            $entityManager = $this->getDoctrine()->getManager();
            $celebrityRepresentative = new CelebrityRepresentative();
            $celebrityRepresentative->setTerritory($reqData['territory']);
            $celebrityRepresentative->setCelebrity($celebrity);
            $celebrityRepresentative->setRepresentative($representative);
            $celebrityRepresentative->setRepresentativeType($representative_type);
            $entityManager->persist($celebrityRepresentative);
            $entityManager->flush();
            return new RedirectResponse($reqData['referrer']);
        }
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
