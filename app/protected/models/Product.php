<?php

class Product extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'products';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            // Required fields
            array('name, price, stock, status', 'required'),

            // Length validations
            array('name', 'length', 'max' => 255),

            // Numeric validations
            array('price', 'numerical', 'min' => 0),
            array('stock', 'numerical', 'integerOnly' => true, 'min' => 0),

            // Status validation
            array(
                'status',
                'in',
                'range' => array_keys($this->getStatusOptions())
            ),

            // Safe fields
            array('description', 'safe'),

            // Search scenario
            array(
                'id, name, price, stock, status, created_at',
                'safe',
                'on' => 'search'
            ),
        );
    }

    /**
     * Status options
     */
    public function getStatusOptions()
    {
        return array(
            'draft' => 'Draft',
            'active' => 'Active',
            'inactive' => 'Inactive',
        );
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'stock' => 'Stock',
            'status' => 'Status',
            'created_at' => 'Created At',
        );
    }

    /**
     * Automatically set created_at
     */
    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }

        return parent::beforeSave();
    }
}
