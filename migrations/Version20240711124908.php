<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240711124908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, zipcode VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, begin_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', end_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_links (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_9B12158A9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE social_links ADD CONSTRAINT FK_9B12158A9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE emploi ADD link VARCHAR(255) NOT NULL, CHANGE teleworking teleworking VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD link VARCHAR(255) NOT NULL, CHANGE teleworking teleworking VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_links DROP FOREIGN KEY FK_9B12158A9D86650F');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE social_links');
        $this->addSql('ALTER TABLE emploi DROP link, CHANGE teleworking teleworking TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE formation DROP link, CHANGE teleworking teleworking TINYINT(1) DEFAULT NULL');
    }
}
