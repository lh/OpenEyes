<?php echo '<?php'; ?>

class <?php echo $this->className; ?>Parameter extends CaseSearchParameter
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getKey()
    {
        // This is a human-readable value, so feel free to change this as required.
        return '<?php echo $this->name; ?>';
    }

    /**
    * Override this function for any new attributes added to the subclass. Ensure that you invoke the parent function first to obtain and augment the initial list of attribute names.
    * @return array An array of attribute names.
    */
    public function attributeNames()
    {
        return parent::attributeNames();
    }

    /**
    * Override this function if the parameter subclass has extra validation rules. If doing so, ensure you invoke the parent function first to obtain the initial list of rules.
    * @return array The validation rules for the parameter.
    */
    public function rules()
    {
        return parent::rules();
    }

    abstract public function renderParameter($id)
    {
        // Place screen-rendering code here.
    }

    /**
    * Generate a SQL fragment representing the subquery of a FROM condition.
    * @param $searchProvider The search provider. This is used to determine whether or not the search provider is using SQL syntax.
    * @return mixed The constructed query string.
    */
    abstract public function query($searchProvider)
    {
        // Construct your SQL query here.
        return null;
    }

    /**
    * Get the list of bind values for use in the SQL query.
    * @return array An array of bind values. The keys correspond to the named binds in the query string.
    */
    abstract public function bindValues()
    {
        // Construct your list of bind values here. Use the format ":bind" => "value".
        return array();
    }

    /**
    * Generate a SQL fragment representing a JOIN condition to a subquery.
    * @param $joinAlias The alias of the table being joined to.
    * @param $criteria An array of join conditions. The ID for each element is the column name from the aliased table.
    * @param $searchProvider The search provider. This is used for an internal query invocation for subqueries.
    * @return string A SQL string representing a complete join condition. Join type is specified within the subclass definition.
    */
    public function join($joinAlias, $criteria, $searchProvider)
    {
        // Construct your JOIN condition here. Generally this involves wrapping the query in a JOIN condition.
        return null;
    }

    /**
    * Get the alias of the database table being used by this parameter instance.
    * @return string The alias of the table for use in the SQL query.
    */
    public function alias()
    {
        return "<?php echo $this->alias; ?>_$this->id";
    }
}
