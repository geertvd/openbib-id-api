<?php

namespace OpenBibIdApi\Service;

use OpenBibIdApi\Value\UserActivities\Hold;
use OpenBibIdApi\Value\UserActivities\Loan;
use OpenBibIdApi\Value\UserActivities\UserActivities;

class UserService extends Service implements UserServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserInfo()
    {
        return $this->consumer->get(
            '/user/info/:userId',
            array(':userId' => '{userId}')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUserProfile()
    {
        return $this->consumer->get(
            '/user/:userId',
            array(':userId' => '{userId}')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUserAvailableOnlineCollections()
    {
        return $this->consumer->get(
            '/permissions/user/:userId/consumer/list',
            array(':userId' => '{userId}')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLibraryAccounts()
    {
        return $this->consumer->get(
            '/libraryaccounts/list/:userId',
            array(':userId' => '{userId}')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLibraryAccount($accountId)
    {
        return $this->consumer->get(
            '/libraryaccounts/:id',
            array(':id' => $accountId)
        );
    }
    /**
     * {@inheritdoc}
     */
    public function getUserActivities($accountId)
    {
        $response = $this->consumer->get(
            '/libraryaccounts/:id/activities',
            array(':id' => $accountId)
        );
        return UserActivities::fromXml($response);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLoanHistory($accountId)
    {
        return $this->consumer->get(
            '/libraryaccounts/:id/loanhistory',
            array(':id' => $accountId)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUserWelcomeMessages()
    {
        return $this->consumer->get(
            '/user/:userId/welcomemessages',
            array(':userId' => '{userId}')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLibraryList()
    {
        return $this->consumer->get(
            '/library/list',
            array(),
            array('uid' => '{userId}')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLibraryListAndOnlineCollection($collectionKey)
    {
        return $this->consumer->get(
            '/library/list',
            array(),
            array('uid' => '{userId}', 'consumerKey' => $collectionKey)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function cancelReservation($accountId, Hold $hold)
    {
        return $this->consumer->post(
            '/libraryaccounts/:id/hold/cancel',
            array(':id' => $accountId),
            array(
                'docNumber' => (string) $hold->getLibraryItemMetadata()->getDocNumber(),
                'itemSequence' => (string) $hold->getSequence(),
                'recNumber' => (string) $hold->getRequestNumber(),
                'sequence' => (string) $hold->getSequence(),
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function renewLoan($accountId, Loan $loan)
    {
        return $this->consumer->post(
            '/libraryaccounts/:id/renew',
            array(':id' => $accountId),
            array(
                'docNumber' => (string) $loan->getLibraryItemMetadata()->getDocNumber(),
                'itemSequence' => (string) $loan->getItemSequence(),
            )
        );
    }
}
