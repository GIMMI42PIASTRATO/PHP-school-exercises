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
					<h1>Aumenta provvigione</h1>
					<p>
						Aumenta la provvigione ai rappresentati che hanno
						venduto più di 1000€ (incluso) nella regione specificata
					</p>
				</div>
				<div class="formBody">
					<label for="fatturatoMin">Regione</label>
					<input
						type="text"
						id="regione"
						name="regione"
						placeholder="Piemonte"
					/>
				</div>

				<div class="formFooter">
					<button type="submit">Cerca</button>
				</div>
			</form>
		</div>
	</body>
</html>
