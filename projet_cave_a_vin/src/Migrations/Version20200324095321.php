<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324095321 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE couleurs (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vins (id INT AUTO_INCREMENT NOT NULL, couleurs_id INT NOT NULL, name VARCHAR(255) NOT NULL, productor VARCHAR(255) NOT NULL, milesime INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, appelation VARCHAR(255) DEFAULT NULL, INDEX IDX_1A64B65C5ED47289 (couleurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vins ADD CONSTRAINT FK_1A64B65C5ED47289 FOREIGN KEY (couleurs_id) REFERENCES couleurs (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vins DROP FOREIGN KEY FK_1A64B65C5ED47289');
        $this->addSql('DROP TABLE couleurs');
        $this->addSql('DROP TABLE vins');
    }
}
