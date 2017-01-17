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
    public function getLibraryById($id)
    {
        return $this->consumer->getTwoLegged('/library/id/' . $id);
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
