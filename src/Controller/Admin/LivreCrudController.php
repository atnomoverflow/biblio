<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            ImageField::new('photo_de_couverture', "image")
                ->setBasePath($this->getParameter("app.path.product_images"))
                ->onlyOnIndex(),
            TextField::new('isbn', "ISBN"),
            NumberField::new('nb_pages', "nombre de page"),
            NumberField::new('nb_exemplaires', "nombre de exemplaire"),
            MoneyField::new('prix')->setCurrency('TND'),
            AssociationField::new('auteurs'),
            Field::new('imageFile', "image")
                ->setFormType(VichImageType::class)
                ->hideOnIndex()
                ->setFormTypeOption("allow_delete", false),
            AssociationField::new('editeur')->autocomplete(),
            DateField::new('date_edition', "date de l'edution"),
            AssociationField::new('categorie')->autocomplete(),
        ];
    }
}
