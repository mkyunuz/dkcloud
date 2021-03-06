<?php
namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\base\Model;


class FileDir extends Model
{
    public $SET_YEAR = '2017'; 
    public $titik_id;
    protected $DEFAULT_PATH = 'D:'.DIRECTORY_SEPARATOR.'DKCLOUDDIR'.DIRECTORY_SEPARATOR; 


    public function set_year(){
        return $this->SET_YEAR.DIRECTORY_SEPARATOR;
    }

    public function default_path(){
         return $this->DEFAULT_PATH.$this->set_year();
    }




    public function validatePassword($attribute, $params)
    {
        
    }

    public function set_prefix_day($hari){
        $array = ['Senin'=>'1.','Selasa'=>'2.','Rabu'=>'3.','Kamis'=>'4.','Jumat'=>'5.','Sabtu'=>'6.','Minggu'=>'7.'];

        return $array[$hari];
    }

    public function generateUserDir($data){
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('select hor.hor_name, area.area_name, titik.titik_name from titik 
                                                JOIN area ON titik.area_id=area.area_id
                                                JOIN hor ON hor.hor_id=area.hor_id 
                                                WHERE titik_id=:titik_id',['titik_id'=>$data['titik_id']]);
        $rsCommand = $command->queryOne();

        $user =  $connection->createCommand('select nik,nama from user where nik=:nik',['nik'=>$data['nik']]);
        $rsUser = $user->queryOne();

        $kalender =  $connection->createCommand('select minggu,hari from master_kalender');
        $rsKalender = $kalender->queryAll();

        foreach ($rsKalender as $key) {
            $upload_type = ['Daily Activity', 'Event', 'Report'];
            $prefix_hari = $this->set_prefix_day($key['hari']);
            foreach ($upload_type as $utkey) {
                $tmpPath = $this->default_path().$rsCommand['hor_name'].DIRECTORY_SEPARATOR.$rsCommand['area_name'].DIRECTORY_SEPARATOR.$rsCommand['titik_name'].DIRECTORY_SEPARATOR.$rsUser['nik']." ".$rsUser['nama'].DIRECTORY_SEPARATOR."Week ".$key['minggu'].DIRECTORY_SEPARATOR.$prefix_hari.$key['hari'].DIRECTORY_SEPARATOR.$utkey;
                 if (!file_exists( $tmpPath)) {
                    if(FileHelper::createDirectory($tmpPath, 0775, true)){
                         $updateAssignment = $connection->createCommand('update titik_assignment set dir_created=:dir_created',['dir_created'=> 1 ]);
                         $updateAssignment->execute();
                    }
                }
            }
             
        }
       

    return true;

    }
}
