<?php
declare(strict_types=1);

namespace Presentation\UI\Dropdown;

use Domain\Aggregate\AggregateInterface;
use Domain\Aggregate\CollectionInterface;
use Domain\Aggregate\CollectionTrait;
use Iterator;

/**
 *
 */
class ActionCollection implements CollectionInterface
{
    use CollectionTrait;

    /** @var ?Action[]  */
    private ?array $items;

    /**
     *
     */
    public function __construct()
    {
        $this->position = 0;
        $this->items = null;
    }

    /**
     * @return Action|null
     */
    public function current(): ?Action
    {
        return $this->valid() ? $this->items[$this->position] : null;
    }

    /**
     * @return ?Action[]
     */
    public function getCollection(): ?array
    {
        return $this->items;
    }

    /**
     * @param AggregateInterface|Action $action
     * @return $this
     */
    public function addItem(AggregateInterface|Action $action): ActionCollection
    {
        if ( !$this->items ) {
            $this->items = [];
        }
        $this->items[] = $action;
        return $this;
    }

    /**
     * @param ActionCollection|Iterator|null $actions
     * @return $this
     */
    public function setItems(ActionCollection|Iterator|null $actions): ActionCollection
    {
        $this->items = null;
    
        foreach ( $actions as $action ) {
            $this->addItem($action);
        }
        return $this;
    }
    
    /**
     * @param ActionCollection|CollectionInterface $actions
     * @return $this
     */
    public function addItems(ActionCollection|CollectionInterface $actions): ActionCollection
    {
        foreach ( $actions as $action ) {
            $this->addItem($action);
        }
        return $this;
    }
}