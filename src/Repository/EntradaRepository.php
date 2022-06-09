<?php

namespace App\Repository;

use App\Entity\Entrada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Entrada>
 *
 * @method Entrada|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entrada|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entrada[]    findAll()
 * @method Entrada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntradaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entrada::class);
    }

    public function add(Entrada $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Entrada $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getQueryAll()
    {
        $qb = $this->createQueryBuilder('e');
        return $qb->getQuery();
    }

    public function getQueryByFilter($filter)
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.estado = 1');
        if (isset($filter['categoria'])) {
            $qb->andWhere('e.categoria = :categoria');
            $qb->setParameter('categoria', $filter['categoria']);
        }
        if (isset($filter['usuario'])) {
            $qb->join('e.usuario', 'u');
            $qb->andWhere('u.email = :email');
            $qb->setParameter('email', $filter['usuario']);
        }
        if (isset($filter['espacio'])) {
            $qb->join('e.categoria', 'c');
            $qb->andWhere('c.espacio = :espacio');
            $qb->setParameter('espacio', $filter['espacio']);
        }
        if (isset($filter['fechadesde'])) {
            $qb->andWhere('e.fecha >= :fechaini');
            $qb->setParameter('fechaini', $filter['fechadesde'] . '00:00:00');
        }
        if (isset($filter['fechahasta'])) {
            $qb->andWhere('e.fecha <= :fechafin');
            $qb->setParameter('fechafin', $filter['fechahasta'] . '23:59:59');
        }




        return $qb->getQuery();
    }

    //    /**
    //     * @return Entrada[] Returns an array of Entrada objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Entrada
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
