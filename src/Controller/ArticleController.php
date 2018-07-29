<?php

namespace App\Controller;

use App\Repository\ArticleRepository;

use App\Form\ArticleType;
use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleController extends Controller
{

    private $ArticleRepository;

    private $manager;

    public function __construct(ArticleRepository $ArticleRepository, ObjectManager $manager )
    {
         $this->ArticleRepository = $ArticleRepository;
         $this->manager = $manager;
    }


    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'articles' => $this->ArticleRepository->findAll()
        ]);
    }

    /**
     * @Route("/article/add", name="add_article")
     */
    public function add( Request $request )
    {


      $article = new Article();
      $article->setPublishedAt(new \DateTime());
      $form = $this->createForm(ArticleType::class, $article);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
           $this->manager->persist($form->getData());
           $this->manager->flush();
           return $this->redirectToRoute('article');
      }


      return $this->render('article/add.html.twig',["form" => $form->createView()]);
    }
   /**
    * [show description]
    * @param  [type] $id [description]
    * @return [type]     [description]
    * @Route("/article/{id}", name="show_article")
    */
   public function show( Article $article)
   {
       //$article = $this->ArticleRepository->find($id);
       return $this->render("article/show.html.twig",["article" => $article]);
   }

/**
 * [edit description]
 * @return [type] [description]
 * @Route("/article/{id}/edit", name="edit_article")
 */
  public function edit( Request $request ,Article $article)
  {

      $form = $this->createForm(ArticleType::class, $article);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
           $this->manager->persist($form->getData());
           $this->manager->flush();
           return $this->redirectToRoute('article');
      }


      return $this->render('article/edit.html.twig',["form" => $form->createView()]);
  }

  /**
   * [delete description]
   * @Route("/article/{id}/delete", name="delete_article")
   */
  public function delete(Article $article )
  {
     $this->manager->remove($article);
     $this->manager->flush();

     $this->addFlash('notice','Deleted!');

     return $this->redirectToRoute('article');


  }




}
