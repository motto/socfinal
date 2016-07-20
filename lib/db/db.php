<?php
namespace lib\db;
defined( '_MOTTO' ) or die( 'Restricted access' );
class DB
{
   static public function assoc_tomb($sql)
    {
        if(\CONF::$sql_log='full'){\GOB::$log['sql'][]=$sql;};
        $result = array();
        try {
            $stmt = \GOB::$db->prepare($sql);

            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch()) {
                $result[] = $row;
            }
        } catch (PDOException $e) {
            \GOB::$echoT['hiba']['pdo'][] = $e->getMessage();
        }
        return $result;
    }
   static public function assoc_sor($sql)
    {
        if(\CONF::$sql_log='full'){\GOB::$logT['sql'][]=$sql;}
        $result = array();
        try {
            $stmt = \GOB::$db->prepare($sql);

            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            if (!empty($row)) {
                $result = $row;
            }

        } catch (PDOException $e) {
            \GOB::$echoT['hiba']['pdo'][] = $e->getMessage();
        }
        return $result;
    }
   static public function egymezo($sql) 
   {
    if(\CONF::$sql_log='full'){\GOB::$log['sql'][]=$sql;}
        $result = '';
        try {
            $stmt = \GOB::$db->prepare($sql);

            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            if (!empty($row)) {
                $result = $row[0];
            }

        } catch (PDOException $e) {
            \GOB::$echoT['hiba']['pdo'][] = $e->getMessage();
        }
        return $result;
    }

}