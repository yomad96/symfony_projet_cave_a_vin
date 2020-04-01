<?php

namespace App\Security\Voter;

use App\Entity\Cave;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CaveVoter extends Voter
{
    const caveEdit = 'caveEdit';
    const caveView = 'caveView';

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['caveEdit', 'caveView'])
            && $subject instanceof \App\Entity\Cave;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        /**
         * @var Cave $cave
         */
        $cave = $subject;
        switch ($attribute) {
            case 'caveEdit':
                break;
            case 'caveView':
                if($user->getId() === $cave->getUser())
                    return true;
                break;
        }

        return false;
    }
}
