<?php

namespace RecipeScraper\Scrapers;

use Symfony\Component\DomCrawler\Crawler;

/**
 * They seem to cross-post some recipes to multiple sites - canonical may point to an
 * entirely different domain.
 *
 * Has LD+JSON but it is malformed on some pages.
 *
 * Some recipes have two recipeYield items.
 */
class HearstDigitalMedia extends SchemaOrgMarkup
{
    /**
     * @var string[]
     */
    protected $supportedHosts = [
        'www.countryliving.com',
        'www.delish.com',
        'www.esquire.com',
        'www.goodhousekeeping.com',
        'www.redbookmag.com',
        'www.womansday.com',
    ];

    /**
     * @param  Crawler $crawler
     * @return boolean
     */
    public function supports(Crawler $crawler) : bool
    {
        return parent::supports($crawler) && in_array(
            parse_url($crawler->getUri(), PHP_URL_HOST),
            $this->supportedHosts,
            true
        );
    }

    /**
     * @param  Crawler $crawler
     * @return string|null
     */
    protected function extractAuthor(Crawler $crawler)
    {
        return $this->extractString($crawler, '[rel="author"]');
    }

    /**
     * @param  Crawler $crawler
     * @return string[]|null
     */
    protected function extractCategories(Crawler $crawler)
    {
        return $this->extractArray($crawler, '.tags--top .tags--item');
    }

    /**
     * @param  Crawler $crawler
     * @return string|null
     */
    protected function extractDescription(Crawler $crawler)
    {
        return $this->extractString($crawler, '[name="description"]', ['content']);
    }

    /**
     * @param  Crawler $crawler
     * @return string|null
     */
    protected function extractImage(Crawler $crawler)
    {
        return $this->extractString($crawler, '[property="og:image"]', ['content']);
    }

    /**
     * @param  Crawler $crawler
     * @return string[]|null
     */
    protected function extractIngredients(Crawler $crawler)
    {
        return $this->extractArray(
            $crawler,
            '[itemprop="ingredients"], .recipe-ingredients-group-header'
        );
    }

    /**
     * @param  Crawler $crawler
     * @return string[]|null
     */
    protected function extractInstructions(Crawler $crawler)
    {
        return $this->extractArray($crawler, '[itemprop="recipeInstructions"] li');
    }

    /**
     * @param  Crawler $crawler
     * @return string|null
     */
    protected function extractUrl(Crawler $crawler)
    {
        return $this->extractString($crawler, '[rel="canonical"]', ['href']);
    }
}