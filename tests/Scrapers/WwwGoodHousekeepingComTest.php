<?php

namespace RecipeScraperTests\Scrapers;

use RecipeScraperTests\ScraperTestCase;
use RecipeScraper\Extractors\ExtractorManager;
use RecipeScraper\Scrapers\HearstDigitalMedia;

class WwwGoodHousekeepingComTest extends ScraperTestCase
{
    protected function getHost()
    {
        return 'www.goodhousekeeping.com';
    }

    protected function makeScraper()
    {
        return new HearstDigitalMedia(new ExtractorManager);
    }
}
