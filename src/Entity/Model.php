<?php

namespace Jacques\ProjetPhpGestionProjets\Entity;

use Jacques\ProjetPhpGestionProjets\Kernel\DataBase;


class Model  {

    public static $tableName;

    /*
    private static function getEntityName()
    {
        $classname = static::class;
        $tab = explode('\\', $classname);
        $entity = $tab[count($tab) - 1];
        return $entity;
    }*/

    private static function getClassName()
    {
        // utiliser une constante ?
        $toReturn = str_replace('DB', '', static::class);
        $toReturn = str_replace('Utils', 'Entity', $toReturn);
        //echo 'toReturn : ' . $toReturn;
        return $toReturn;
    }


    public static function Execute($sql)
    {
        
        //$pdostatement = DataBase::getInstance()->query($sql);
        //return $pdostatement->fetchAll(\PDO::FETCH_CLASS, self::getClassName());
        return DataBase::execute($sql, self::getClassName());
    }


    public static function getAll()
    {
        $tableName = static::$tableName;
        $sql = "SELECT * FROM " . $tableName;
        return self::Execute($sql);
    }



    public static function getById(int $id)
    {
        $idName = 'id_' . static::$tableName;
        $sql = "SELECT * FROM " . static::$tableName . " where $idName=$id";
        $result =  self::Execute($sql);
        //Comme fetchAll [0] on récupère le premier élément sinon c'est $result
        return $result[0];
    }

    /*
    public static function insert(array $datas)
    {
        $sql = "insert into " . self::getEntityName() . " values (NULL,";
        $count = count($datas);
        $i = 1;
        foreach ($datas as $data) {
            if ($i < $count) {
                $sql .= "'$data',";
            } else {
                $sql .= "'$data'";
            }
            $i++;
        }
        $sql .= ")";
        return DataBase::getInstance()->exec($sql);
    }



    public static function delete(int $id)
    {
        $sql = "delete from " . self::getEntityName() . " where id=$id";
        return DataBase::getInstance()->exec($sql);
    }



    public static function update(int $id, array $datas)
    {
        $sql = "update " . self::getEntityName() . " set ";
        $count = count($datas);
        $i = 1;
        foreach ($datas as $key => $value) {
            if ($i < $count) {
                $sql .= "$key='$value',";
            } else {
                $sql .= "$key='$value'";
            }
            $i++;
        }
        $sql .= " where id=$id";
        return DataBase::getInstance()->exec($sql);
    }
*/

}