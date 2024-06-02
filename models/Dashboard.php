<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Dashboard extends ActiveRecord 
{
    
    public static function getProductTotal () 
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT * FROM tb_item");
        $result = $command->queryAll();
        return count($result);
    }

    public static function getBranchTotal () 
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT * FROM tb_branch");
        $result = $command->queryAll();
        return count($result);
    }

}

?>