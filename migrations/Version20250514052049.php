<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514052049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE estructura_organizativa_empresa (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE empresa ADD estructura_organizativa_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE empresa ADD CONSTRAINT FK_B8D75A50BB084BB7 FOREIGN KEY (estructura_organizativa_id) REFERENCES estructura_organizativa_empresa (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_B8D75A50BB084BB7 ON empresa (estructura_organizativa_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE empresa DROP FOREIGN KEY FK_B8D75A50BB084BB7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE estructura_organizativa_empresa
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_B8D75A50BB084BB7 ON empresa
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE empresa DROP estructura_organizativa_id
        SQL);
    }
}
