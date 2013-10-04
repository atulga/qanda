<?php

namespace Qanda\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Qanda\HomeBundle\Entity\Question;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="/qanda/index.php/show")
     * @Template()
     */
    public function indexAction()
    {
        $questions = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->findAll();
/*        if (has_get('page')) {
            $current_page = get_param('page');
        } else {
            $current_page = 1;
        }
 */
/*      $pager = new Paginator('Question', $current_page);
        $questions = $pager->fetch();
 */
        return array('questions' => $questions );
    }


}
