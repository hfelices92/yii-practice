<div class="max-w-3xl mx-auto space-y-6">
     <div>
        <button>
            <a href="/post"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Volver a la lista de Posts
            </a>
        </button>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">
            <?php echo CHtml::encode($model->title); ?>
        </h1>

        <div class="prose max-w-none text-gray-700">
            <?php echo nl2br(CHtml::encode($model->content)); ?>
        </div>

        <p class="text-sm text-gray-500 mt-4">
            Creado el <?php echo CHtml::encode($model->created_at); ?>
        </p>
    </div>

    <div class="flex space-x-3">
        <?php echo CHtml::link(
            'Editar',
            array('update', 'id' => $model->id),
            array(
                'class' => 'px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 text-sm',
            )
        ); ?>

        <?php echo CHtml::link(
            'Eliminar',
            array('delete', 'id' => $model->id),
            array(
                'submit' => array('delete', 'id' => $model->id),
                'confirm' => '¿Seguro que quieres eliminar este post?',
                'class' => 'px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm',
            )
        ); ?>
    </div>

   
</div>
