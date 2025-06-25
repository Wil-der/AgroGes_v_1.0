<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250618122057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE equipo_riego ADD total_a INT DEFAULT NULL, ADD total_i INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE maquina_ingeniera ADD total_a INT DEFAULT NULL, ADD total_i INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE mortalidad ADD total_a INT DEFAULT NULL, ADD total_i INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE nacimientos ADD total_hoy INT DEFAULT NULL, ADD total_acumulado INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produccion_huevos ADD total INT DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE maquina_ingeniera DROP total_a, DROP total_i
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE mortalidad DROP total_a, DROP total_i
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produccion_huevos DROP total
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE nacimientos DROP total_hoy, DROP total_acumulado
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipo_riego DROP total_a, DROP total_i
        SQL);
    }
}
