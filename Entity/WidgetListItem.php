<?php

namespace Victoire\ListBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\CmsBundle\Annotations as VIC;
use Victoire\CmsBundle\Entity\Widget;

/**
 * WidgetListItem
 *
 * @ORM\Table("cms_widget_list_item")
 * @ORM\Entity
 */
class WidgetListItem extends Widget
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="WidgetList", inversedBy="items")
     * @ORM\JoinColumn(name="list_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    private $list;


    /**
     * if __isset returns true, returns linked entity value
     * else, call default get() method
     *
     * @param string $name magic called value
     * @return liked entity value
     **/
    public function __get($name)
    {
        return $this->getEntity()->getReferedValue($this->getList()->getBusinessEntitiesName(), $name);
    }

    /**
     * check if asked field is defined in the entity
     * and if entity is in proxy mode
     *
     * @param string $name magic called value
     * @return liked entity value
     **/
    public function __isset($name)
    {
        if (array_key_exists($name, get_class_vars(get_class($this)))) {
            if ($this->getList() && $this->getList()->getBusinessEntitiesName()) {
                return true;
            }
        }

        return false;
    }
    /**
     * Get fields
     *
     * @return string
     */
    public function getFields()
    {
        return $this->getList()->getFields();
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WidgetListItem
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return WidgetListItem
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Set list
     *
     * @param string $list
     * @return WidgetListItem
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return string
     */
    public function getList()
    {
        return $this->list;
    }




}
