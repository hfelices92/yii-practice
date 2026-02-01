<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<nav class="mb-8">
	<div class="bg-gray-800 py-4 px-12 flex justify-between items-center ">
		<div class="">
			<a href="/" class="text-white text-lg font-semibold">Mi Aplicación Yii</a>
		</div>
		<div>
			<a href="/post" class="text-white text-lg font-semibold">Post</a>
			<a href="/appointment" class="ml-6 text-white text-lg font-semibold">Appointments</a>
			<a href="/product" class="ml-6 text-white text-lg font-semibold">Products</a>
			<a href="/order" class="ml-6 text-white text-lg font-semibold">Orders</a>
		</div>
	</div>

	</nav>
	<div class="mx-auto flex flex-col px-6 md:px-0 max-w-7xl">

		<?php echo $content; ?>
	</div>

</body>
</html>
