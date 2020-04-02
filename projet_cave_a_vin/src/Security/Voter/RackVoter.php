<?php

namespace App\Security\Voter;

use App\Entity\Rack;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class RackVoter extends Voter
{
    const RACK_VIEW = 'rackView';

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['POST_EDIT', 'POST_VIEW'])
            && $subject instanceof \App\Entity\Rack;
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
         * @var Rack $rack
         */
        $rack = $subject;
        switch ($attribute) {
            case self::RACK_VIEW:
                // logic to determine if the user can EDIT
                // return true or false
                return $this->canViewRack($user);
                break;
        }

        return false;
    }

    private function canViewRack($user)
    {
        $userRole = $user->getRoles();
        if($userRole[0] === 'ROLE_ADMIN' || $userRole === 'ROLE_USER')
        {
            return true;
        }else{
            return false;
        }
    }
}
