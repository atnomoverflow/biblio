<?php

namespace App\Controller\Admin;

use App\Entity\Emprint;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EmprintCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Emprint::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            CollectionField::new('livres')->onlyOnIndex(),
            TextField::new('user')->onlyOnIndex(),
            TextField::new('state')->setFormType(ChoiceType::class)->setFormTypeOptions([
                "choices" => [
                    'Non Remis'  => 'Non Remis',
                    'Remis'    => 'Remis',
                ]
            ]),
        ];
    }
    
}
