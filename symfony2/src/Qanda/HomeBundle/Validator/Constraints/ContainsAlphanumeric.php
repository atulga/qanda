<?php
namespace Qanda\HomeBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsAlphanumeric extends Constraint
{
    public $message = '"%string%" хэрэглэгчийн нэр давхардсан байна!';
}
?>
