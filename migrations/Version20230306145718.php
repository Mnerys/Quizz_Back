<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306145718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question ADD theme_id INT DEFAULT NULL, ADD level_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E59027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E5FB14BA7 FOREIGN KEY (level_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E59027487 ON question (theme_id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E5FB14BA7 ON question (level_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E59027487');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E5FB14BA7');
        $this->addSql('DROP INDEX IDX_B6F7494E59027487 ON question');
        $this->addSql('DROP INDEX IDX_B6F7494E5FB14BA7 ON question');
        $this->addSql('ALTER TABLE question DROP theme_id, DROP level_id');
    }
}
