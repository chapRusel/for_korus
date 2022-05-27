<?php

namespace IIT\Illuminate\App\Services;

class Container
{
    private $service;
    private array $options = [];

    /**
     * @return \IIT\Illuminate\App\Services\Service
     */
    private function getService(): Service
    {
        return $this->service;
    }

    /**
     * @param  string  $service
     *
     * @return $this
     */
    public function setService(string $service): Container
    {
        $this->service = new $service();

        return $this;
    }


    /**
     * @return array
     */
    private function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param  array  $options
     *
     * @return $this
     */
    public function setOptions(array $options): Container
    {
        $this->options = $options;

        return $this;
    }


    /**
     * @return \IIT\Illuminate\App\Services\Service
     */
    public function initService(): Service
    {
        if (!empty($this->getOptions())) {
            return $this->getService()->setModel($this->getOptions()['model'])->setRepository(
                $this->getOptions()['repository'],
                $this->getOptions()['hiddenFields'] ?: []
            );
        }

        return $this->getService();
    }

}

