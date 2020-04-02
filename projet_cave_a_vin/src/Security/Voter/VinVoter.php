<?php

namespace App\Security\Voter;

use App\Entity\Cave;
use App\Entity\Vins;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class VinVoter extends Voter
{
    const VIN_VIEW = 'vinView';
    const VIN_EDIT = 'vinEdit';

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::VIN_VIEW, self::VIN_EDIT])
            && $subject instanceof \App\Entity\Vins;
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
         * @var Vins $vin
         */
        $vin = $subject;
        switch ($attribute) {
            case self::VIN_VIEW:
                return $this->canviewVin($user, $vin);
                break;
            case self::VIN_EDIT:
                // logic to determine if the user can VIEW
                return $this->canEditVin($user, $vin);
                break;
        }

        return false;
    }

    private function canEditVin($user, Vins $vins)
    {
        $userRole = $user->getRoles();
        if($userRole[0] !== 'ROLE_ADMIN')
        {
            $caves = $user->getCave();
            foreach ($caves as $cave) {
                if ($cave->getId() === $vins->getCave()->getId())
                    return true;
                else
                    return false;
            }
        }
        else{
            return true;
        }
    }

    private function canviewVin($user, Vins $vins)
    {
        $userRole = $user->getRoles();
        if($userRole[0] !== 'ROLE_ADMIN') {
            $caves = $user->getCave();
            foreach ($caves as $cave) {
                if ($cave->getId() === $vins->getCave()->getId())
                    return true;
                else
                    return false;
            }
        }else
        {
            return true;
        }
    }
}
