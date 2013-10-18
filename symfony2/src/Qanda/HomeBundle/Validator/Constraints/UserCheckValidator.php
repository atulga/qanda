<?php
namespace Qanda\HomeBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Qanda\HomeBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class UserCheckValidator extends ConstraintValidator
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        $filter = array('name' => $value);
        $user = $this->em->getRepository('QandaHomeBundle:User')->findOneBy($filter);
        if ($user) {
            $this->context->addViolation($constraint->message);
        }
    }
}

?>
