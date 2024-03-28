<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OfflineController extends AbstractController
{
    #[Route('/offline', name: 'qotd_offline')]
    public function __invoke(): Response {
        return $this->render('qotd/offline.html.twig');
    }
}
