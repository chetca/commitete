<?php
/**
 * Created by PhpStorm.
 * User: Александер
 * Date: 17.09.2018
 * Time: 20:46
 */

namespace app\models;
use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }

}