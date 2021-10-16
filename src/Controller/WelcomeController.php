<?php

namespace App\Controller;
use App\Service\Checker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
class WelcomeController extends AbstractController
{
    /**
     * @Route("/welcome", name="welcome")
     */
    public function index(): Response
    {
    
        return $this->render('welcome/index.html.twig', [
            'controller_name' =>'Welcome',
        ]);
    }
    /**
     * @Route("/anagram", name="anagram")
     */
    public function anagram(): Response
    {
       
        return $this->render('welcome/anagram.html.twig', [
            'controller_name' =>'Welcome',
        ]);
    }
    /**
     * @Route("/pangram", name="pangram")
     */
    public function pangram(): Response
    {
        return $this->render('welcome/pangram.html.twig', [
            'controller_name' =>'Welcome',
        ]);
    }

    /**
     * @Route("/checkword")
     * @Method("POST")
     * @param Request $request
     */
   
    public function checkword(Request $request):Response
    {
        $error=FALSE;
        $checker=new Checker;
        $method = $request->get('method');
        switch ($method) {
            case 'anagram':
                $result=$checker->checkAnagram($request->get('word'));
              break;
            case 'pangram':
                $result=$checker->checkPangram($request->get('word'));
              break;
            case 'palindrome':
                $result=$checker->checkPalindrome($request->get('word'));
              break;
            default:
              $error=TRUE;
          }
        if($error){
            $res=json_encode(array(
                'status'=>FALSE,
                'message'=>'unknown Method Selected',
                'method'=>''
            ));
        }else{
            if($result){
                $message="This word is a ".$method;
            }else{
                $message="This word is NOT a ".$method;
            }
            $res=json_encode(array(
                'status'=>TRUE,
                'message'=>$message,
                'checker'=>$result,

            ));
        }
        return new Response($res);
    }
    
}
