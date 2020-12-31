<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        //dump($posts);
        return $this->render('post/index.html.twig', [
            "posts"=>$posts
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request){
        //create a post
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirect($this->generateUrl("post.index"));
        }

        //entity manager
        /*$em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();*/
        //el flush ejecuta todos los persist anteriores juntos al final

        //return response
        return $this->render("post/create.html.twig",[
            "formQuePaso"=>$form->createView()
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Post $post
     * @return Response
     */
    //public function show($id, PostRepository $postRepository){    version anterior
    public function show(Post $post){
        //create show view
        return $this->render("post/show.html.twig",[
            "post" => $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Post $post
     */
    public function remove(Post $post){
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash("success","Post was removed");

        return $this->redirect($this->generateUrl("post.index"));
    }
}
