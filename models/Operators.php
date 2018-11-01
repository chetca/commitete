<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operators".
 *
 * @property int $id
 * @property string $operator
 */
class Operators extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operators';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operator'], 'required'],
            [['operator'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'operator' => 'Operator',
        ];
    }
}
