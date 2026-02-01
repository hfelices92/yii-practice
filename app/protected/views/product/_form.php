<?php $form = $this->beginWidget('CActiveForm', [
    'htmlOptions' => ['class' => 'space-y-6 max-w-xl'],
]); ?>

<?php echo $form->errorSummary($model, null, null, [
    'class' => 'bg-red-100 text-red-700 p-4 rounded',
]); ?>

<div>
    <?php echo $form->labelEx($model, 'name', ['class' => 'block font-medium']); ?>
    <?php echo $form->textField($model, 'name', [
        'class' => 'mt-1 w-full border rounded px-3 py-2',
    ]); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'description', ['class' => 'block font-medium']); ?>
    <?php echo $form->textArea($model, 'description', [
        'rows' => 4,
        'class' => 'mt-1 w-full border rounded px-3 py-2',
    ]); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'price', ['class' => 'block font-medium']); ?>
    <?php echo $form->textField($model, 'price', [
        'class' => 'mt-1 w-full border rounded px-3 py-2',
    ]); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'stock', ['class' => 'block font-medium']); ?>
    <?php echo $form->textField($model, 'stock', [
        'class' => 'mt-1 w-full border rounded px-3 py-2',
    ]); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'status', ['class' => 'block font-medium']); ?>
    <?php echo $form->dropDownList(
        $model,
        'status',
        $model->getStatusOptions(),
        ['class' => 'mt-1 w-full border rounded px-3 py-2']
    ); ?>
</div>

<div class="flex gap-3">
    <?php echo CHtml::submitButton(
        $model->isNewRecord ? 'Create Product' : 'Save Changes',
        ['class' => 'bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700']
    ); ?>

    <?php echo CHtml::link(
        'Cancel',
        ['index'],
        ['class' => 'px-4 py-2 border rounded']
    ); ?>
</div>

<?php $this->endWidget(); ?>
