<?php
declare(strict_types=1);

namespace Presentation\UI\Tabs;

/**
 * UI Tabs
 */
class Tab
{
    /** @var string Символьный идентификатор */
    private string $id = '';
    
    /** @var bool Активность вкладки */
    private bool $active = false;
    
    /** @var string Название вкладки */
    private string $name = '';
    
    /** @var int Счетчик вкладки */
    private int $counter = 0;
    
    /** @var string Содержимое вкладки */
    private string $content = '';
    
    /** @var bool Вкладка отключена */
    private bool $disabled = false;
    
    /** @var string Название компонента */
    private string $componentName = '';
    
    /** @var string Название шаблона компонента */
    private string $componentTemplate = '';
    
    /** @var array Параметры вызова компонента */
    private array $componentParameters = [];
    
    /** @var bool Загружать содержимое вкладки */
    private bool $preload = false;
    
    /** @var string Классы для иконки */
    private string $iconClasses = '';
    
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    
    /**
     * @param string $id
     * @return Tab
     */
    public function setId(string $id): Tab
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
    
    /**
     * @param bool $active
     * @return Tab
     */
    public function setActive(bool $active): Tab
    {
        $this->active = $active;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     * @return Tab
     */
    public function setName(string $name): Tab
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getCounter(): int
    {
        return $this->counter;
    }
    
    /**
     * @param int $counter
     * @return Tab
     */
    public function setCounter(int $counter): Tab
    {
        $this->counter = $counter;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
    
    /**
     * Возвращает содержимое вкладки
     * @return string
     */
    public function getTabContent(): string
    {
        if ( !empty($content = $this->getContent() ) ) {
            return $content;
        }
        
        if ( empty($this->getComponentName()) ) {
            return '';
        }
        
        // @fixme front error: Cannot read properties of undefined (reading 'init')
        
        if ( !$this->isPreload() ) {
            return 'загрузка...';
        }
        
        global $APPLICATION;
        ob_start();
        $APPLICATION->IncludeComponent(
            $this->getComponentName(),
            $this->getComponentTemplate(),
            $this->getComponentParameters()
        );
        return ob_get_clean();
    }
    
    /**
     * @param string $content
     * @return Tab
     */
    public function setContent(string $content): Tab
    {
        $this->setPreload(true);
        $this->content = $content;
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }
    
    /**
     * @param bool $disabled
     * @return Tab
     */
    public function setDisabled(bool $disabled): Tab
    {
        $this->disabled = $disabled;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getComponentName(): string
    {
        return $this->componentName;
    }
    
    /**
     * @param string $componentName
     * @return Tab
     */
    public function setComponentName(string $componentName): Tab
    {
        $this->componentName = $componentName;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getComponentTemplate(): string
    {
        return $this->componentTemplate;
    }
    
    /**
     * @param string $componentTemplate
     * @return Tab
     */
    public function setComponentTemplate(string $componentTemplate): Tab
    {
        $this->componentTemplate = $componentTemplate;
        return $this;
    }
    
    /**
     * @return array
     */
    public function getComponentParameters(): array
    {
        return $this->componentParameters;
    }
    
    /**
     * @param array $componentParameters
     * @return Tab
     */
    public function setComponentParameters(array $componentParameters): Tab
    {
        $this->componentParameters = $componentParameters;
        return $this;
    }
    
    /**
     * @param string $componentName
     * @param string $componentTemplate
     * @param array $componentParameters
     * @return $this
     */
    public function setComponent(string $componentName, string $componentTemplate = '', array $componentParameters = []): self
    {
        $this->setComponentName($componentName);
        $this->setComponentTemplate($componentTemplate);
        $this->setComponentParameters($componentParameters);
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isPreload(): bool
    {
        return $this->preload;
    }
    
    /**
     * @param bool $preload
     * @return Tab
     */
    public function setPreload(bool $preload = true): Tab
    {
        $this->preload = $preload;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getIconClasses(): string
    {
        return $this->iconClasses;
    }
    
    /**
     * @param string $iconClasses
     * @return Tab
     */
    public function setIconClasses(string $iconClasses): Tab
    {
        $this->iconClasses = $iconClasses;
        return $this;
    }
}