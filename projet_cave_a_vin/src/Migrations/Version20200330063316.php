<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200330063316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emplacement ADD vin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emplacement ADD CONSTRAINT FK_C0CF65F6BA62C651 FOREIGN KEY (vin_id) REFERENCES vins (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0CF65F6BA62C651 ON emplacement (vin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE emplacement DROP FOREIGN KEY FK_C0CF65F6BA62C651');
        $this->addSql('DROP INDEX UNIQ_C0CF65F6BA62C651 ON emplacement');
        $this->addSql('ALTER TABLE emplacement DROP vin_id');
    }
}
