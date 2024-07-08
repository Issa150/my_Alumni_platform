<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240626143039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE user ADD firstname VARCHAR(50) DEFAULT NULL, ADD lastname VARCHAR(50) DEFAULT NULL, ADD phone_number VARCHAR(10) DEFAULT NULL, ADD bio LONGTEXT DEFAULT NULL, ADD cv VARCHAR(255) DEFAULT NULL, ADD date_of_birth DATE DEFAULT NULL, ADD study_field VARCHAR(255) DEFAULT NULL, ADD gender VARCHAR(255) DEFAULT NULL, ADD certificate_year_obtention DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', ADD link VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname, DROP phone_number, DROP bio, DROP cv, DROP date_of_birth, DROP study_field, DROP gender, DROP certificate_year_obtention, DROP link, CHANGE email email VARCHAR(180) NOT NULL');
    }
}
