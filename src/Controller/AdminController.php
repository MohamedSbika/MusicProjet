<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class AdminController extends AbstractController
{
 /**
 * @Route("/admin", name="admin")
 */
 public function admin()
 {
 return $this->render('music/index.html.twig');
 }
}
