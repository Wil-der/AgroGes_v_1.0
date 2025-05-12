<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250430114314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE especialidad ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE especialidad ADD CONSTRAINT FK_ACB064F9A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_ACB064F9A76ED395 ON especialidad (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE especialidad DROP FOREIGN KEY FK_ACB064F9A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_ACB064F9A76ED395 ON especialidad
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE especialidad DROP user_id
        SQL);
    }
}
