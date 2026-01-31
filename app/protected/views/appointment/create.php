<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">
        Crear Cita
    </h1>

    <div class="bg-white p-6 rounded-lg shadow">
        <?php echo $this->renderPartial('_form', array(
            'model' => $model,
        )); ?>
    </div>
</div>
