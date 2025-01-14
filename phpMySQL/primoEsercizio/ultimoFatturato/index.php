<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Document</title>
		<link rel="stylesheet" href="../style/style.css" />
	</head>
	<body class="fullScreenBody">
		<div class="formContainer">
			<form action="./result.php" method="post">
				<div class="formHeader">
					<h1>Ultimo fatturato</h1>
					<p>Cerca l'ultimo fatturato degli altri commercianti</p>
				</div>
				<div class="formBody">
					<label for="fatturatoMin">Fatturato minimo</label>
					<input
						type="number"
						id="fatturatoMin"
						name="fatturatoMin"
						placeholder="0"
						required
					/>
					<label for="fatturatoMax">Fatturato massimo</label>
					<input
						type="number"
						id="fatturatoMax"
						name="fatturatoMax"
						placeholder="1000"
						required
					/>
				</div>

				<div class="formFooter">
					<button type="submit">Cerca</button>
				</div>
			</form>
		</div>
	</body>
</html>
