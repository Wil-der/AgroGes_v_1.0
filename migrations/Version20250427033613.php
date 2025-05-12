<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250427033613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE campana1 (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, nombre_entidad VARCHAR(255) NOT NULL, roturadas_plan INT DEFAULT NULL, roturadas_real INT DEFAULT NULL, sembradas_plan INT DEFAULT NULL, sembradas_real INT DEFAULT NULL, roturadas_papa_arroz_plan INT DEFAULT NULL, roturadas_papa_arroz_real INT DEFAULT NULL, sembradas_papa_arroz_plan INT DEFAULT NULL, sembradas_papa_arroz_real INT DEFAULT NULL, otras_producciones INT DEFAULT NULL, otras_producciones_real INT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE campana2 (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, recolectadas_plan INT DEFAULT NULL, nombre_entidad VARCHAR(255) NOT NULL, recolectadas_real INT DEFAULT NULL, sembradas_plan INT DEFAULT NULL, sembradas_real INT DEFAULT NULL, roturadas_papa_arroz_plan INT DEFAULT NULL, roturadas_papa_arroz_real INT DEFAULT NULL, sembradas_papa_arroz_plan INT DEFAULT NULL, sembradas_papa_arroz_real INT DEFAULT NULL, otras_producciones_plan INT DEFAULT NULL, otras_producciones_real INT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE centro (id INT AUTO_INCREMENT NOT NULL, centro_huevos_id INT DEFAULT NULL, centro_peces_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2675036BFD427B9 (centro_huevos_id), UNIQUE INDEX UNIQ_2675036B3E18FF7F (centro_peces_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE centro_huevos (id INT AUTO_INCREMENT NOT NULL, entidad_id INT DEFAULT NULL, plan INT DEFAULT NULL, existencia_diaria INT DEFAULT NULL, existencia_acumulada INT DEFAULT NULL, existencia_almacen INT DEFAULT NULL, INDEX IDX_51C715796CA204EF (entidad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE centro_peces (id INT AUTO_INCREMENT NOT NULL, entidad_peces_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, plan INT DEFAULT NULL, existancia_diaria_real INT DEFAULT NULL, existenciaacumulada_real INT DEFAULT NULL, INDEX IDX_6795D9D7FF44FAD3 (entidad_peces_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE combustible (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, nombre_entidad VARCHAR(255) NOT NULL, diesel_existencia INT DEFAULT NULL, diesel_cobertura INT DEFAULT NULL, gasolina_a83_existencia INT DEFAULT NULL, gasolina_a83_cobertura INT DEFAULT NULL, gasolina_a90_existencia INT DEFAULT NULL, gasolina_a90_cobertura INT DEFAULT NULL, lubricante_grasa_existencia INT DEFAULT NULL, lubricante_grasa_cobertura INT DEFAULT NULL, lubricante_aceite_existencia INT DEFAULT NULL, lubricante_aceite_cobertura INT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE contenedores (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, puerto VARCHAR(255) NOT NULL, cantidad INT DEFAULT NULL, cantidad_extraida INT DEFAULT NULL, tipo_mercancia VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE empresa (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE entidad (id INT AUTO_INCREMENT NOT NULL, produccion_huevos_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', INDEX IDX_4587B0CBBEFF11C2 (produccion_huevos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE entidad_peces (id INT AUTO_INCREMENT NOT NULL, peces_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_4F1011A82FC4BB22 (peces_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE equipo_riego (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, nombre_entidad VARCHAR(255) NOT NULL, enrrollador_a INT DEFAULT NULL, enrrollador_i INT DEFAULT NULL, molino_viento_a INT DEFAULT NULL, molino_viento_i INT DEFAULT NULL, riego_electrico_a INT DEFAULT NULL, riego_electrico_i INT DEFAULT NULL, equipo_abasto_a INT DEFAULT NULL, equipo_abasto_i INT DEFAULT NULL, total_a INT DEFAULT NULL, total_i INT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE especialidad (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, jefe VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE extraccion_combustible (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, tipo_combustible VARCHAR(255) DEFAULT NULL, lugar_extraccion VARCHAR(255) DEFAULT NULL, cantidad INT DEFAULT NULL, destino VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, fecha_subida DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE hechos_extraordinarios (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, nombre_entidad VARCHAR(255) NOT NULL, acumulados_años INT DEFAULT NULL, hsg_mayor_menor INT DEFAULT NULL, hg_mayor_menor INT DEFAULT NULL, hurto_robo_violencia INT DEFAULT NULL, hurto_robo_fuerza INT DEFAULT NULL, hurto_robo_otros INT DEFAULT NULL, arma INT DEFAULT NULL, municion INT DEFAULT NULL, accidente_trabajo INT DEFAULT NULL, accidente_transito INT DEFAULT NULL, muertos INT DEFAULT NULL, heridos INT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE maquina_ingeniera (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, nombre_entidad VARCHAR(255) NOT NULL, buldocer_a INT DEFAULT NULL, buldocer_i INT DEFAULT NULL, cargador_a INT DEFAULT NULL, cargador_i INT DEFAULT NULL, excavador_a INT DEFAULT NULL, excavador_i INT DEFAULT NULL, auto_grua_a INT DEFAULT NULL, auto_grua_i INT DEFAULT NULL, ge_a INT DEFAULT NULL, ge_i INT DEFAULT NULL, moto_niveladora_a INT DEFAULT NULL, moto_niveladora_i INT DEFAULT NULL, total_a INT DEFAULT NULL, total_i INT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE mortalidad (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, nombre_entidad VARCHAR(255) NOT NULL, conejo_hoy INT DEFAULT NULL, conejo_acumulado INT DEFAULT NULL, vacuno_hoy INT DEFAULT NULL, vacuno_acumulado INT DEFAULT NULL, ovinohoy INT DEFAULT NULL, ovino_acumulado INT DEFAULT NULL, porcino_hoy INT DEFAULT NULL, porcino_acumulado INT DEFAULT NULL, equino_hoy INT DEFAULT NULL, equino_acumulado INT DEFAULT NULL, totalhoy INT DEFAULT NULL, total_acumulado INT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE nacimientos (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, nombre_entidad VARCHAR(255) NOT NULL, vacuno_hoy INT DEFAULT NULL, vacuno_acumulado INT DEFAULT NULL, ovinohoy INT DEFAULT NULL, ovino_acumulado INT DEFAULT NULL, porcino_hoy INT DEFAULT NULL, porcino_acumulado INT DEFAULT NULL, equino_hoy INT DEFAULT NULL, equino_acumulado INT DEFAULT NULL, totalhoy INT DEFAULT NULL, total_acumulado INT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE osde (id INT AUTO_INCREMENT NOT NULL, mision LONGTEXT NOT NULL, vision LONGTEXT NOT NULL, address LONGTEXT NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE parte_diario (id INT AUTO_INCREMENT NOT NULL, contenedores_id INT DEFAULT NULL, campana1_id INT DEFAULT NULL, campana2_id INT DEFAULT NULL, combustible_id INT DEFAULT NULL, equipo_riego_id INT DEFAULT NULL, extraccion_combustible_id INT DEFAULT NULL, hechos_extraordinarios_id INT DEFAULT NULL, maquina_ingeniera_id INT DEFAULT NULL, mortalidad_id INT DEFAULT NULL, nacimientos_id INT DEFAULT NULL, peces_id INT DEFAULT NULL, pienso_id INT DEFAULT NULL, produccion_huevos_id INT DEFAULT NULL, transportacion_id INT DEFAULT NULL, parte_general_id INT DEFAULT NULL, empresa_id INT DEFAULT NULL, fecha DATE NOT NULL, UNIQUE INDEX UNIQ_663A2691AB34647F (contenedores_id), UNIQUE INDEX UNIQ_663A2691F7122D98 (campana1_id), UNIQUE INDEX UNIQ_663A2691E5A78276 (campana2_id), UNIQUE INDEX UNIQ_663A2691D5BD96DF (combustible_id), UNIQUE INDEX UNIQ_663A2691C93AE103 (equipo_riego_id), UNIQUE INDEX UNIQ_663A2691D31E0BA9 (extraccion_combustible_id), UNIQUE INDEX UNIQ_663A269118F722CB (hechos_extraordinarios_id), UNIQUE INDEX UNIQ_663A269160F90F23 (maquina_ingeniera_id), UNIQUE INDEX UNIQ_663A26918D8087E9 (mortalidad_id), UNIQUE INDEX UNIQ_663A2691CDCD2BB3 (nacimientos_id), UNIQUE INDEX UNIQ_663A26912FC4BB22 (peces_id), UNIQUE INDEX UNIQ_663A2691764900EB (pienso_id), UNIQUE INDEX UNIQ_663A2691BEFF11C2 (produccion_huevos_id), UNIQUE INDEX UNIQ_663A269155C22AA4 (transportacion_id), INDEX IDX_663A2691D18B99C0 (parte_general_id), INDEX IDX_663A2691521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE parte_general (id INT AUTO_INCREMENT NOT NULL, osde_id INT DEFAULT NULL, fecha DATETIME NOT NULL, INDEX IDX_962C1804946E5683 (osde_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE peces (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE pienso (id INT AUTO_INCREMENT NOT NULL, nombre_entidad VARCHAR(255) NOT NULL, observaciones LONGTEXT DEFAULT NULL, avicola_plan INT DEFAULT NULL, avicola_real INT DEFAULT NULL, avicola_covertura INT DEFAULT NULL, porcino_plan INT DEFAULT NULL, porcino_real INT DEFAULT NULL, porcino_covertura INT DEFAULT NULL, pienso_liquido_plan INT DEFAULT NULL, pienso_liquido_acumulado_dia INT DEFAULT NULL, pienso_liquido_real INT DEFAULT NULL, extraccion_materia_prima_dia INT DEFAULT NULL, extraccion_materia_prima_acumulada INT DEFAULT NULL, total JSON DEFAULT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE produccion_huevos (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE transportacion (id INT AUTO_INCREMENT NOT NULL, observaciones LONGTEXT DEFAULT NULL, tipo_transporte VARCHAR(255) DEFAULT NULL, destino_carga VARCHAR(255) DEFAULT NULL, cantidad INT DEFAULT NULL, tipo_mercancia VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro ADD CONSTRAINT FK_2675036BFD427B9 FOREIGN KEY (centro_huevos_id) REFERENCES centro_huevos (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro ADD CONSTRAINT FK_2675036B3E18FF7F FOREIGN KEY (centro_peces_id) REFERENCES centro_peces (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro_huevos ADD CONSTRAINT FK_51C715796CA204EF FOREIGN KEY (entidad_id) REFERENCES entidad (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro_peces ADD CONSTRAINT FK_6795D9D7FF44FAD3 FOREIGN KEY (entidad_peces_id) REFERENCES entidad_peces (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE entidad ADD CONSTRAINT FK_4587B0CBBEFF11C2 FOREIGN KEY (produccion_huevos_id) REFERENCES produccion_huevos (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE entidad_peces ADD CONSTRAINT FK_4F1011A82FC4BB22 FOREIGN KEY (peces_id) REFERENCES peces (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691AB34647F FOREIGN KEY (contenedores_id) REFERENCES contenedores (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691F7122D98 FOREIGN KEY (campana1_id) REFERENCES campana1 (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691E5A78276 FOREIGN KEY (campana2_id) REFERENCES campana2 (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691D5BD96DF FOREIGN KEY (combustible_id) REFERENCES combustible (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691C93AE103 FOREIGN KEY (equipo_riego_id) REFERENCES equipo_riego (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691D31E0BA9 FOREIGN KEY (extraccion_combustible_id) REFERENCES extraccion_combustible (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A269118F722CB FOREIGN KEY (hechos_extraordinarios_id) REFERENCES hechos_extraordinarios (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A269160F90F23 FOREIGN KEY (maquina_ingeniera_id) REFERENCES maquina_ingeniera (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A26918D8087E9 FOREIGN KEY (mortalidad_id) REFERENCES mortalidad (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691CDCD2BB3 FOREIGN KEY (nacimientos_id) REFERENCES nacimientos (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A26912FC4BB22 FOREIGN KEY (peces_id) REFERENCES peces (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691764900EB FOREIGN KEY (pienso_id) REFERENCES pienso (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691BEFF11C2 FOREIGN KEY (produccion_huevos_id) REFERENCES produccion_huevos (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A269155C22AA4 FOREIGN KEY (transportacion_id) REFERENCES transportacion (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691D18B99C0 FOREIGN KEY (parte_general_id) REFERENCES parte_general (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario ADD CONSTRAINT FK_663A2691521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_general ADD CONSTRAINT FK_962C1804946E5683 FOREIGN KEY (osde_id) REFERENCES osde (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE centro DROP FOREIGN KEY FK_2675036BFD427B9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro DROP FOREIGN KEY FK_2675036B3E18FF7F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro_huevos DROP FOREIGN KEY FK_51C715796CA204EF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE centro_peces DROP FOREIGN KEY FK_6795D9D7FF44FAD3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE entidad DROP FOREIGN KEY FK_4587B0CBBEFF11C2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE entidad_peces DROP FOREIGN KEY FK_4F1011A82FC4BB22
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691AB34647F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691F7122D98
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691E5A78276
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691D5BD96DF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691C93AE103
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691D31E0BA9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A269118F722CB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A269160F90F23
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A26918D8087E9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691CDCD2BB3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A26912FC4BB22
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691764900EB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691BEFF11C2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A269155C22AA4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691D18B99C0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_diario DROP FOREIGN KEY FK_663A2691521E1991
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE parte_general DROP FOREIGN KEY FK_962C1804946E5683
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE campana1
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE campana2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE centro
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE centro_huevos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE centro_peces
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE combustible
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE contenedores
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE empresa
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE entidad
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE entidad_peces
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE equipo_riego
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE especialidad
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE extraccion_combustible
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE file
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE hechos_extraordinarios
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE maquina_ingeniera
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE mortalidad
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE nacimientos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE osde
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE parte_diario
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE parte_general
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE peces
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pienso
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE produccion_huevos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE transportacion
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
