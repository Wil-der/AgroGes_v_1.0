<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250508231258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE estructura_organizativa (id INT AUTO_INCREMENT NOT NULL, osde_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, INDEX IDX_DA3A37D5946E5683 (osde_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE guia_telefonica (id INT AUTO_INCREMENT NOT NULL, osde_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, INDEX IDX_2B3E6F54946E5683 (osde_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE estructura_organizativa ADD CONSTRAINT FK_DA3A37D5946E5683 FOREIGN KEY (osde_id) REFERENCES osde (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE guia_telefonica ADD CONSTRAINT FK_2B3E6F54946E5683 FOREIGN KEY (osde_id) REFERENCES osde (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE osde DROP phone, DROP email
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE estructura_organizativa DROP FOREIGN KEY FK_DA3A37D5946E5683
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE guia_telefonica DROP FOREIGN KEY FK_2B3E6F54946E5683
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE estructura_organizativa
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE guia_telefonica
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE osde ADD phone VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL
        SQL);
    }
}
