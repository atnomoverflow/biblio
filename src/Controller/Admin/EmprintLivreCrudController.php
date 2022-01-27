<?php

namespace App\Controller\Admin;

use App\Entity\EmprintLivre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EmprintLivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EmprintLivre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('state')->setFormType(ChoiceType::class)->setFormTypeOptions([
                'choices' => [
                    "Non Remis" => "Non Remis", 
                    "Remis" => "Remis",
                ]
                ]),
            TextField::new('user')->onlyOnIndex(),

        ];
    }
}
