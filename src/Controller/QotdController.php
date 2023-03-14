<?php

namespace App\Controller;

use App\Entity\Qotd;
use App\Repository\Model\QotdDirection;
use App\Repository\Model\QotdVote;
use App\Repository\QotdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class QotdController extends AbstractController
{
    public function __construct(
        private readonly QotdRepository $qotdRepository,
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route('/', name: 'qotd_index', defaults: ['direction' => QotdDirection::Latest->value])]
    #[Route('/top', name: 'qotd_index_top', defaults: ['direction' => QotdDirection::Top->value])]
    #[Route('/flop', name: 'qotd_index_flop', defaults: ['direction' => QotdDirection::Flop->value])]
    public function index(Request $request, QotdDirection $direction): Response
    {
        $pagination = $this
            ->qotdRepository
            ->findForHomepage(max(1, $request->query->getInt('page', 1)), $direction)
        ;

        return $this->render('qotd/index.html.twig', [
            'pagination' => $pagination,
            'direction' => $direction,
        ]);
    }

    #[Route('/qotd/{id}/vote/up', name: 'qotd_vote_up', methods: ['POST'], defaults: ['vote' => QotdVote::Up->value])]
    #[Route('/qotd/{id}/vote/down', name: 'qotd_vote_down', methods: ['POST'], defaults: ['vote' => QotdVote::Down->value])]
    #[IsGranted('QOTD_VOTE', subject: 'qotd')]
    public function vote(Request $request, Qotd $qotd, QotdVote $vote, #[CurrentUser] UserInterface $user): Response
    {
        if (!$this->isCsrfTokenValid('vote', (string) $request->request->get('token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        $qotd->applyVote($vote, $user);
        $this->em->flush();

        $this->addFlash('success', 'Thanks for your vote!');

        return $this->redirect($request->headers->get('referer') ?? $this->generateUrl('qotd_index'));
    }
}