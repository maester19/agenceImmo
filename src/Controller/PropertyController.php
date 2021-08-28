<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Properties;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Notification\ContactNotification;
use App\Repository\PropertiesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class PropertyController extends AbstractController
{
    public function __construct(PropertiesRepository $repository)
    {
        $this->repository = $repository;
    }
    
    
    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */

    public function index(PaginatorInterface $paginator, Request $request):Response
    {
        $search = new PropertySearch;
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );
        return $this->render("property/index.html.twig", [
            "current_menu" => "properties",
            "properties" => $properties,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/biens/{id}-{slug}", name="property.show", requirements={"slug": "[a-z0-9/-]*"})
     * @param Properties $property
     * @return Response
     */

     public function show(Properties $property, string $slug, Request $request):response
     {
         if($property->getSlug() !== $slug)
         {
             return $this->redirectToRoute("property.show", [
                 "id" => $property->getId(),
                 "slug" => $property->getSlug()
             ] , 301);
         }
         
         $contact = new Contact();
         $contact->setProperty($property);
         $form = $this->createForm(ContactType::class, $contact);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            //$notification->notify($contact);
             $this->addFlash('success', 'Votre email a bien ete envoyer');
             return $this->redirectToRoute("property.show", [
                "id"     => $property->getId(),
                "slug"   => $property->getSlug()
             ]);
         }

        return $this->render("property/show.html.twig", [
            "property"     => $property,
            "current_menu" => "properies",
            "form"         => $form->createView()
         ]);
     }
}