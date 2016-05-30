<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Clever\CleverApplication;

$app = new CleverApplication();
// replace with mechanism to retrieve EntityManager in your app
$entityManager = $app->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
