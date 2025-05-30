<?php
namespace App\Repository;

use App\Entity\AsociacionSeccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AsociacionSeccionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AsociacionSeccion::class);
    }

    /**
     * Devuelve asociaciones activas (con empresa o centro) agrupadas por sección (string)
     * 
     * @return AsociacionSeccion[]
     */
    public function findAsociacionesActivas(): array
    {
        // Asumo que tienes un campo activo, sino quita esta condición
        return $this->createQueryBuilder('a')
            ->andWhere('a.empresa IS NOT NULL OR a.centro IS NOT NULL')
            //->andWhere('a.activo = :activo') // descomenta si tienes este campo
            //->setParameter('activo', true)
            ->orderBy('a.seccion', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
