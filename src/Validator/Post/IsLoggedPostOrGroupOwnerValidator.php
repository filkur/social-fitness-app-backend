<?php

declare(strict_types=1);

namespace App\Validator\Post;

use App\DTO\Post\Input\PostInput;
use App\Entity\User\User;
use App\Repository\Post\PostRepository;
use App\Utils\User\UserGetter;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsLoggedPostOrGroupOwnerValidator extends ConstraintValidator
{
    private UserGetter $userGetter;

    private PostRepository $postRepository;

    public function __construct(
        UserGetter $userGetter,
        PostRepository $postRepository
    ) {
        $this->userGetter = $userGetter;
        $this->postRepository = $postRepository;
    }

    /**
     * @param PostInput                $value
     * @param IsLoggedPostOrGroupOwner $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /** @var User $loggedUser */
        $loggedUser = $this->userGetter->get();

        $post = $this->postRepository->find($value->id);

        $postOwner = $post->getOwner();

        if ($loggedUser === $postOwner) {
            return;
        }

        $groupOwner = $post->getGroup()
                           ->getOwner();

        if ($loggedUser === $groupOwner) {
            return;
        }

        $this->context->addViolation($constraint->message);
    }
}