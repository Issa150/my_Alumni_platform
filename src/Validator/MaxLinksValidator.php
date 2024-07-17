<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\SocialLink;

/**
 * @Annotation
 */
class MaxLinks extends Constraint
{
    public $message = 'Un utilisateur ne peut pas avoir plus de {{ limit }} liens.';
    public $limit;

    public function getRequiredOptions(): array
    {
        return ['limit'];
    }
}

class MaxLinksValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        $userId = $value->getUserId();
        $linkCount = $this->entityManager->getRepository(SocialLink::class)->count(['userId' => $userId]);

        if ($linkCount >= $constraint->limit) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ limit }}', $constraint->limit)
                ->addViolation();
        }
    }
}