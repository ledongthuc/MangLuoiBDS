<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class JAccessRule
{
    protected $data = array();

    public function __construct($identities)
    {
        // Convert string input to an array.
        if (is_string($identities))
        {
            $identities = json_decode($identities, true);
        }

        $this->mergeIdentities($identities);
    }

    public function getData()
    {
        return $this->data;
    }

    public function mergeIdentities($identities)
    {
        if ($identities instanceof JAccessRule)
        {
            $identities = $identities->getData();
        }

        if (is_array($identities))
        {
            foreach ($identities as $identity => $allow)
            {
                $this->mergeIdentity($identity, $allow);
            }
        }
    }

    public function mergeIdentity($identity, $allow)
    {
        $identity = (int) $identity;
        $allow = (int) ((boolean) $allow);

        // Check that the identity exists.
        if (isset($this->data[$identity]))
        {
            // Explicit deny always wins a merge.
            if ($this->data[$identity] !== 0)
            {
                $this->data[$identity] = $allow;
            }
        }
        else
        {
            $this->data[$identity] = $allow;
        }
    }

    public function allow($identities)
    {
        // Implicit deny by default.
        $result = null;

        // Check that the inputs are valid.
        if (!empty($identities))
        {
            if (!is_array($identities))
            {
                $identities = array($identities);
            }

            foreach ($identities as $identity)
            {
                // Technically the identity just needs to be unique.
                $identity = (int) $identity;

                // Check if the identity is known.
                if (isset($this->data[$identity]))
                {
                    $result = (boolean) $this->data[$identity];

                    // An explicit deny wins.
                    if ($result === false)
                    {
                        break;
                    }
                }

            }
        }

        return $result;
    }

    public function __toString()
    {
        return json_encode($this->data);
    }
}