<?php
namespace User\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use User\NewsBundle\Entity\Enquiry;
use User\NewsBundle\Form\EnquiryType;

class PageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $blogs = $em->getRepository('UserNewsBundle:Blog')
                    ->getLatestBlogs();

        return $this->render('UserNewsBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
    }
	
	public function aboutAction()
    {
        return $this->render('UserNewsBundle:Page:about.html.twig');
    }
	
	public function contactAction(Request $request)
	{
    $enquiry = new Enquiry();

    $form = $this->createForm(EnquiryType::class, $enquiry);

    if ($request->isMethod($request::METHOD_POST)) {
      $form->handleRequest($request);

        if ($form->isValid()) {
            return $this->redirect($this->generateUrl('UserNewsBundle_contact'));
        }
    }

    return $this->render('UserNewsBundle:Page:contact.html.twig', array(
        'form' => $form->createView()
    ));
	
	
	}
}