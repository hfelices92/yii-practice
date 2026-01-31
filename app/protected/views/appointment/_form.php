<?php $form = $this->beginWidget('CActiveForm', array(
    'htmlOptions' => array('class' => 'space-y-6'),
)); ?>
<!-- patient_name -->
<div>
    <?php echo $form->labelEx($model, 'patient_name', array(
        'class' => 'block text-sm font-medium text-gray-700',
    )); ?>
    <?php echo $form->textField($model, 'patient_name', array(
        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
    )); ?>
    <?php echo $form->error($model, 'patient_name', array(
        'class' => 'text-sm text-red-600 mt-1',
    )); ?>
</div>
<!-- email -->
<div>
    <?php echo $form->labelEx($model, 'email', array(
        'class' => 'block text-sm font-medium text-gray-700',
    )); ?>
    <?php echo $form->textField($model, 'email', array(
        'type' => 'email',
        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
    )); ?>
    <?php echo $form->error($model, 'email', array(
        'class' => 'text-sm text-red-600 mt-1',
    )); ?>
</div>
<!-- appointment_date -->
<div>
    <?php echo $form->labelEx($model, 'appointment_date'); ?>

    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $model,
        'attribute' => 'appointment_date',
        'options' => array(
            'dateFormat' => 'yy-mm-dd',
            'changeMonth' => true,
            'changeYear' => true,
        ),
        'htmlOptions' => array(
            'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm',
        ),
    ));
    ?>

    <?php echo $form->error($model, 'appointment_date'); ?>
</div>

<!-- status -->
<div>
    <?php echo $form->labelEx($model, 'status', array(
        'class' => 'block text-sm font-medium text-gray-700',
    )); ?>
    <?php echo $form->dropDownList(
        $model,
        'status',
        $model->getStatusOptions(),
        array(
            'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
        )
    ); ?>
    <?php echo $form->error($model, 'status', array(
        'class' => 'text-sm text-red-600 mt-1',
    )); ?>
</div>
<!-- notes -->


<div>
    <?php echo $form->labelEx($model, 'notes', array(
        'class' => 'block text-sm font-medium text-gray-700',
    )); ?>
    <?php echo $form->textArea($model, 'notes', array(
        'rows' => 5,
        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
    )); ?>
    <?php echo $form->error($model, 'notes', array(
        'class' => 'text-sm text-red-600 mt-1',
    )); ?>
</div>

<div class="flex justify-end">
    <?php echo CHtml::submitButton(
        $model->isNewRecord ? 'Crear Appointment' : 'Guardar Cambios',
        array(
            'class' => 'inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700',
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>
