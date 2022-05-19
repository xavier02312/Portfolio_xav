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
		<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
			<div class="container">
				<a class="navbar-brand" href="/">Portfolio</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/projects">Les projets</a>
                        </li>
						<li class="nav-item">
							<a class="nav-link" href="/project/add">Ajouter un projet</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Formulaire d'ajout d'un nouveau projet -->
		<div class="w-50 mx-auto pt-5">
			<h1 class="fs-3 mb-4">Les projets</h1>

            <!-- Message flash -->
			<?php if(isset($_GET['message'])): ?>
                <div class="alert alert-<?php echo $_GET['success']; ?>" role="alert">
					<?php echo $_GET['message']; ?>
                </div>
			<?php endif; ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Aperçu</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($projects as $project): ?>
                        <tr>
                            <th scope="row"><?php echo $project->getId(); ?></th>
                            <td><img src="preview-projects/<?php echo $project->getPreview(); ?>" alt="<?php echo $project->getTitle(); ?>" class="rounded w-25"></td>
                            <td><?php echo $project->getTitle(); ?></td>
                            <td>
                                <a href="/project/edit?id=<?php echo $project->getId(); ?>" title="Supprimer ce projet" class="btn btn-outline-secondary">
                                    Editer ce projet
                                </a>
                                <a href="/project/delete?id=<?php echo $project->getId(); ?>" title="Supprimer ce projet" class="btn btn-outline-danger">
                                    Supprimer ce projet
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
		</div>
	</body>
</html>
