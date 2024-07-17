<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717085457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emploi CHANGE city city VARCHAR(255) NOT NULL, CHANGE skills skills JSON NOT NULL COMMENT \'(DC2Type:json)\', CHANGE field field VARCHAR(255) NOT NULL, CHANGE publication_date publication_date DATE NOT NULL, CHANGE contract contract JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE formation ADD required_level VARCHAR(255) NOT NULL, CHANGE begin_at begin_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', CHANGE degree degree VARCHAR(255) NOT NULL, CHANGE funding funding JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE user DROP certificate_year_obtention');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emploi CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE skills skills VARCHAR(255) DEFAULT NULL, CHANGE field field VARCHAR(255) DEFAULT NULL, CHANGE publication_date publication_date DATE DEFAULT NULL, CHANGE contract contract VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE formation DROP required_level, CHANGE begin_at begin_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', CHANGE degree degree VARCHAR(255) DEFAULT NULL, CHANGE funding funding VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD certificate_year_obtention DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }
}
