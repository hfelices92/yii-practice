<?php

class OrderItem extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'order_items';
    }

    public function rules()
    {
        return array(
            array('order_id, product_id, quantity, unit_price', 'required'),
            array('order_id, product_id, quantity', 'numerical', 'integerOnly' => true),
            array('quantity', 'numerical', 'min' => 1),
            array('unit_price', 'numerical', 'min' => 0),
            array('id, order_id, product_id, quantity, unit_price', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'order_id' => 'Order',
            'product_id' => 'Product',
            'quantity' => 'Quantity',
            'unit_price' => 'Unit Price',
        );
    }
}
