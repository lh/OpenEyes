<?php
echo '<?php'; ?>

class <?php echo $this->className; ?> extends SearchProvider
{
    /**
    * @param array $criteria The parameters to search with. The parameters must implement all functions of <?php echo $this->className;?>Interface.
    * @return array The returned data from the search.
    */
    protected function executeSearch($criteria)
    {
    }
}
