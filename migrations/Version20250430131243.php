<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250430131243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE especialidad DROP jefe, DROP email
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file ADD especialidad_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file ADD CONSTRAINT FK_8C9F361016A490EC FOREIGN KEY (especialidad_id) REFERENCES especialidad (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8C9F361016A490EC ON file (especialidad_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE file DROP FOREIGN KEY FK_8C9F361016A490EC
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8C9F361016A490EC ON file
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file DROP especialidad_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE especialidad ADD jefe VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL
        SQL);
    }
}
