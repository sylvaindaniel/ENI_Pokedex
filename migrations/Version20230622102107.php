<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622102107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_specie (type_id INT NOT NULL, specie_id INT NOT NULL, INDEX IDX_29FF624AC54C8C93 (type_id), INDEX IDX_29FF624AD5436AB7 (specie_id), PRIMARY KEY(type_id, specie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_specie ADD CONSTRAINT FK_29FF624AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_specie ADD CONSTRAINT FK_29FF624AD5436AB7 FOREIGN KEY (specie_id) REFERENCES specie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_specie DROP FOREIGN KEY FK_29FF624AC54C8C93');
        $this->addSql('ALTER TABLE type_specie DROP FOREIGN KEY FK_29FF624AD5436AB7');
        $this->addSql('DROP TABLE type_specie');
    }
}
