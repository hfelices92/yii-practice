<?php

class Order extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'orders';
    }

    public function rules()
    {
        return array(
            array('customer_name, status', 'required'),
            array('customer_name', 'length', 'max' => 255),
            array(
                'status',
                'in',
                'range' => array('pending', 'paid', 'cancelled')
            ),
            array('id, customer_name, status, created_at', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'items' => array(self::HAS_MANY, 'OrderItem', 'order_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'customer_name' => 'Customer Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        );
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave();
    }

    /**
     * Calculate order total
     */
    public function getTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->quantity * $item->unit_price;
        }

        return $total;
    }
}
