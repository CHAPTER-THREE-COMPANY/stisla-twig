<?php

namespace ChapterThree\C3Bundle\Repository;

use Symfony\Component\HttpFoundation\Request;

trait C3TableRepository{

    private $group_field;
    private $search_fields;

    function setPropertyNameOfGroupCount(string $PropertyName)
    {
        $this->group_field = $PropertyName;
    }

    function setPropertyNameOfSearch(array $PropertyNames)
    {
        $this->search_fields = $PropertyNames;
    }

    function countByGroup()
    {
        $field = $this->group_field;
        $table = $this->getEntityManager()->getClassMetadata($this->getClassName())->getTableName();

        $sql = "SELECT {$field} as name,count(*) as count
                FROM {$table}
                GROUP BY {$field}";
        $stmt = $this   ->getEntityManager()
                        ->getConnection()
                        ->query($sql);
        $result = $stmt->fetchAll();

        return $result;
    }

    function findByRequest(Request $request)
    {
        $fields = $this->search_fields;

        if (!empty($request->get('s'))) {
            $p = $this->createQueryBuilder('p');
            foreach ($fields as $field){
                $p = $p->orWhere("p.{$field} LIKE :val");
            }

            return $p
                ->setParameter('val', '%'.$request->get('s').'%')
                ->getQuery()
                ->getResult();



            return $this->createQueryBuilder('p')
                ->orWhere("p.{$field} LIKE :val")
                ->orWhere("p.Content LIKE :val")
                ->setParameter('val', '%'.$request->get('s').'%')
                ->getQuery()
                ->getResult();
        } elseif (!empty($request->get('g'))) {
            return $this->findBy([
                $this->group_field => $request->get('g')
            ]);
        }else{
            return $this->findAll();
        }
    }
}