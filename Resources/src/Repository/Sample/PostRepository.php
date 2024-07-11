<?php

namespace App\Repository\Sample;;

use App\Entity\Sample\Post;
use ChapterThree\C3Bundle\Repository\C3TableRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * TODO: table.twig.html 用カスタマイズ for グループ検索
 *      class 定義:
 *          追加: use C3TableRepository;
 *      __construct():
 *          追加: $this->setPropertyNameOfGroupCount('Category');
 *          追加: $this->setPropertyNameOfSearch(['Title', 'Content']);
 *
 */
class PostRepository extends ServiceEntityRepository
{
    // table.twig.html 用 trait利用宣言
    use C3TableRepository;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
        // table.twig.html 用 集計グループ指定(プロパティ名)
        $this->setPropertyNameOfGroupCount('Category');
        $this->setPropertyNameOfSearch(['Title', 'Content']);
    }

    // /**
    // * カスタマイズ for GroupLabel ON
    // *
    // * table twigテンプレートを実装する場合
    // * getGroupCount() 実装するとグループ検索欄がカスタマイズされる
    // *
    // * fields: name, count
    // */
    /*
    public function countByGroup()
    {
        $sql = "SELECT id as name, count(*) as count from post group by id";
        return $this->getEntityManager()->getConnection()->query($sql)->fetchAll();
    }
    */


    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
