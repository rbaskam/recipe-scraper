<?php

namespace RecipeScraperTests\Scrapers;

use RecipeScraper\Scrapers\WwwGeniusKitchenCom;
use RecipeScraperTests\ScraperTestCase;

/**
 * @group scraper
 */
class WwwGeniusKitchenComTest extends ScraperTestCase
{
    protected function getHost()
    {
        return 'www.geniuskitchen.com';
    }

    protected function makeScraper()
    {
        return new WwwGeniusKitchenCom;
    }
}
