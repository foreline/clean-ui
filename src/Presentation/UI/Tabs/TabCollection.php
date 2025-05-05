<?php
declare(strict_types=1);

namespace Presentation\UI\Tabs;

use Domain\Aggregate\AggregateInterface;
use Domain\Aggregate\CollectionInterface;
use Domain\Aggregate\CollectionTrait;
use Iterator;

/**
 * Tab collection
 */
class TabCollection implements CollectionInterface
{
    use CollectionTrait;

    /** @var ?Tab[] */
    private ?array $items;
    
    /**
     * @return ?Tab
     */
    public function current(): ?Tab
    {
        return $this->valid() ? $this->items[$this->position] : null;
    }
    
    /**
     * @return ?Tab[]
     */
    public function getCollection(): ?array
    {
        return $this->items;
    }


    /**
     * Adds element to Collection
     * @param Tab|AggregateInterface $item
     * @return self
     */
    public function addItem(Tab|AggregateInterface $item): self
    {
        $this->items[] = $item;
        return $this;
    }
    
    
    /**
     * Adds elements to Collection
     * @param TabCollection|CollectionInterface $items
     * @return $this
     */
    public function addItems(TabCollection|CollectionInterface $items): self
    {
        foreach ( $items as $item ) {
            $this->addItem($item);
        }
        return $this;
    }


    /**
     * @param ?TabCollection $tabCollection
     * @return $this
     */
    public function setItems(Iterator|null $tabCollection): self
    {
        $this->items = null;
        foreach ( $tabCollection as $tab ) {
            $this->addItem($tab);
        }
        return $this;
    }


    /**
     * @param bool $withUrl
     * @return string
     */
    public function toString(bool $withUrl = true): string
    {
        if ( !$this->valid() ) {
            return '';
        }
        return implode(
            ', ',
            array_map(
                fn (Tab $item): string => ($withUrl ? '<a href="' . $item->getSlug() . '">' : '') . $item->getName() . ($withUrl ? '</a>' : '')
                ,$this->items
            )
        );
    }
}
