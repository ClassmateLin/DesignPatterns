<?php

class TeamLead
{
    private $junior;

    public function __construct(JuniorDeveloper $junior)
    {
        $this->junior = $junior;
    }

    public function withCode(): string
    {
        return $this->junior->withBadCode();
    }
}


class JuniorDeveloper
{
    public function withBadCode(): string
    {
        return 'Some junior developer generated code...';
    }
}