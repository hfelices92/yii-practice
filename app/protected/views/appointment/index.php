<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Appointments
        </h1>

        <?php echo CHtml::link(
            'Crear Appointment',
            array('create'),
            array(
                'class' => 'px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm',
            )
        ); ?>
    </div>

    <div class="bg-white p-4 rounded-lg shadow">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider,
            'itemsCssClass' => 'min-w-full divide-y divide-gray-200',
            'htmlOptions' => array('class' => 'overflow-x-auto'),
            'columns' => array(
                array(
                    'name' => 'id',
                    'htmlOptions' => array('class' => 'px-4 py-2 text-sm text-gray-700'),
                ),
                array(
                    'name' => 'patient_name',
                    'htmlOptions' => array('class' => 'px-4 py-2 text-sm text-gray-700'),
                ),
                array(
                    'name' => 'email',
                    'htmlOptions' => array('class' => 'px-4 py-2 text-sm text-gray-700'),
                ),
                array(
                    'name' => 'appointment_date',
                    'htmlOptions' => array('class' => 'px-4 py-2 text-sm text-gray-700'),
                ),
                array(
                    'name' => 'created_at',
                    'htmlOptions' => array('class' => 'px-4 py-2 text-sm text-gray-500'),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'htmlOptions' => array('class' => 'px-4 py-2 text-sm'),
                ),
            ),
        )); ?>
    </div>
</div>
