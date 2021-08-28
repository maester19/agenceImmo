<?php

namespace App\Controller\admin;

use App\Entity\Properties;
use App\Form\PropertiesType;
use App\Repository\PropertiesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class adminPropertyController extends AbstractController
{
    /**
     * @var PropertiesRepository
     */

     private $repository;

     public function __construct(PropertiesRepository $repository)
     {
         $this->repository = $repository;
     }

     /**
      * @Route("/admin", name="admin.property.index")
      * @return Response
      */

      public function index()
      {
          $properties = $this->repository->findAll();
          return $this->render("admin/property/index.html.twig", compact("properties"));
      }

      /**
       * @Route("/admin/property/create", name="admin.property.new")
       */

       public function new(Request $request)
       {
           $property = new properties;

        $form = $this->createForm(PropertiesType::class, $property); 
        $form->handleRequest($request);  

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($property);
            $em->flush();
            $this->addFlash('success', "Bien creer avec succes");
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render("admin/property/new.html.twig", [
            "property" => $property,
            "form" => $form->createView()
        ]);
       }

      /**
       * @Route("/admin/{id}", name="admin.property.edit", methods="GET|POST")
       * @param Property $property
       * @param Request $request
       * @return Response
       */

       public function edit(Properties $property, Request $request)
       {
        $form = $this->createForm(PropertiesType::class, $property); 
        $form->handleRequest($request);  

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', "Bien editer avec succes");
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render("admin/property/edit.html.twig", [
            "property" => $property,
            "form" => $form->createView()
        ]);
       }

       /**
        * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
        * @param Properties $property
        * @return Response
        */

        public function delete(Properties $property, Request $request)
        {
            if($this->isCsrfTokenValid('delete'.$property->getId(), $request->request->get('_token')))
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($property);
                $em->flush();
                $this->addFlash('success', "Bien supprimer avec succes");
            }
            return $this->redirectToRoute("admin.property.index");
        }

}