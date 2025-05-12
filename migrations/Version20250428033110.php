<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250428033110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE centro ADD empresa_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro ADD CONSTRAINT FK_2675036B521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2675036B521E1991 ON centro (empresa_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE centro DROP FOREIGN KEY FK_2675036B521E1991
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_2675036B521E1991 ON centro
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro DROP empresa_id
        SQL);
    }
}
