<?php

namespace Blogger\BlogBundle\Controller;

use Blogger\BlogBundle\Entity\Entry;
use Blogger\BlogBundle\Form\EntryType;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{

    /**
     * @var ObjectManager
     */
    private $entityManager;

    /**
     * @var \Blogger\BlogBundle\Repository\EntryRepository|\Doctrine\ORM\EntityRepository
     */
    private $entryRepository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entryRepository = $entityManager->getRepository('BloggerBlogBundle:Entry');
    }

    public function viewAction(int $id)
    {
        $blogEntry = $this->entryRepository->find($id);

        return $this->render('BloggerBlogBundle:Blog:view.html.twig', ['entry' => $blogEntry]);
    }

    public function createAction(Request $request)
    {
        $blogEntry = new Entry();
        $form = $this->createForm(EntryType::class, $blogEntry, ['action' => $request->getUri()]);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $blogEntry->setAuthor($this->getUser());
            $blogEntry->setTimestamp(new \DateTime());

            $this->entityManager->persist($blogEntry);
            $this->entityManager->flush();
            return $this->redirect($this->generateUrl('blog_view', ['id' => $blogEntry->getId()]));
        }

        return $this->render('BloggerBlogBundle:Blog:create.html.twig', ['form' => $form->createView()]);
    }

    public function editAction(int $id, Request $request)
    {
        $blogEntry = $this->entryRepository->find($id);

        $form = $this->createForm(EntryType::class, $blogEntry, ['action' => $request->getUri()]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->entityManager->flush();
            return $this->redirect($this->generateUrl('blog_view', ['id' => $blogEntry->getId()]));
        }

        return $this->render('BloggerBlogBundle:Blog:edit.html.twig', ['form' => $form->createView(), 'entry' => $blogEntry]);
    }

    public function deleteAction(int $id)
    {
        $blogEntry = $this->entryRepository->find($id);

        $this->entityManager->remove($blogEntry);
        $this->entityManager->flush();
        return $this->redirect($this->generateUrl('index'));
    }

}
