<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200330064910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vins ADD rack_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vins ADD CONSTRAINT FK_1A64B65C8E86A33E FOREIGN KEY (rack_id) REFERENCES rack (id)');
        $this->addSql('CREATE INDEX IDX_1A64B65C8E86A33E ON vins (rack_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vins DROP FOREIGN KEY FK_1A64B65C8E86A33E');
        $this->addSql('DROP INDEX IDX_1A64B65C8E86A33E ON vins');
        $this->addSql('ALTER TABLE vins DROP rack_id');
    }
}
