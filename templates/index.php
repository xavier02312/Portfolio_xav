<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portfolio</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">Portfolio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="/projects">Administration</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Projets -->
        <?php
            $i = 0;
            foreach($projects as $project):
        ?>

            <!-- Even -->
            <?php if(0 === $i % 2): ?>
                    <div class="row">
                        <div class="col-6 p-0">
                            <img src="preview-projects/<?php echo $project->getPreview(); ?>" alt="<?php echo $project->getTitle(); ?>" class="w-100">
                        </div>
                        <div class="col-6 m-auto p-5">
                            <h2><?php echo $project->getTitle(); ?></h2>
                            <p><?php echo $project->getDescription(); ?></p>
                            <a href="/project/detail?id=<?php echo $project->getId(); ?>" title="<?php echo $project->getTitle(); ?>" class="btn btn-success">View case study</a>
                        </div>
                    </div>

            <!-- Odd -->
            <?php else: ?>
                <div class="row">
                    <div class="col-6 m-auto text-end p-5">
                        <h2><?php echo $project->getTitle(); ?></h2>
                        <p><?php echo $project->getDescription(); ?></p>
                        <a href="/project/detail?id=<?php echo $project->getId(); ?>" title="<?php echo $project->getTitle(); ?>" class="btn btn-success">View case study</a>
                    </div>
                    <div class="col-6 p-0">
                        <img src="preview-projects/<?php echo $project->getPreview(); ?>" alt="<?php echo $project->getTitle(); ?>" class="w-100">
                    </div>
                </div>
            <?php endif; ?>

        <?php $i++; endforeach; ?>
    </body>
</html>
