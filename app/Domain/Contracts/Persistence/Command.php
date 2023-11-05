<?php

namespace Domain\Contracts\Persistence;

interface Command
{
    public function handle(): DatabaseResource;
}
