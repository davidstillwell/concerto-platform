<?php

namespace Concerto\PanelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Concerto\PanelBundle\Entity\User;

abstract class ATopEntity extends AEntity {

    const ACCESS_PUBLIC = 2;
    const ACCESS_GROUP = 1;
    const ACCESS_PRIVATE = 0;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    protected $owner;

    /**
     *
     * @var integer
     * @ORM\Column(type="integer")
     */
    protected $accessibility;

    /**
     *
     * @var groups
     * @ORM\Column(type="string")
     */
    protected $groups;

    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $archived;

    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $protected;
    
    /**
     *
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $starterContent;
    
    /**
     *
     * @var integer
     * @ORM\Column(type="integer")
     */
    protected $revision;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string")
     */
    protected $checksum;

    public function __construct() {
        parent::__construct();

        $this->accessibility = self::ACCESS_PRIVATE;
        $this->groups = "";
        $this->archived = false;
        $this->protected = false;
        $this->starterContent = false;
        $this->revision = 0;
        $this->checksum = "";
    }

    /**
     * Set owner
     * @param User $user
     */
    public function setOwner($user) {
        $this->owner = $user;

        return $this;
    }

    /**
     * Get owner
     *
     * @return User 
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * Set accessibility
     *
     * @param integer $access
     */
    public function setAccessibility($access) {
        $this->accessibility = $access;

        return $this;
    }

    /**
     * Get accessibility
     *
     * @return integer 
     */
    public function getAccessibility() {
        return $this->accessibility;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     */
    public function setArchived($archived) {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Is archived
     *
     * @return boolean 
     */
    public function isArchived() {
        return $this->archived;
    }

    /**
     * Set protected
     *
     * @param boolean $protected
     */
    public function setProtected($protected) {
        $this->protected = $protected;

        return $this;
    }

    /**
     * Is protected
     *
     * @return boolean 
     */
    public function isProtected() {
        return $this->protected;
    }
    
    /**
     * Set starter content
     *
     * @param boolean $starterContent
     */
    public function setStarterContent($starterContent) {
        $this->starterContent = $starterContent;

        return $this;
    }

    /**
     * Is starter content
     *
     * @return boolean 
     */
    public function isStarterContent() {
        return $this->starterContent;
    }
    
    /**
     * Set revision
     *
     * @param integer $revision
     */
    public function setRevision($revision) {
        $this->revision = $revision;

        return $this;
    }
    
    /**
     * Increment revision
     */
    public function incrementRevision() {
        $this->revision++;

        return $this;
    }

    /**
     * Get revision
     *
     * @return integer 
     */
    public function getRevision() {
        return $this->revision;
    }
    
    /**
     * Set checksum
     *
     * @param string $checksum
     */
    public function setChecksum($checksum) {
        $this->checksum = $checksum;

        return $this;
    }

    /**
     * Get checksum
     *
     * @return string 
     */
    public function getChecksum() {
        return $this->checksum;
    }

    /**
     * Set groups
     *
     * @param string $groups
     */
    public function setGroups($groups) {
        $this->groups = trim($groups);

        return $this;
    }

    /**
     * Get groups
     *
     * @return string 
     */
    public function getGroups() {
        return $this->groups;
    }

    /**
     * Get groups array
     *
     * @return array 
     */
    public function getGroupsArray() {
        $groups = explode(",", $this->groups);
        $result = array();
        foreach ($groups as $group) {
            $g = trim($group);
            if ($g) {
                array_push($result, $g);
            }
        }
        return $result;
    }

    /**
     * Has group
     * 
     * @param string $group
     * @return boolean 
     */
    public function hasGroup($group) {
        if (!trim($group)) {
            return false;
        }
        $groups = $this->getGroupsArray();
        foreach ($groups as $g) {
            if ($g === $group) {
                return true;
            }
        }
        return false;
    }

    /**
     * Has any of the group
     * 
     * @param array $other_groups
     * @return boolean 
     */
    public function hasAnyFromGroup($other_groups) {
        $groups = $this->getGroupsArray();
        foreach ($groups as $group) {
            foreach ($other_groups as $other_group) {
                if ($other_group == $group) {
                    return true;
                }
            }
        }
        return false;
    }

}
