<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704114120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('emploi')) {
            // this up() migration is auto-generated, please modify it to your needs
            $this->addSql('CREATE TABLE emploi (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, entreprise VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, skills VARCHAR(255) DEFAULT NULL, field VARCHAR(255) DEFAULT NULL, publication_date DATETIME DEFAULT NULL, limit_offer DATETIME DEFAULT NULL, teleworking TINYINT(1) DEFAULT NULL, contract VARCHAR(255) DEFAULT NULL, INDEX IDX_74A0B0FA9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
            $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FA9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
            $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
            $this->addSql('ALTER TABLE user DROP link');
        }
    }

    public function down(Schema $schema): void
    {
        if (!$schema->hasTable('emploi')) {
            // this down() migration is auto-generated, please modify it to your needs
            $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FA9D86650F');
            $this->addSql('DROP TABLE emploi');
            $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF9D86650F');
            $this->addSql('ALTER TABLE user ADD link VARCHAR(255) DEFAULT NULL');
        }
    }
}
