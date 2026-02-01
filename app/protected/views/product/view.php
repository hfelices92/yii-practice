<h1 class="text-2xl font-bold mb-6">
    Product #<?php echo $model->id; ?>
</h1>

<div class="mb-4 flex gap-3">
    <?php echo CHtml::link(
        'Edit',
        ['update', 'id' => $model->id],
        ['class' => 'bg-indigo-600 text-white px-4 py-2 rounded']
    ); ?>

    <?php echo CHtml::link(
        'Back',
        ['index'],
        ['class' => 'px-4 py-2 border rounded']
    ); ?>
</div>

<div class="bg-white border rounded p-6 max-w-xl">
    <dl class="grid grid-cols-2 gap-4">
        <dt class="font-medium">Name</dt>
        <dd><?php echo CHtml::encode($model->name); ?></dd>

        <dt class="font-medium">Description</dt>
        <dd><?php echo nl2br(CHtml::encode($model->description)); ?></dd>

        <dt class="font-medium">Price</dt>
        <dd><?php echo number_format($model->price, 2); ?></dd>

        <dt class="font-medium">Stock</dt>
        <dd><?php echo $model->stock; ?></dd>

        <dt class="font-medium">Status</dt>
        <dd><?php echo ucfirst($model->status); ?></dd>

        <dt class="font-medium">Created At</dt>
        <dd><?php echo $model->created_at; ?></dd>
    </dl>
</div>
