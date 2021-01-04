<?php

namespace Lioo19\MyTextFilter;

use \Michelf\Markdown;

/**
 * Filter and format text content.
 *
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 *
 */
class MyTextFilter
{
    /**
     * @var array $filters Supported filters with method names of
     *                     their respective handler.
     */
    private $filters = [
        "bbcode"       => "bbcode2html",
        "link"         => "makeClickable",
        "markdown"     => "markdown",
        "nl2br"        => "nl2br",
        "strip_tags"   => "strip",
        "htmlentities" => "esc"
    ];



    /**
     * Call each filter specified in the param
     * on the text and return the processed text.
     * use the filters variable to go through all filters
     *
     *
     * @param string $text   The text to filter.
     * @param array  $filter Array of filters to be used.
     *
     * @return string with the formatted text.
     */
    public function parse($text, $filter)
    {
        foreach ($this->filters as $k => $v) {
            if (in_array($k, $filter)) {
                $text = $this->$v($text);
            }
        }
        return $text;
    }



    /**
     * Helper, BBCode formatting converting to HTML.
     *
     * @param string $text The text to be converted.
     *
     * @return string the formatted text.
     */
    public function bbcode2html($text)
    {
        $search = [
        '/\[b\](.*?)\[\/b\]/is',
        '/\[i\](.*?)\[\/i\]/is',
        '/\[u\](.*?)\[\/u\]/is',
        '/\[img\](https?.*?)\[\/img\]/is',
        '/\[url\](https?.*?)\[\/url\]/is',
        '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        ];

        $replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        ];

        return preg_replace($search, $replace, $text);
    }



    /**
     * Make clickable links from URLs in text.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string with formatted anchors.
     */
    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            function ($matches) {
                return "<a href=\"{$matches[0]}\">{$matches[0]}</a>";
            },
            $text
        );
    }



    /**
     * Format text according to Markdown syntax.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string as the formatted html text.
     */
    public function markdown($text)
    {
        return Markdown::defaultTransform($text);
    }



    /**
     * For convenience access to nl2br formatting of text.
     * Creates <br>-tags for each \n in the text
     *
     * @param string $text The text that should be formatted.
     *
     * @return string the formatted text.
     */
    public function nl2br($text)
    {
        return nl2br($text);
    }

    /**
     * Strips the text of tags completely
     *
     * @param string $text The text that should be formatted.
     *
     * @return string the formatted text.
     */
    public function strip($text)
    {
        return strip_tags($text);
    }

    /**
     * Makes htmlentities on incoming text
     *
     * @param string $text The text that should be formatted.
     *
     * @return string the checked text
     */
    public function esc($text)
    {
        return htmlentities($text);
    }
}
