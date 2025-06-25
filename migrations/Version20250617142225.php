<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250617142225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE campana1 DROP total, CHANGE roturadas_plan roturadas_plan INT NOT NULL, CHANGE roturadas_real roturadas_real INT NOT NULL, CHANGE sembradas_plan sembradas_plan INT NOT NULL, CHANGE sembradas_real sembradas_real INT NOT NULL, CHANGE roturadas_papa_arroz_plan roturadas_papa_arroz_plan INT NOT NULL, CHANGE roturadas_papa_arroz_real roturadas_papa_arroz_real INT NOT NULL, CHANGE sembradas_papa_arroz_plan sembradas_papa_arroz_plan INT NOT NULL, CHANGE sembradas_papa_arroz_real sembradas_papa_arroz_real INT NOT NULL, CHANGE otras_producciones otras_producciones INT NOT NULL, CHANGE otras_producciones_real otras_producciones_real INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE campana2 DROP total, CHANGE recolectadas_plan recolectadas_plan INT NOT NULL, CHANGE recolectadas_real recolectadas_real INT NOT NULL, CHANGE sembradas_plan sembradas_plan INT NOT NULL, CHANGE sembradas_real sembradas_real INT NOT NULL, CHANGE roturadas_papa_arroz_plan roturadas_papa_arroz_plan INT NOT NULL, CHANGE roturadas_papa_arroz_real roturadas_papa_arroz_real INT NOT NULL, CHANGE sembradas_papa_arroz_plan sembradas_papa_arroz_plan INT NOT NULL, CHANGE sembradas_papa_arroz_real sembradas_papa_arroz_real INT NOT NULL, CHANGE otras_producciones_plan otras_producciones_plan INT NOT NULL, CHANGE otras_producciones_real otras_producciones_real INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE combustible DROP total, CHANGE diesel_existencia diesel_existencia INT NOT NULL, CHANGE diesel_cobertura diesel_cobertura INT NOT NULL, CHANGE gasolina_a83_existencia gasolina_a83_existencia INT NOT NULL, CHANGE gasolina_a83_cobertura gasolina_a83_cobertura INT NOT NULL, CHANGE gasolina_a90_existencia gasolina_a90_existencia INT NOT NULL, CHANGE gasolina_a90_cobertura gasolina_a90_cobertura INT NOT NULL, CHANGE lubricante_grasa_existencia lubricante_grasa_existencia INT NOT NULL, CHANGE lubricante_grasa_cobertura lubricante_grasa_cobertura INT NOT NULL, CHANGE lubricante_aceite_existencia lubricante_aceite_existencia INT NOT NULL, CHANGE lubricante_aceite_cobertura lubricante_aceite_cobertura INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contenedores CHANGE cantidad cantidad INT NOT NULL, CHANGE cantidad_extraida cantidad_extraida INT NOT NULL, CHANGE tipo_mercancia tipo_mercancia VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipo_riego DROP total_a, DROP total_i, DROP total, CHANGE enrrollador_a enrrollador_a INT NOT NULL, CHANGE enrrollador_i enrrollador_i INT NOT NULL, CHANGE molino_viento_a molino_viento_a INT NOT NULL, CHANGE molino_viento_i molino_viento_i INT NOT NULL, CHANGE riego_electrico_a riego_electrico_a INT NOT NULL, CHANGE riego_electrico_i riego_electrico_i INT NOT NULL, CHANGE equipo_abasto_a equipo_abasto_a INT NOT NULL, CHANGE equipo_abasto_i equipo_abasto_i INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hechos_extraordinarios DROP total, CHANGE acumulados_anos acumulados_anos INT NOT NULL, CHANGE hsg_mayor_menor hsg_mayor_menor INT NOT NULL, CHANGE hg_mayor_menor hg_mayor_menor INT NOT NULL, CHANGE hurto_robo_violencia hurto_robo_violencia INT NOT NULL, CHANGE hurto_robo_fuerza hurto_robo_fuerza INT NOT NULL, CHANGE hurto_robo_otros hurto_robo_otros INT NOT NULL, CHANGE arma arma INT NOT NULL, CHANGE municion municion INT NOT NULL, CHANGE accidente_trabajo accidente_trabajo INT NOT NULL, CHANGE accidente_transito accidente_transito INT NOT NULL, CHANGE muertos muertos INT NOT NULL, CHANGE heridos heridos INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE maquina_ingeniera DROP total_a, DROP total_i, DROP total, CHANGE buldocer_a buldocer_a INT NOT NULL, CHANGE buldocer_i buldocer_i INT NOT NULL, CHANGE cargador_a cargador_a INT NOT NULL, CHANGE cargador_i cargador_i INT NOT NULL, CHANGE excavador_a excavador_a INT NOT NULL, CHANGE excavador_i excavador_i INT NOT NULL, CHANGE auto_grua_a auto_grua_a INT NOT NULL, CHANGE auto_grua_i auto_grua_i INT NOT NULL, CHANGE ge_a ge_a INT NOT NULL, CHANGE ge_i ge_i INT NOT NULL, CHANGE moto_niveladora_a moto_niveladora_a INT NOT NULL, CHANGE moto_niveladora_i moto_niveladora_i INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE mortalidad DROP total, CHANGE conejo_hoy conejo_hoy INT NOT NULL, CHANGE conejo_acumulado conejo_acumulado INT NOT NULL, CHANGE vacuno_hoy vacuno_hoy INT NOT NULL, CHANGE vacuno_acumulado vacuno_acumulado INT NOT NULL, CHANGE ovinohoy ovinohoy INT NOT NULL, CHANGE ovino_acumulado ovino_acumulado INT NOT NULL, CHANGE porcino_hoy porcino_hoy INT NOT NULL, CHANGE porcino_acumulado porcino_acumulado INT NOT NULL, CHANGE equino_hoy equino_hoy INT NOT NULL, CHANGE equino_acumulado equino_acumulado INT NOT NULL, CHANGE totalhoy totalhoy INT NOT NULL, CHANGE total_acumulado total_acumulado INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE nacimientos DROP total, CHANGE vacuno_hoy vacuno_hoy INT NOT NULL, CHANGE vacuno_acumulado vacuno_acumulado INT NOT NULL, CHANGE ovinohoy ovinohoy INT NOT NULL, CHANGE ovino_acumulado ovino_acumulado INT NOT NULL, CHANGE porcino_hoy porcino_hoy INT NOT NULL, CHANGE porcino_acumulado porcino_acumulado INT NOT NULL, CHANGE equino_hoy equino_hoy INT NOT NULL, CHANGE equino_acumulado equino_acumulado INT NOT NULL, CHANGE totalhoy totalhoy INT NOT NULL, CHANGE total_acumulado total_acumulado INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE peces DROP total, CHANGE plan plan INT NOT NULL, CHANGE existancia_diaria_real existancia_diaria_real INT NOT NULL, CHANGE existenciaacumulada_real existenciaacumulada_real INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pienso DROP total, CHANGE avicola_plan avicola_plan INT NOT NULL, CHANGE avicola_real avicola_real INT NOT NULL, CHANGE avicola_covertura avicola_covertura INT NOT NULL, CHANGE porcino_plan porcino_plan INT NOT NULL, CHANGE porcino_real porcino_real INT NOT NULL, CHANGE porcino_covertura porcino_covertura INT NOT NULL, CHANGE pienso_liquido_plan pienso_liquido_plan INT NOT NULL, CHANGE pienso_liquido_acumulado_dia pienso_liquido_acumulado_dia INT NOT NULL, CHANGE pienso_liquido_real pienso_liquido_real INT NOT NULL, CHANGE extraccion_materia_prima_dia extraccion_materia_prima_dia INT NOT NULL, CHANGE extraccion_materia_prima_acumulada extraccion_materia_prima_acumulada INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produccion_huevos CHANGE plan plan INT NOT NULL, CHANGE existencia_diaria existencia_diaria INT NOT NULL, CHANGE existencia_acumulada existencia_acumulada INT NOT NULL, CHANGE existencia_almacen existencia_almacen INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transportacion CHANGE tipo_transporte tipo_transporte VARCHAR(255) NOT NULL, CHANGE destino_carga destino_carga VARCHAR(255) NOT NULL, CHANGE cantidad cantidad INT NOT NULL, CHANGE tipo_mercancia tipo_mercancia VARCHAR(255) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE campana1 ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE roturadas_plan roturadas_plan INT DEFAULT NULL, CHANGE roturadas_real roturadas_real INT DEFAULT NULL, CHANGE sembradas_plan sembradas_plan INT DEFAULT NULL, CHANGE sembradas_real sembradas_real INT DEFAULT NULL, CHANGE roturadas_papa_arroz_plan roturadas_papa_arroz_plan INT DEFAULT NULL, CHANGE roturadas_papa_arroz_real roturadas_papa_arroz_real INT DEFAULT NULL, CHANGE sembradas_papa_arroz_plan sembradas_papa_arroz_plan INT DEFAULT NULL, CHANGE sembradas_papa_arroz_real sembradas_papa_arroz_real INT DEFAULT NULL, CHANGE otras_producciones otras_producciones INT DEFAULT NULL, CHANGE otras_producciones_real otras_producciones_real INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE hechos_extraordinarios ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE acumulados_anos acumulados_anos INT DEFAULT NULL, CHANGE hsg_mayor_menor hsg_mayor_menor INT DEFAULT NULL, CHANGE hg_mayor_menor hg_mayor_menor INT DEFAULT NULL, CHANGE hurto_robo_violencia hurto_robo_violencia INT DEFAULT NULL, CHANGE hurto_robo_fuerza hurto_robo_fuerza INT DEFAULT NULL, CHANGE hurto_robo_otros hurto_robo_otros INT DEFAULT NULL, CHANGE arma arma INT DEFAULT NULL, CHANGE municion municion INT DEFAULT NULL, CHANGE accidente_trabajo accidente_trabajo INT DEFAULT NULL, CHANGE accidente_transito accidente_transito INT DEFAULT NULL, CHANGE muertos muertos INT DEFAULT NULL, CHANGE heridos heridos INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE maquina_ingeniera ADD total_a INT DEFAULT NULL, ADD total_i INT DEFAULT NULL, ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE buldocer_a buldocer_a INT DEFAULT NULL, CHANGE buldocer_i buldocer_i INT DEFAULT NULL, CHANGE cargador_a cargador_a INT DEFAULT NULL, CHANGE cargador_i cargador_i INT DEFAULT NULL, CHANGE excavador_a excavador_a INT DEFAULT NULL, CHANGE excavador_i excavador_i INT DEFAULT NULL, CHANGE auto_grua_a auto_grua_a INT DEFAULT NULL, CHANGE auto_grua_i auto_grua_i INT DEFAULT NULL, CHANGE ge_a ge_a INT DEFAULT NULL, CHANGE ge_i ge_i INT DEFAULT NULL, CHANGE moto_niveladora_a moto_niveladora_a INT DEFAULT NULL, CHANGE moto_niveladora_i moto_niveladora_i INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE peces ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE plan plan INT DEFAULT NULL, CHANGE existancia_diaria_real existancia_diaria_real INT DEFAULT NULL, CHANGE existenciaacumulada_real existenciaacumulada_real INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contenedores CHANGE cantidad cantidad INT DEFAULT NULL, CHANGE cantidad_extraida cantidad_extraida INT DEFAULT NULL, CHANGE tipo_mercancia tipo_mercancia VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE transportacion CHANGE tipo_transporte tipo_transporte VARCHAR(255) DEFAULT NULL, CHANGE destino_carga destino_carga VARCHAR(255) DEFAULT NULL, CHANGE cantidad cantidad INT DEFAULT NULL, CHANGE tipo_mercancia tipo_mercancia VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE combustible ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE diesel_existencia diesel_existencia INT DEFAULT NULL, CHANGE diesel_cobertura diesel_cobertura INT DEFAULT NULL, CHANGE gasolina_a83_existencia gasolina_a83_existencia INT DEFAULT NULL, CHANGE gasolina_a83_cobertura gasolina_a83_cobertura INT DEFAULT NULL, CHANGE gasolina_a90_existencia gasolina_a90_existencia INT DEFAULT NULL, CHANGE gasolina_a90_cobertura gasolina_a90_cobertura INT DEFAULT NULL, CHANGE lubricante_grasa_existencia lubricante_grasa_existencia INT DEFAULT NULL, CHANGE lubricante_grasa_cobertura lubricante_grasa_cobertura INT DEFAULT NULL, CHANGE lubricante_aceite_existencia lubricante_aceite_existencia INT DEFAULT NULL, CHANGE lubricante_aceite_cobertura lubricante_aceite_cobertura INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE mortalidad ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE conejo_hoy conejo_hoy INT DEFAULT NULL, CHANGE conejo_acumulado conejo_acumulado INT DEFAULT NULL, CHANGE vacuno_hoy vacuno_hoy INT DEFAULT NULL, CHANGE vacuno_acumulado vacuno_acumulado INT DEFAULT NULL, CHANGE ovinohoy ovinohoy INT DEFAULT NULL, CHANGE ovino_acumulado ovino_acumulado INT DEFAULT NULL, CHANGE porcino_hoy porcino_hoy INT DEFAULT NULL, CHANGE porcino_acumulado porcino_acumulado INT DEFAULT NULL, CHANGE equino_hoy equino_hoy INT DEFAULT NULL, CHANGE equino_acumulado equino_acumulado INT DEFAULT NULL, CHANGE totalhoy totalhoy INT DEFAULT NULL, CHANGE total_acumulado total_acumulado INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pienso ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE avicola_plan avicola_plan INT DEFAULT NULL, CHANGE avicola_real avicola_real INT DEFAULT NULL, CHANGE avicola_covertura avicola_covertura INT DEFAULT NULL, CHANGE porcino_plan porcino_plan INT DEFAULT NULL, CHANGE porcino_real porcino_real INT DEFAULT NULL, CHANGE porcino_covertura porcino_covertura INT DEFAULT NULL, CHANGE pienso_liquido_plan pienso_liquido_plan INT DEFAULT NULL, CHANGE pienso_liquido_acumulado_dia pienso_liquido_acumulado_dia INT DEFAULT NULL, CHANGE pienso_liquido_real pienso_liquido_real INT DEFAULT NULL, CHANGE extraccion_materia_prima_dia extraccion_materia_prima_dia INT DEFAULT NULL, CHANGE extraccion_materia_prima_acumulada extraccion_materia_prima_acumulada INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE produccion_huevos CHANGE plan plan INT DEFAULT NULL, CHANGE existencia_diaria existencia_diaria INT DEFAULT NULL, CHANGE existencia_acumulada existencia_acumulada INT DEFAULT NULL, CHANGE existencia_almacen existencia_almacen INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE nacimientos ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE vacuno_hoy vacuno_hoy INT DEFAULT NULL, CHANGE vacuno_acumulado vacuno_acumulado INT DEFAULT NULL, CHANGE ovinohoy ovinohoy INT DEFAULT NULL, CHANGE ovino_acumulado ovino_acumulado INT DEFAULT NULL, CHANGE porcino_hoy porcino_hoy INT DEFAULT NULL, CHANGE porcino_acumulado porcino_acumulado INT DEFAULT NULL, CHANGE equino_hoy equino_hoy INT DEFAULT NULL, CHANGE equino_acumulado equino_acumulado INT DEFAULT NULL, CHANGE totalhoy totalhoy INT DEFAULT NULL, CHANGE total_acumulado total_acumulado INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE campana2 ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE recolectadas_plan recolectadas_plan INT DEFAULT NULL, CHANGE recolectadas_real recolectadas_real INT DEFAULT NULL, CHANGE sembradas_plan sembradas_plan INT DEFAULT NULL, CHANGE sembradas_real sembradas_real INT DEFAULT NULL, CHANGE roturadas_papa_arroz_plan roturadas_papa_arroz_plan INT DEFAULT NULL, CHANGE roturadas_papa_arroz_real roturadas_papa_arroz_real INT DEFAULT NULL, CHANGE sembradas_papa_arroz_plan sembradas_papa_arroz_plan INT DEFAULT NULL, CHANGE sembradas_papa_arroz_real sembradas_papa_arroz_real INT DEFAULT NULL, CHANGE otras_producciones_plan otras_producciones_plan INT DEFAULT NULL, CHANGE otras_producciones_real otras_producciones_real INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE equipo_riego ADD total_a INT DEFAULT NULL, ADD total_i INT DEFAULT NULL, ADD total JSON DEFAULT NULL COMMENT '(DC2Type:json)', CHANGE enrrollador_a enrrollador_a INT DEFAULT NULL, CHANGE enrrollador_i enrrollador_i INT DEFAULT NULL, CHANGE molino_viento_a molino_viento_a INT DEFAULT NULL, CHANGE molino_viento_i molino_viento_i INT DEFAULT NULL, CHANGE riego_electrico_a riego_electrico_a INT DEFAULT NULL, CHANGE riego_electrico_i riego_electrico_i INT DEFAULT NULL, CHANGE equipo_abasto_a equipo_abasto_a INT DEFAULT NULL, CHANGE equipo_abasto_i equipo_abasto_i INT DEFAULT NULL
        SQL);
    }
}
