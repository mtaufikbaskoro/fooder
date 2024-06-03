<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Dashboard extends ActiveRecord 
{

    public static function getTotal ($table)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT * FROM $table");
        $result = $command->queryAll();
        return count($result);
    }

}

?>