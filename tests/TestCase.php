<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/* Extending the BaseTestCase class. */

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
