<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126213650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE emprint_livre');
        $this->addSql('ALTER TABLE Custom_Emprint_Livre ADD emprint_id INT NOT NULL');
        $this->addSql('ALTER TABLE Custom_Emprint_Livre ADD CONSTRAINT FK_FE894C96DA6B2D74 FOREIGN KEY (emprint_id) REFERENCES emprint (id)');
        $this->addSql('CREATE INDEX IDX_FE894C96DA6B2D74 ON Custom_Emprint_Livre (emprint_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emprint_livre (emprint_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_1CD4369737D925CB (livre_id), INDEX IDX_1CD43697DA6B2D74 (emprint_id), PRIMARY KEY(emprint_id, livre_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE emprint_livre ADD CONSTRAINT FK_1CD4369737D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emprint_livre ADD CONSTRAINT FK_1CD43697DA6B2D74 FOREIGN KEY (emprint_id) REFERENCES emprint (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Custom_Emprint_Livre DROP FOREIGN KEY FK_FE894C96DA6B2D74');
        $this->addSql('DROP INDEX IDX_FE894C96DA6B2D74 ON Custom_Emprint_Livre');
        $this->addSql('ALTER TABLE Custom_Emprint_Livre DROP emprint_id');
    }
}
