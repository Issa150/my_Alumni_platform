<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240723130537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emploi CHANGE logo logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE formation CHANGE logo logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE social_links DROP FOREIGN KEY FK_9B12158A9D86650F');
        $this->addSql('DROP INDEX IDX_9B12158A9D86650F ON social_links');
        $this->addSql('ALTER TABLE social_links CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE social_links ADD CONSTRAINT FK_9B12158AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9B12158AA76ED395 ON social_links (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emploi CHANGE logo logo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE formation CHANGE logo logo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE social_links DROP FOREIGN KEY FK_9B12158AA76ED395');
        $this->addSql('DROP INDEX IDX_9B12158AA76ED395 ON social_links');
        $this->addSql('ALTER TABLE social_links CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE social_links ADD CONSTRAINT FK_9B12158A9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9B12158A9D86650F ON social_links (user_id_id)');
    }
}
