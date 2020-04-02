<?php

namespace App\Security\Voter;

use App\Entity\Couleurs;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CouleursVoter extends Voter
{
    const COULEUR_VIEW = 'couleurView';
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::COULEUR_VIEW])
            && $subject instanceof \App\Entity\Couleurs;
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
         * @var Couleurs $couleur
         */
        $couleur = $subject;
        switch ($attribute) {
            case self::COULEUR_VIEW:
                // logic to determine if the user can EDIT
                return $this->canViewCouleurs($user);
                break;
        }

        return false;
    }

    private function canViewCouleurs($user)
    {
        $userRole = $user->getRoles();
        if($userRole[0] === 'ROLE_ADMIN' || $userRole[0] === 'ROLE_USER')
        {
            return true;
        }
        else{
            return false;
        }
    }
}
