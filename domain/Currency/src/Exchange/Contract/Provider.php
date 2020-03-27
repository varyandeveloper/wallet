<?php

namespace Currency\Exchange\Contract;

use Illuminate\Support\Collection;

interface Provider
{
    public function rates(string $base, string ...$symbols): Collection;
}
