<?php

class Appointment extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Appointment the static model class
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
        return 'appointments';
    }

    /**
     * @return array validation rules for model attributes.
     */

    public function rules()
    {
        return array(
            // Campos obligatorios
            array('patient_name, email, appointment_date, status', 'required'),

            // Longitud de strings
            array('patient_name, email', 'length', 'max' => 255),
            array('status', 'length', 'max' => 20),

            // Validación de email
            array('email', 'email'),

            // Campos seguros
            array('notes', 'safe'),
            // Validacion de fecha futura
            array('appointment_date', 'appointmentDateValidator'),
            //Validación de estatus
            array('status', 'in', 'range' => array_keys($this->getStatusOptions())),
            // Para búsquedas
            array('id, patient_name, email, appointment_date, status', 'safe', 'on' => 'search'),
        );
    }



    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'patient_name' => 'Patient Name',
            'email' => 'Email',
            'appointment_date' => 'Appointment Date',
            'status' => 'Status',
            'notes' => 'Notes',
            'created_at' => 'Created At',
        );
    }

    protected function beforeSave()
    {
        if (!empty($this->appointment_date)) {
            $this->appointment_date = date(
                'Y-m-d H:i:s',
                strtotime($this->appointment_date)
            );
        }
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave();
    }



    protected function beforeDelete()
    {
        if ($this->status === 'confirmed') {
            $this->addError(
                'status',
                'Confirmed appointments cannot be deleted.'
            );
            return false;
        }

        return parent::beforeDelete();
    }

    public function getStatusOptions()
    {
        return array(
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'cancelled' => 'Cancelled',
        );
    }

    public function appointmentDateValidator($attribute, $params)
    {
        if (empty($this->$attribute)) {
            return;
        }

        $appointmentDate = strtotime($this->$attribute);
        $today = strtotime(date('Y-m-d'));

        if ($appointmentDate < $today) {
            $this->addError(
                $attribute,
                'The appointment date must be today or in the future.'
            );
        }
    }
}
