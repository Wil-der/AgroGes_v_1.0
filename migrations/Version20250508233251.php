<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250508233251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE centro_ueb (id INT AUTO_INCREMENT NOT NULL, u_eb_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, cant_trabaj_directo INT NOT NULL, cant_trabaj_indirecto INT NOT NULL, total_trabaj INT NOT NULL, INDEX IDX_350233D087194147 (u_eb_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE guia_telefonica_empresa (id INT AUTO_INCREMENT NOT NULL, empresa_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, INDEX IDX_E86C02D5521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE plantilla_trabaj_empresa (id INT AUTO_INCREMENT NOT NULL, empresa_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, mimetype VARCHAR(255) NOT NULL, INDEX IDX_4E930F91521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ueb (id INT AUTO_INCREMENT NOT NULL, empresa_id INT DEFAULT NULL, mision LONGTEXT NOT NULL, cant_trabajdirecto INT NOT NULL, cant_trabaj_indirecto INT NOT NULL, total_trabaj INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_164DEC3F521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro_ueb ADD CONSTRAINT FK_350233D087194147 FOREIGN KEY (u_eb_id) REFERENCES ueb (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE guia_telefonica_empresa ADD CONSTRAINT FK_E86C02D5521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plantilla_trabaj_empresa ADD CONSTRAINT FK_4E930F91521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ueb ADD CONSTRAINT FK_164DEC3F521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE empresa ADD cant_trabaj_directo INT NOT NULL, ADD cant_trabaj_indirecto INT NOT NULL, ADD total_trabaj INT NOT NULL, ADD mision LONGTEXT NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE centro_ueb DROP FOREIGN KEY FK_350233D087194147
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE guia_telefonica_empresa DROP FOREIGN KEY FK_E86C02D5521E1991
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plantilla_trabaj_empresa DROP FOREIGN KEY FK_4E930F91521E1991
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ueb DROP FOREIGN KEY FK_164DEC3F521E1991
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE centro_ueb
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE guia_telefonica_empresa
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE plantilla_trabaj_empresa
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ueb
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE empresa DROP cant_trabaj_directo, DROP cant_trabaj_indirecto, DROP total_trabaj, DROP mision
        SQL);
    }
}
