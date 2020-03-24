<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324102506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cave CHANGE address adresse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vins ADD cave_id INT NOT NULL');
        $this->addSql('ALTER TABLE vins ADD CONSTRAINT FK_1A64B65C7F05B85 FOREIGN KEY (cave_id) REFERENCES cave (id)');
        $this->addSql('CREATE INDEX IDX_1A64B65C7F05B85 ON vins (cave_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cave CHANGE adresse address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vins DROP FOREIGN KEY FK_1A64B65C7F05B85');
        $this->addSql('DROP INDEX IDX_1A64B65C7F05B85 ON vins');
        $this->addSql('ALTER TABLE vins DROP cave_id');
    }
}
