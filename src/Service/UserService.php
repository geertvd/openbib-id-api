<?php

namespace OpenBibIdApi\Service;

class UserService extends Service implements UserServiceInterface
{

    /**
     * {@inheritdoc}
     */
    public function getUserInfo()
    {
        return $this->consumer->get('/user/info/:userId', array(':userId' => '{userId}'));
    }

    /**
     * {@inheritdoc}
     */
    public function getUserProfile()
    {
        return $this->consumer->get('/user/:userId', array(':userId' => '{userId}'));
    }

    /**
     * {@inheritdoc}
     */
    public function getUserAvailableOnlineCollections()
    {
        return $this->consumer->get('/permissions/user/:userId/consumer/list', array(':userId' => '{userId}'));
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLibraryAccounts()
    {
        return $this->consumer->get('/libraryaccounts/list/:userId', array(':userId' => '{userId}'));
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLibraryAccount($id)
    {
        return $this->consumer->get('/libraryaccounts/:id', array(':id' => $id));
    }

    /**
     * {@inheritdoc}
     */
    public function getUserActivities($id)
    {
        return $this->consumer->get('/libraryaccounts/:id/activities', array(':id' => $id));
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLoanHistory($id)
    {
        return $this->consumer->get('/libraryaccounts/:id/loanhistory', array(':id' => $id));
    }

    /**
     * {@inheritdoc}
     */
    public function getUserWelcomeMessages()
    {
        return $this->consumer->get('/user/:userId/welcomemessages', array(':userId' => '{userId}'));
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLibraryList()
    {
        return $this->consumer->get('/library/list', array(), array('uid' => '{userId}'));
    }

    /**
     * {@inheritdoc}
     */
    public function getUserLibraryListAndOnlineCollection($collectionConsumerKey)
    {
        return $this->consumer->get('/library/list', array(), array('uid' => '{userId}', 'consumerKey' => $collectionConsumerKey));
    }
}
