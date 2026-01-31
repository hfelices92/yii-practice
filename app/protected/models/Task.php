<?php

class Task extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Task the static model class
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
        return 'tasks';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // id, title, description, due_date, status, created_at
        return array(
            // Campos obligatorios
            array('title, due_date, status', 'required'),

            // Longitud de strings
            array('title', 'length', 'max' => 255),
            array('status', 'length', 'max' => 20),

            // Campos seguros
            array('description', 'safe'),

            // Validacion de fecha futura
            array('due_date', 'dueDateValidator'),

            //Validación de estatus
            array('status', 'in', 'range' => array_keys($this->getStatusOptions())),

            // Para búsquedas
            array('id, title, description, due_date, status', 'safe', 'on' => 'search'),
        );
    }

    public function dueDateValidator($attribute, $params)
    {

        if (empty($this->$attribute)) {
            return;
        }

        $dueDate = strtotime($this->$attribute);
        $currentDate = strtotime(date('Y-m-d'));

        if ($dueDate < $currentDate) {
            $this->addError(
                $attribute,
                'The due date must be in the future.'
            );
        }
    }

    public function getStatusOptions()
    {
        return array(
            'pending' => 'Pending',
            'in_progress' => 'In Progress',
            'done' => 'Done',
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'title' => 'Title',
            'description' => 'Description',
            'due_date' => 'Due Date',
            'status' => 'Status',
            'created_at' => 'Created At',
        );
    }

    protected function beforeSave()
    {
        if (!empty($this->due_date)) {
            $this->due_date = date(
                'Y-m-d',
                strtotime($this->due_date)
            );
        }

        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }

        return parent::beforeSave();
    }
}
