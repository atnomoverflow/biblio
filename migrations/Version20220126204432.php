<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126204432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Custom_Emprint_Livre (id INT AUTO_INCREMENT NOT NULL, livre_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FE894C9637D925CB (livre_id), INDEX IDX_FE894C96A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(60) NOT NULL, nom VARCHAR(60) NOT NULL, biographie TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur_livre (auteur_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_A6DFA5E060BB6FE6 (auteur_id), INDEX IDX_A6DFA5E037D925CB (livre_id), PRIMARY KEY(auteur_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editeur (id INT AUTO_INCREMENT NOT NULL, nom_editeur VARCHAR(50) NOT NULL, pays VARCHAR(40) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprint (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date_emprint DATE NOT NULL, state VARCHAR(255) NOT NULL, INDEX IDX_237C2BC3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprint_livre (emprint_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_1CD43697DA6B2D74 (emprint_id), INDEX IDX_1CD4369737D925CB (livre_id), PRIMARY KEY(emprint_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, editeur_id INT NOT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(60) NOT NULL, prix DOUBLE PRECISION NOT NULL, nb_exemplaires INT NOT NULL, isbn VARCHAR(255) NOT NULL, nb_pages INT NOT NULL, date_edition DATE NOT NULL, image VARCHAR(255) NOT NULL, resume TEXT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_AC634F993375BD21 (editeur_id), INDEX IDX_AC634F99BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Custom_Emprint_Livre ADD CONSTRAINT FK_FE894C9637D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE Custom_Emprint_Livre ADD CONSTRAINT FK_FE894C96A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE auteur_livre ADD CONSTRAINT FK_A6DFA5E060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteur_livre ADD CONSTRAINT FK_A6DFA5E037D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprint ADD CONSTRAINT FK_237C2BC3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE emprint_livre ADD CONSTRAINT FK_1CD43697DA6B2D74 FOREIGN KEY (emprint_id) REFERENCES emprint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprint_livre ADD CONSTRAINT FK_1CD4369737D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F993375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur_livre DROP FOREIGN KEY FK_A6DFA5E060BB6FE6');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99BCF5E72D');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F993375BD21');
        $this->addSql('ALTER TABLE emprint_livre DROP FOREIGN KEY FK_1CD43697DA6B2D74');
        $this->addSql('ALTER TABLE Custom_Emprint_Livre DROP FOREIGN KEY FK_FE894C9637D925CB');
        $this->addSql('ALTER TABLE auteur_livre DROP FOREIGN KEY FK_A6DFA5E037D925CB');
        $this->addSql('ALTER TABLE emprint_livre DROP FOREIGN KEY FK_1CD4369737D925CB');
        $this->addSql('ALTER TABLE Custom_Emprint_Livre DROP FOREIGN KEY FK_FE894C96A76ED395');
        $this->addSql('ALTER TABLE emprint DROP FOREIGN KEY FK_237C2BC3A76ED395');
        $this->addSql('DROP TABLE Custom_Emprint_Livre');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE auteur_livre');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE editeur');
        $this->addSql('DROP TABLE emprint');
        $this->addSql('DROP TABLE emprint_livre');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE user');
    }
}
