<?php

namespace OpenBibIdApi\Service;

class ListService extends Service implements ListServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserLists()
    {
        return $this->consumer->get('/list');
    }

    /**
     * {@inheritdoc}
     */
    public function getListById($listId)
    {
        return $this->consumer->get(
            '/list/:id',
            array(':id' => $listId)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getCatalogItems($libId, $itemId)
    {
        return $this->consumer->getTwoLegged(
            '/list/catalog/items',
            array(),
            array('libraryId' => $libId, 'itemId' => $itemId)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getListItems($listId)
    {
        return $this->consumer->get(
            '/list/:id/items',
            array(':id' => $listId)
        );
    }
}
