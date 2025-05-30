<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250519160624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE asociacion_seccion (id INT AUTO_INCREMENT NOT NULL, empresa_id INT DEFAULT NULL, centro_id INT DEFAULT NULL, seccion VARCHAR(100) NOT NULL, INDEX IDX_7C65AACD521E1991 (empresa_id), INDEX IDX_7C65AACD298137A7 (centro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE asociacion_seccion ADD CONSTRAINT FK_7C65AACD521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE asociacion_seccion ADD CONSTRAINT FK_7C65AACD298137A7 FOREIGN KEY (centro_id) REFERENCES ueb (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE asociacion_seccion DROP FOREIGN KEY FK_7C65AACD521E1991
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE asociacion_seccion DROP FOREIGN KEY FK_7C65AACD298137A7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE asociacion_seccion
        SQL);
    }
}
