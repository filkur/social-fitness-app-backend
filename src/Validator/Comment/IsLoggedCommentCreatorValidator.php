<?php

declare(strict_types=1);

namespace App\Validator\Comment;

use App\DTO\Comment\Input\CommentInput;
use App\Entity\Comment\Comment;
use App\Entity\User\User;
use App\Repository\Comment\CommentRepository;
use App\Utils\User\UserGetter;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsLoggedCommentCreatorValidator extends ConstraintValidator
{
    private CommentRepository $commentRepository;

    private UserGetter $userGetter;

    public function __construct(
        CommentRepository $commentRepository,
        UserGetter $userGetter
    ) {
        $this->commentRepository = $commentRepository;
        $this->userGetter = $userGetter;
    }

    /**
     * @param CommentInput           $value
     * @param IsLoggedCommentCreator $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /** @var Comment $comment */
        $comment = $this->commentRepository->find($value->id);

        /** @var User $loggedUser */
        $loggedUser = $this->userGetter->get();

        if ($loggedUser === $comment->getOwner()) {
            return;
        }
        $this->context->addViolation($constraint->message);
    }
}