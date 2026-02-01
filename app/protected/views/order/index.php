<h1 class="text-2xl font-bold mb-6">Orders</h1>

<div class="mb-4">
    <?php echo CHtml::link(
        'Create Order',
        ['create'],
        ['class' => 'bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700']
    ); ?>
</div>

<div class="overflow-x-auto bg-white border rounded">
    <table class="min-w-full divide-y">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Customer</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Created At</th>
                <th class="px-4 py-2 text-left">Total</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php foreach ($dataProvider->getData() as $order): ?>
                <tr>
                    <td class="px-4 py-2"><?php echo $order->id; ?></td>
                    <td class="px-4 py-2"><?php echo CHtml::encode($order->customer_name); ?></td>
                    <td class="px-4 py-2"><?php echo ucfirst($order->status); ?></td>
                    <td class="px-4 py-2"><?php echo $order->created_at; ?></td>
                    <td class="px-4 py-2 font-medium">
                        <?php echo number_format($order->getTotal(), 2); ?>
                    </td>
                    <td class="px-4 py-2 space-x-2">
                        <?php echo CHtml::link(
                            'View',
                            ['view', 'id' => $order->id],
                            ['class' => 'text-indigo-600 hover:underline']
                        ); ?>
                        <?php echo CHtml::link(
                            'Edit',
                            ['update', 'id' => $order->id],
                            ['class' => 'text-indigo-600 hover:underline']
                        ); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
