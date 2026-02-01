<h1 class="text-2xl font-bold mb-6">Products</h1>

<div class="mb-4">
    <?php echo CHtml::link(
        'Create Product',
        ['create'],
        ['class' => 'bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700']
    ); ?>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full border divide-y">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-3 py-2 text-left">ID</th>
                <th class="px-3 py-2 text-left">Name</th>
                <th class="px-3 py-2 text-left">Price</th>
                <th class="px-3 py-2 text-left">Stock</th>
                <th class="px-3 py-2 text-left">Status</th>
                <th class="px-3 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php foreach ($dataProvider->getData() as $product): ?>
                <tr>
                    <td class="px-3 py-2"><?php echo $product->id; ?></td>
                    <td class="px-3 py-2"><?php echo CHtml::encode($product->name); ?></td>
                    <td class="px-3 py-2"><?php echo number_format($product->price, 2); ?></td>
                    <td class="px-3 py-2"><?php echo $product->stock; ?></td>
                    <td class="px-3 py-2"><?php echo ucfirst($product->status); ?></td>
                    <td class="px-3 py-2 space-x-2">
                        <?php echo CHtml::link('View', ['view', 'id' => $product->id], [
                            'class' => 'text-indigo-600 hover:underline'
                        ]); ?>
                        <?php echo CHtml::link('Edit', ['update', 'id' => $product->id], [
                            'class' => 'text-indigo-600 hover:underline'
                        ]); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
