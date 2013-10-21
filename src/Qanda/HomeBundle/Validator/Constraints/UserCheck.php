<?php
namespace Qanda\HomeBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UserCheck extends Constraint
{
    public $message = 'Хэрэглэгчийн нэр давхардсан байна!';

    public function validatedBy()
    {
        return 'usercheck';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
?>
