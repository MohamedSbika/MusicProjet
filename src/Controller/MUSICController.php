<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Entity\Titre;
use App\Form\TitreType;
use App\Form\ArtisteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class MUSICController extends AbstractController
{
    #[Route('/home', name: 'app_music')]
    public function index(): Response
    {
        return $this->render('music/index.html.twig', [
            'controller_name' => 'MUSICController',
        ]);
    }
    #[Route('/titre', name: 'ajouter_titre')]
    public function ajouter(Request $request): Response
    {
        $titre = new Titre();
        $form = $this->createForm(TitreType::class, $titre);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($titre);
            $entityManager->flush();    
            return $this->redirectToRoute('voir_titres');
        }
    
        return $this->render('music/ajouter_titre.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/artiste', name: 'ajouter_artiste')]
    public function ajouterArtiste(Request $request): Response
    {
        $artiste = new Artiste();
        $form = $this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artiste);
            $entityManager->flush();    
            return $this->redirectToRoute('artiste_details', ['id' => $artiste->getId()]);
        }
    
        return $this->render('music/ajouter_artiste.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    
    /**
* @Route("/voir/{id}", name="titre_details")
*/
public function show($id)
{
 $titre = $this->getDoctrine()
 ->getRepository(Titre::class)
 ->find($id);
 $em = $this->getDoctrine()->getManager();
 $listTitres = $em->getRepository(Titre::class)
     ->findBy(['id' => $id]);
 if (!$titre) {
 throw $this->createNotFoundException(
 'No titre found for id '.$id
 );
 }

return $this->render('music/voir_titres.html.twig', [
'listTitres'=> $listTitres,
 'titre' =>$titre
 ]);
 }
 /**
* @Route("/artistes", name="artiste_details")
*/
public function artiste_details()
{
    $em = $this->getDoctrine()->getManager();
    $repo = $em->getRepository(Artiste::class);
    $lesArtistes = $repo->findAll();
    return $this->render('music/voir_artistes.html.twig',['lesArtistes'=>$lesArtistes]);
}
   /**
* @Route("/titres", name="voir_titres")
*/
public function voir_titre()
{
    $em = $this->getDoctrine()->getManager();
    $repo = $em->getRepository(Titre::class);
    $listTitres = $repo->findAll();
    return $this->render('music/voir_titres.html.twig',['listTitres'=>$listTitres]);
} 
 /**
* @Route("/supp/{id}", name="artiste_delete")
*/
public function delete(Request $request,$id):Response
{
    $c = $this->getDoctrine()
        ->getRepository(Artiste::class)
        ->find($id);
    if (!$c){
        throw $this->createNotFoundException(
            "aucun joueur trouvé pour l'id".$id
        );
    }
    $entityManager=$this ->getDoctrine()->getManager();
    $entityManager->remove($c);
    $entityManager->flush();
    return $this->redirectToRoute('artiste_details');
}
/**
 * @Route("/modif/{id}", name="modifier_artiste")
 * Method({"GET", "POST"})
 */
public function modifier(Request $request, $id): Response
{
    $artiste = $this->getDoctrine()->getRepository(Artiste::class)->find($id);
    if (!$artiste) {
        throw $this->createNotFoundException('artiste non trouvée pour l\'ID ' . $id);
    }
    $form = $this->createForm(ArtisteType::class, $artiste);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $logoFile = $form->get('logoFile')->getData();
    
        if ($logoFile !== null) {
            $artiste->setImgartiste($logoFile->getFilename());
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('artiste_details', ['id' => $artiste->getId()]);
    }
    return $this->render('music/modifier_artiste.html.twig', [
        'form' => $form->createView(),
    ]);
}
/**
* @Route("/supprimer/{id}", name="titre_delete")
*/
public function deletetitre(Request $request,$id):Response
{
    $t = $this->getDoctrine()
        ->getRepository(Titre::class)
        ->find($id);
    if (!$t){
        throw $this->createNotFoundException(
            "aucun joueur trouvé pour l'id".$id
        );
    }
    $entityManager=$this ->getDoctrine()->getManager();
    $entityManager->remove($t);
    $entityManager->flush();
    return $this->redirectToRoute('titre_details');
}
/**
 * @Route("/modifier/{id}", name="modifier_titre")
 * Method({"GET", "POST"})
 */
public function modifier_titre(Request $request, $id): Response
{
    $titre = $this->getDoctrine()->getRepository(Titre::class)->find($id);
    if (!$titre) {
        throw $this->createNotFoundException('titre non trouvée pour l\'ID ' . $id);
    }
    $form = $this->createForm(TitreType::class, $titre);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $logoFile = $form->get('logoFile')->getData();
    
        if ($logoFile !== null) {
            $titre->setImgtitre($logoFile->getFilename());
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('voir_titres');
    }
    return $this->render('music/modifier_titre.html.twig', [
        'form' => $form->createView(),
    ]);
}
/**
* @Route("/artistes2", name="artiste_details2")
*/
public function artiste_details2()
{
    $em = $this->getDoctrine()->getManager();
    $repo = $em->getRepository(Artiste::class);
    $lesArtistes = $repo->findAll();
    return $this->render('music/voir_artistes2.html.twig',['lesArtistes'=>$lesArtistes]);
}
   /**
* @Route("/titres2", name="voir_titres2")
*/
public function voir_titre2()
{
    $em = $this->getDoctrine()->getManager();
    $repo = $em->getRepository(Titre::class);
    $listTitres = $repo->findAll();
    return $this->render('music/voir_titres2.html.twig',['listTitres'=>$listTitres]);
} 
 /**
 * @Route("/", name="hello")
 */
public function hello()
{
return $this->render('music/hello.html.twig');
} 
}
