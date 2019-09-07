<?php

namespace App\Repository;

use App\Entity\Urun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Urun|null find($id, $lockMode = null, $lockVersion = null)
 * @method Urun|null findOneBy(array $criteria, array $orderBy = null)
 * @method Urun[]    findAll()
 * @method Urun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrunRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Urun::class);
    }

    public function UrunSirala(int $min_fiyat,int $max_fiyat,string $isim)
    {
        $qb=$this->createQueryBuilder('u')
            ->andWhere('u.isim like  :isim')
            ->setParameter('isim','%'.$isim.'%')
            ->andWhere('u.fiyat>:min_fiyat')
            ->setParameter('min_fiyat',$min_fiyat)
            ->andWhere('u.fiyat<:max_fiyat')
            ->setParameter('max_fiyat',$max_fiyat)
            ->orderBy('u.fiyat')
            ->getQuery();

        return $qb->execute();

    }
    public function UrunleriGetir()
    {
            $qb2=$this->createQueryBuilder('ug')
            ->orderBy('ug.id');
    }
    public function UrunGetir()
    {
        $qb3=$this->createQueryBuilder('u')
            ->orderBy('u.fiyat');
    }

    // /**
    //  * @return Urun[] Returns an array of Urun objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Urun
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
