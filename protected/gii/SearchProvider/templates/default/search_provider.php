<?php
echo '<?php'; ?>

class <?php echo $this->className; ?> extends SearchProvider
{
    /**
    * @param array $criteria The parameters to search with. The parameters must implement all functions of <?php echo $this->className;?>Interface to be included in the search.
    * @return array The returned data from the search.
    */
    protected function executeSearch($criteria)
    {
        foreach ($criteria as $id => $param) {
            // Ignore any case search parameters that do not implement <?php echo $this->className;?>Interface
            if ($param instanceof <?php echo $this->className;?>Interface) {
                // Add query construction code here.
            }
        }
    }
}
