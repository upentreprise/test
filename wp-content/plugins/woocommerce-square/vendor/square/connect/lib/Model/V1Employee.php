<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * V1Employee Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class V1Employee implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'id' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'role_ids' => 'string[]',
        'authorized_location_ids' => 'string[]',
        'email' => 'string',
        'status' => 'string',
        'external_id' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'id' => 'id',
        'first_name' => 'first_name',
        'last_name' => 'last_name',
        'role_ids' => 'role_ids',
        'authorized_location_ids' => 'authorized_location_ids',
        'email' => 'email',
        'status' => 'status',
        'external_id' => 'external_id',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'id' => 'setId',
        'first_name' => 'setFirstName',
        'last_name' => 'setLastName',
        'role_ids' => 'setRoleIds',
        'authorized_location_ids' => 'setAuthorizedLocationIds',
        'email' => 'setEmail',
        'status' => 'setStatus',
        'external_id' => 'setExternalId',
        'created_at' => 'setCreatedAt',
        'updated_at' => 'setUpdatedAt'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'id' => 'getId',
        'first_name' => 'getFirstName',
        'last_name' => 'getLastName',
        'role_ids' => 'getRoleIds',
        'authorized_location_ids' => 'getAuthorizedLocationIds',
        'email' => 'getEmail',
        'status' => 'getStatus',
        'external_id' => 'getExternalId',
        'created_at' => 'getCreatedAt',
        'updated_at' => 'getUpdatedAt'
    );
  
    /**
      * $id The employee's unique ID.
      * @var string
      */
    protected $id;
    /**
      * $first_name The employee's first name.
      * @var string
      */
    protected $first_name;
    /**
      * $last_name The employee's last name.
      * @var string
      */
    protected $last_name;
    /**
      * $role_ids The ids of the employee's associated roles. Currently, you can specify only one or zero roles per employee.
      * @var string[]
      */
    protected $role_ids;
    /**
      * $authorized_location_ids The IDs of the locations the employee is allowed to clock in at.
      * @var string[]
      */
    protected $authorized_location_ids;
    /**
      * $email The employee's email address.
      * @var string
      */
    protected $email;
    /**
      * $status CWhether the employee is ACTIVE or INACTIVE. Inactive employees cannot sign in to Square Register.Merchants update this field from the Square Dashboard. See [V1EmployeeStatus](#type-v1employeestatus) for possible values
      * @var string
      */
    protected $status;
    /**
      * $external_id An ID the merchant can set to associate the employee with an entity in another system.
      * @var string
      */
    protected $external_id;
    /**
      * $created_at The time when the employee entity was created, in ISO 8601 format.
      * @var string
      */
    protected $created_at;
    /**
      * $updated_at The time when the employee entity was most recently updated, in ISO 8601 format.
      * @var string
      */
    protected $updated_at;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initializing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            if (isset($data["id"])) {
              $this->id = $data["id"];
            } else {
              $this->id = null;
            }
            if (isset($data["first_name"])) {
              $this->first_name = $data["first_name"];
            } else {
              $this->first_name = null;
            }
            if (isset($data["last_name"])) {
              $this->last_name = $data["last_name"];
            } else {
              $this->last_name = null;
            }
            if (isset($data["role_ids"])) {
              $this->role_ids = $data["role_ids"];
            } else {
              $this->role_ids = null;
            }
            if (isset($data["authorized_location_ids"])) {
              $this->authorized_location_ids = $data["authorized_location_ids"];
            } else {
              $this->authorized_location_ids = null;
            }
            if (isset($data["email"])) {
              $this->email = $data["email"];
            } else {
              $this->email = null;
            }
            if (isset($data["status"])) {
              $this->status = $data["status"];
            } else {
              $this->status = null;
            }
            if (isset($data["external_id"])) {
              $this->external_id = $data["external_id"];
            } else {
              $this->external_id = null;
            }
            if (isset($data["created_at"])) {
              $this->created_at = $data["created_at"];
            } else {
              $this->created_at = null;
            }
            if (isset($data["updated_at"])) {
              $this->updated_at = $data["updated_at"];
            } else {
              $this->updated_at = null;
            }
        }
    }
    /**
     * Gets id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
  
    /**
     * Sets id
     * @param string $id The employee's unique ID.
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Gets first_name
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }
  
    /**
     * Sets first_name
     * @param string $first_name The employee's first name.
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }
    /**
     * Gets last_name
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }
  
    /**
     * Sets last_name
     * @param string $last_name The employee's last name.
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }
    /**
     * Gets role_ids
     * @return string[]
     */
    public function getRoleIds()
    {
        return $this->role_ids;
    }
  
    /**
     * Sets role_ids
     * @param string[] $role_ids The ids of the employee's associated roles. Currently, you can specify only one or zero roles per employee.
     * @return $this
     */
    public function setRoleIds($role_ids)
    {
        $this->role_ids = $role_ids;
        return $this;
    }
    /**
     * Gets authorized_location_ids
     * @return string[]
     */
    public function getAuthorizedLocationIds()
    {
        return $this->authorized_location_ids;
    }
  
    /**
     * Sets authorized_location_ids
     * @param string[] $authorized_location_ids The IDs of the locations the employee is allowed to clock in at.
     * @return $this
     */
    public function setAuthorizedLocationIds($authorized_location_ids)
    {
        $this->authorized_location_ids = $authorized_location_ids;
        return $this;
    }
    /**
     * Gets email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
  
    /**
     * Sets email
     * @param string $email The employee's email address.
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Gets status
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
  
    /**
     * Sets status
     * @param string $status CWhether the employee is ACTIVE or INACTIVE. Inactive employees cannot sign in to Square Register.Merchants update this field from the Square Dashboard. See [V1EmployeeStatus](#type-v1employeestatus) for possible values
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    /**
     * Gets external_id
     * @return string
     */
    public function getExternalId()
    {
        return $this->external_id;
    }
  
    /**
     * Sets external_id
     * @param string $external_id An ID the merchant can set to associate the employee with an entity in another system.
     * @return $this
     */
    public function setExternalId($external_id)
    {
        $this->external_id = $external_id;
        return $this;
    }
    /**
     * Gets created_at
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
  
    /**
     * Sets created_at
     * @param string $created_at The time when the employee entity was created, in ISO 8601 format.
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }
    /**
     * Gets updated_at
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
  
    /**
     * Sets updated_at
     * @param string $updated_at The time when the employee entity was most recently updated, in ISO 8601 format.
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
  
    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        } else {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this));
        }
    }
}