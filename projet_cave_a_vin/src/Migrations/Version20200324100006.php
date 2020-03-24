<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324100006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vins ADD cepage VARCHAR(255) DEFAULT NULL, ADD region VARCHAR(255) DEFAULT NULL, DROP price, CHANGE couleurs_id couleurs_id INT DEFAULT NULL, CHANGE productor productor VARCHAR(255) DEFAULT NULL, CHANGE milesime milesime VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vins ADD price DOUBLE PRECISION DEFAULT NULL, DROP cepage, DROP region, CHANGE couleurs_id couleurs_id INT NOT NULL, CHANGE productor productor VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE milesime milesime INT DEFAULT NULL');
    }
}
