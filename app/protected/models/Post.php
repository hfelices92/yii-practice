<?php

class Post extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'posts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('title, content', 'required'),
            array('title', 'length', 'max'=>255),
            array('id, title, content, created_at', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'title' => 'Título',
            'content' => 'Contenido',
            'created_at' => 'Fecha de creación',
        );
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave();
    }
    
}