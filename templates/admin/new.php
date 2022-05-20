<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Administration - Portfolio</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	</head>
	<body>
        <!-- Navigation -->
	    <?php require_once __DIR__. '/../layouts/admin/nav.php'; ?>s

		<!-- Formulaire d'ajout d'un nouveau projet -->
		<div class="w-50 mx-auto pt-5">
            <h1 class="fs-3 mb-4">Nouveau projet</h1>

            <!-- Message flash -->
			<?php if(isset($message)): ?>
                <div class="alert alert-<?php echo $success; ?>" role="alert">
					<?php echo $message; ?>
                </div>
			<?php endif; ?>

            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre du projet</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="preview" class="form-label">Aperçu du projet</label>
                    <input class="form-control" type="file" id="preview" name="preview">
                </div>
                <button class="btn btn-success mt-4">Enregistrer le projet</button>
            </form>
		</div>
	</body>
</html>
