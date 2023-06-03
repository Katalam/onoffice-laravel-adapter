<?php

namespace Kauffinger\OnOfficeApi\Actions;

class Action
{
    public static function read(): ReadAction
    {
        return new ReadAction();
    }

    public static function edit(): EditAction
    {
        return new EditAction();
    }
}
