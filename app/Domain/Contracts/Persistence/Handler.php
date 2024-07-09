<?php

namespace Domain\Contracts\Persistence;

interface Handler
{
    public function execute(Command $command): DatabaseResource;
}
