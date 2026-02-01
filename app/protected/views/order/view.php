<h1 class="text-2xl font-bold mb-6">
    Order #<?php echo $model->id; ?>
</h1>

<div class="mb-6 flex gap-3">
    <?php echo CHtml::link(
        'Edit Order',
        ['update', 'id' => $model->id],
        ['class' => 'bg-indigo-600 text-white px-4 py-2 rounded']
    ); ?>

    <?php echo CHtml::link(
        'Back',
        ['index'],
        ['class' => 'px-4 py-2 border rounded']
    ); ?>
</div>

<div class="bg-white border rounded p-6 max-w-2xl mb-8">
    <dl class="grid grid-cols-2 gap-4">
        <dt class="font-medium">Customer</dt>
        <dd><?php echo CHtml::encode($model->customer_name); ?></dd>

        <dt class="font-medium">Status</dt>
        <dd><?php echo ucfirst($model->status); ?></dd>

        <dt class="font-medium">Created At</dt>
        <dd><?php echo $model->created_at; ?></dd>
    </dl>
</div>

<h2 class="text-xl font-semibold mb-4">Items</h2>

<div class="overflow-x-auto bg-white border rounded">
    <table class="min-w-full divide-y">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Product</th>
                <th class="px-4 py-2 text-left">Unit Price</th>
                <th class="px-4 py-2 text-left">Qty</th>
                <th class="px-4 py-2 text-left">Subtotal</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php foreach ($model->items as $item): ?>
                <tr>
                    <td class="px-4 py-2">
                        <?php echo CHtml::encode($item->product->name); ?>
                    </td>
                    <td class="px-4 py-2">
                        <?php echo number_format($item->unit_price, 2); ?>
                    </td>
                    <td class="px-4 py-2"><?php echo $item->quantity; ?></td>
                    <td class="px-4 py-2 font-medium">
                        <?php echo number_format($item->unit_price * $item->quantity, 2); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="mt-6 text-right text-xl font-bold">
    Total: <?php echo number_format($model->getTotal(), 2); ?>
</div>
