<?php

namespace OpenBibIdApi\Service;

class LibraryService extends Service implements LibraryServiceInterface
{

    /**
     * {@inheritdoc}
     */
    public function getLibraryList()
    {
        return $this->consumer->getTwoLegged('/library/list');
    }

    /**
     * {@inheritdoc}
     */
    public function getLibraryById($libraryId)
    {
        return $this->consumer->getTwoLegged('/library/id/' . $libraryId);
    }

    /**
     * {@inheritdoc}
     */
    public function getLibraryByPBS($pbs)
    {
        return $this->consumer->getTwoLegged('/library/pbscode', array(), array('pbsCode' => $pbs));
    }

    /**
     * {@inheritdoc}
     */
    public function getLibraryByCatalogUrl($url)
    {
        return $this->consumer->getTwoLegged('/library/catalog', array(), array('catalog' => $url));
    }
}
