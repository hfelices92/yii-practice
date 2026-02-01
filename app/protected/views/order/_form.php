<?php $form = $this->beginWidget('CActiveForm', [
    'htmlOptions' => ['class' => 'space-y-6 max-w-xl'],
]); ?>

<?php echo $form->errorSummary($model, null, null, [
    'class' => 'bg-red-100 text-red-700 p-4 rounded',
]); ?>

<div>
    <?php echo $form->labelEx($model, 'customer_name', [
        'class' => 'block font-medium text-gray-700',
    ]); ?>
    <?php echo $form->textField($model, 'customer_name', [
        'class' => 'mt-1 w-full border rounded px-3 py-2',
    ]); ?>
</div>

<div>
    <?php echo $form->labelEx($model, 'status', [
        'class' => 'block font-medium text-gray-700',
    ]); ?>
    <?php echo $form->dropDownList(
        $model,
        'status',
        [
            'pending' => 'Pending',
            'paid' => 'Paid',
            'cancelled' => 'Cancelled',
        ],
        ['class' => 'mt-1 w-full border rounded px-3 py-2']
    ); ?>
</div>

<div class="flex gap-3">
    <?php echo CHtml::submitButton(
        $model->isNewRecord ? 'Create Order' : 'Save Changes',
        ['class' => 'bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700']
    ); ?>

    <?php echo CHtml::link(
        'Cancel',
        ['index'],
        ['class' => 'px-4 py-2 border rounded']
    ); ?>
</div>

<?php $this->endWidget(); ?>
