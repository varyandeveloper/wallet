<?php

namespace Currency\Exchange\Contract;

interface Factory
{
    /**
     * @param string|null $name
     * @return Provider
     */
    public function driver($name = null);
}
