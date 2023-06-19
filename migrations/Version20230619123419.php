<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619123419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pen (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number INT DEFAULT NULL, surface NUMERIC(8, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokemon ADD pen_id INT DEFAULT NULL, CHANGE shiny shiny TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3A9CBC84D FOREIGN KEY (pen_id) REFERENCES pen (id)');
        $this->addSql('CREATE INDEX IDX_62DC90F3A9CBC84D ON pokemon (pen_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3A9CBC84D');
        $this->addSql('DROP TABLE pen');
        $this->addSql('DROP INDEX IDX_62DC90F3A9CBC84D ON pokemon');
        $this->addSql('ALTER TABLE pokemon DROP pen_id, CHANGE shiny shiny INT NOT NULL');
    }
}
