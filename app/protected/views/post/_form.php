<?php $form = $this->beginWidget('CActiveForm', array(
    'htmlOptions' => array('class' => 'space-y-6'),
)); ?>

<div>
    <?php echo $form->labelEx($model, 'title', array(
        'class' => 'block text-sm font-medium text-gray-700',
    )); ?>
    <?php echo $form->textField($model, 'title', array(
        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
    )); ?>
    <?php echo $form->error($model, 'title', array(
        'class' => 'text-sm text-red-600 mt-1',
    )); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'content', array(
        'class' => 'block text-sm font-medium text-gray-700',
    )); ?>
    <?php echo $form->textArea($model, 'content', array(
        'rows' => 5,
        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
    )); ?>
    <?php echo $form->error($model, 'content', array(
        'class' => 'text-sm text-red-600 mt-1',
    )); ?>
</div>

<div class="flex justify-end">
    <?php echo CHtml::submitButton(
        $model->isNewRecord ? 'Crear Post' : 'Guardar Cambios',
        array(
            'class' => 'inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700',
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>
